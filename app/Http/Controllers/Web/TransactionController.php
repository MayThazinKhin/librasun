<?php

namespace App\Http\Controllers\Web;

use App\Http\Actions\Receipt\ReceiptSaving;
use App\Http\Actions\Receipt\SampleInput;
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
use PDF;

class TransactionController extends Controller
{

    public function pos()
    {
        return view('POS.pos');
    }

    public function index()
    {
        $items = Item::all();
        $sets = Set::all();
        foreach ($items as $item) {
            $item->modifiers;
        }
        foreach ($sets as $set) {
            $set->items;
        }
        return view('POS.pos', compact('items', 'sets'));


    }

    public function saveTransaction(Request $request)
    {

        $encode_data = json_encode($request->all());
        $data = json_decode($encode_data);
        $sub_total = 0.0;
        $sets = $data[0]->sets;
        $sub_total = $this->calculateForSet($sets, $sub_total);
        $items = $data[0]->items;
        $sub_total = $this->calculateForItem($items, $sub_total);

        $data[0]->sub_total = $sub_total;
        $data[0]->grand_total = $sub_total;
        $data[0]->discount_amount = 0.0;

        $this->calculateForDiscount($data[0]);
        (new ReceiptSaving())->run($data[0]);

        return response()->json([
            'data' => $data[0]
        ]);

    }

    protected function calculateForSet($sets, $sub_total)
    {
        foreach ($sets as $set) {
            $set_object = Set::where('id', $set->id)->first();
            $set->name = $set_object->name;
            $set->item_name = $set_object->getItemName();
            $set->price = $set_object->price;
            $set->amount = $set_object->price * $set->quantity;
            $sub_total += $set->amount;
        }
        return $sub_total;

    }

    protected function calculateForItem($items, $sub_total)
    {
        foreach ($items as $item) {
            $item_object = Item::where('id', $item->id)->first();
            $item->name = $item_object->name;
            $item->price = $item_object->price;
            $item->amount = $item_object->price * $item->quantity;
            $sub_total += $item->amount;
            foreach ($item->modifiers as $modifier) {
                $modifier_object = Modifier::where('id', $modifier->id)->first();
                $modifier->name = $modifier_object->name;
                $modifier->price = $modifier_object->price;
                $modifier_amount = $modifier_object->price * $modifier->quantity;
                $modifier->amount = $modifier_amount;
                $sub_total += $modifier_amount;
            }
        }
        return $sub_total;
    }

    protected function calculateForDiscount($data)
    {
        if ($data->cash == true) {
            $discount = 0.1;
            $discount_amount = $data->sub_total * $discount;
            $grand_total = $data->sub_total - $discount_amount;
            $data->discount_amount = $discount_amount;
            $data->grand_total = $grand_total;
            $data->payment_type = 'cash';
        }
        else{
            $data->payment_type = 'no_cash';
        }
    }


}
