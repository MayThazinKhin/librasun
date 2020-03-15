<?php


namespace App\Http\Actions;


class SampleInput
{
    public function run()
    {
        $receipts = [];
        $payment_types = ['cash','no_cash'];
        foreach ($payment_types as $payment_type){
            $receipt = new \stdClass();
            $receipt->shift_id = 1;
            $receipt->staff_id = 1;
            $receipt->payment_type = $payment_type;
            $data = new \stdClass();
            if($payment_type == 'cash'){
                $data->item_id = [3,4,5];
                $data->modifier_id = [null,1,2];
                $data->set_id = [1];

            }
            else{
                $data->item_id = [4,5];
                $data->modifier_id = [null,null];
                $data->set_id = [];
            }
            $receipt=  $this->getReceipt($receipt,$data);
            $receipts[]= $receipt;
        }
        return $receipts;
    }

    protected function getItem($item_id,$modifier_id)
    {
        $items = [];
        for($j = 0 ;$j < count($item_id) ; $j++ ){
            $item = new \stdClass();
            $item->id = $item_id[$j];
            $item->quantity = 1;
            $modifiers = [];
            if($modifier_id[$j]!= null){
                $modifier = new \stdClass();
                $modifier->id  = $modifier_id[$j];
                $modifier->quantity = 1;
                $modifiers[] = $modifier;
            }
            $item->modifiers = $modifiers;
            $items [] = $item;
        }
        return $items;
    }

    protected function getSet($set_id)
    {
        $sets = [];
        foreach ($set_id as $id){
            $set = new \stdClass();
            $set->id = $id;
            $set->quantity = 1;
            $sets[] = $set;
        }
        return $sets;
    }


    protected function getReceipt($receipt,$data)
    {
        $receipt->items = $this->getItem($data->item_id, $data->modifier_id);
        $receipt->sets = $this->getSet($data->set_id);
        return $receipt;
    }

}
