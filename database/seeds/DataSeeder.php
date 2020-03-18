<?php

use Illuminate\Database\Seeder;
use App\Models\Set;
use App\Models\Modifier;
use App\Models\Item;
use App\Models\ItemModifier;
class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modifier_name = ['Upsize','Extra Hot'];
        $modifier_price = [0.50,0.00];
        for($i = 0;$i < count($modifier_name) ;$i++){
           Modifier::create([
                'name'=>$modifier_name[$i],
                'price'=>$modifier_price[$i]
            ]);
        }

        $item_name =['Espresso','BlueBerry Muffin','Cafe Latte','Hazelnut Latte','Cappuccino'];
        $item_price = [4.00,4.00,4.00,4.00,4.00];

        for($i = 0;$i <count($item_name) ;$i++){
          Item::create([
                'name'=>$item_name[$i],
                'price'=>$item_price[$i]
            ]);
        }

        $set_name = ['SET 1'];
        $set_price = [5.00];
        for($i = 0;$i <count($set_name) ;$i++){
            Set::create([
                'name'=>$set_name[$i],
                'price'=>$set_price[$i]
            ]);
        }

        $item_id = [4,5];
        $modifier_id = [1,2];
        for($i = 0; $i < count($item_id); $i++){
            ItemModifier::create([
                'item_id'=> $item_id[$i],
                'modifier_id'=>$modifier_id[$i]
            ]);
        }

        $sets = Set::all();
        $items = Item::where('id','<',3)->get();
        foreach ($sets as $set){
            foreach ($items as $item){
                $set->items()->attach($item);
            }
        }


//        $items = Item::all();
//        $modifiers = Modifier::all();
//
//       foreach ($items as $item){
//           foreach ($modifiers as $modifier){
//               $item->modifiers()->attach($modifier);
//           }
//       }





    }
}
