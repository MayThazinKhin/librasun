<?php


namespace App\Http\Actions\Receipt;


use App\Models\ItemModifier;
use App\Models\receipt;
use App\Models\ReceiptItem;
use App\Models\Set;
use App\Models\Staff;
use Carbon\Carbon;

class ReceiptSaving
{

    public function run($data)
    {
        $sets = $data->sets;
        $items =  $items = $data->items;

        $receipt=  $this->saveReceipt($data);

        $this->addDataForReceipt($data,$receipt);

        $this->saveReceiptSet($sets,$receipt);

        $this->saveReceiptItemModifier($items, $receipt);

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
