<?php

namespace App\Http\Controllers\Web;

use App\Http\Actions\SampleInput;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemModifier;
use App\Models\Modifier;
use App\Models\Receipt;
use App\Models\ReceiptItem;
use App\Models\Set;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function saveTransaction(Request $request)
    {
//      $data = $request->all();
        $request = (new SampleInput())->run();
        foreach ($request as $data){
            $sub_total = 0.0;
            $sets = $data->sets;
            if($sets){
               $sub_total =  $this->calculateForSet($sets,$sub_total);
            }
            $items = $data->items;
            if($items){
               $sub_total = $this->calculateForItem($items,$sub_total);
            }
            $data->sub_total = $sub_total;
            $data->grand_total = $sub_total;
            $data->discount_amount = 0.0;

            $this->calculateForDiscount($data);

            $receipt=  $this->saveReceipt($data);

            $this->addDataForReceipt($data,$receipt);

            $this->saveReceiptSet($sets,$receipt);

            $this->saveReceiptItemModifier($items, $receipt);
        }

        return $request;

    }

    protected function calculateForSet($sets, $sub_total)
    {
        foreach ($sets as $set){
            $set_object = Set::where('id',$set->id)->first();
            $set->name = $set_object->name;
            $set->item_name = $set_object->getItemName();
            $set->price = $set_object->price;
            $set->amount= $set_object->price * $set->quantity;
            $sub_total += $set->amount;
        }
        return $sub_total;

    }

    protected function calculateForItem($items,$sub_total){
        foreach ($items as $item){
            $item_object = Item::where('id',$item->id)->first();
            $item->name = $item_object->name;
            $item->price = $item_object->price;
            $item->amount = $item_object->price * $item->quantity;
            $sub_total += $item->amount;
            foreach ($item->modifiers as $modifier){
                $modifier_object = Modifier::where('id',$modifier->id)->first();
                $modifier->name = $modifier_object->name;
                $modifier->price = $modifier_object->price;
                $modifier_amount = $modifier_object->price * $modifier->quantity;
                $modifier->amount =  $modifier_amount;
                $sub_total += $modifier_amount;
            }
        }
        return $sub_total;
    }

    protected function calculateForDiscount($data)
    {
        if($data->payment_type == 'cash'){
            $discount = 0.1;
            $discount_amount = $data->sub_total * $discount;
            $grand_total = $data->sub_total - $discount_amount;
            $data->discount_amount = $discount_amount;
            $data->grand_total = $grand_total;
        }
    }

    protected function saveReceipt($data)
    {
        $receipt = Receipt::create([
            'payment_type' => $data->payment_type,
            'sub_total' => $data->sub_total,
            'grand_total'=>$data->grand_total,
            'discount'=>$data->discount_amount,
            'shift_id'=>$data->shift_id
        ]);
        return $receipt;
    }

    protected function addDataForReceipt($data,$receipt)
    {
        $data->staff_name = Staff::where('id',$data->staff_id)->pluck('name')->first();
        $data->receipt_no = 'No.' .$receipt->id;
        $date_time= Carbon::parse($receipt->created_at);
        $data->date_time= $date_time->format('d/m/Y H:m:s');
    }


    protected function saveReceiptSet($sets,$receipt)
    {
        foreach ($sets as $set){
            $set_object = Set::where('id',$set->id)->first();
            $receipt->sets()->save($set_object,['quantity'=>$set->quantity]);
        }
    }

    protected function saveReceiptItemModifier($items, $receipt)
    {
        foreach ($items as $item){
            $receipt_item = ReceiptItem::create([
                'item_id'=>$item->id,
                'receipt_id'=>$receipt->id,
                'quantity'=>$item->quantity
            ]);
            foreach ($item->modifiers as $modifier){
                $modifier->receipt_item_id = $receipt_item->id;
                $modifier->item_modifier_id = $modifier->id;
                $item_modifier = ItemModifier::where('item_id',$item->id)
                    ->where('modifier_id',$modifier->id)->first();
                $receipt_item->item_modifiers()->save($item_modifier,['quantity'=>$modifier->quantity]);
            }
        }
    }

}
