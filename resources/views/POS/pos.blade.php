<!DOCTYPE html>
<html>
<head>
    <title>Explorer</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}} ">
    <link rel="stylesheet" href="{{asset('css/ui.css')}} ">
    <link rel="stylesheet" href="{{asset('css/selectboot.css')}} ">
    <link rel="stylesheet" type="text/css" href="{{asset('css/Tin_tin.css')}} ">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}} ">
    <link rel="stylesheet" href="{{asset('css/datepicker.min.css')}} ">
    <script src="{{asset('js/jquery.js')}} "></script>

    <script src="{{asset('js/bootstrap.js')}} "></script>

    <script src="{{asset('js/bs.js')}} "></script>

</head>
<body>
<div>
    <form >
        <div class="overall-container container-fluid px-0 ">

            <div class="container" style="margin-top: 6rem">
                <div class="row mx-0 pt-3">

                    <div class="col-7">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="set-tab" data-toggle="tab" href="#set" role="tab" aria-controls="home" aria-selected="true">Sets</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="items-tab" data-toggle="tab" href="#items" role="tab" aria-controls="profile" aria-selected="false">Items</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <!--                order-->
                            <div class="pb-5 tab-pane fade show active" id="set" role="tabpanel" aria-labelledby="set-tab" >
                                {{--                            <h3 class="pb-2 font-weight-bold">Set</h3>--}}
                                <div class=" border rounded-lg">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col" >Price</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sets as $set)
                                            <tr>
                                                <td class="border-top-0 border-bottom-0">
                                                    <h5>{{$set->name}}</h5>
                                                    <ul class=" pl-4" style="list-style: upper-roman">
                                                        @foreach($set->items as $item)
                                                            <li>{{$item->name}}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td class="border-top-0 border-bottom-0">
                                                    <p class="mb-0">${{$set->price}}</p>
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right pl-0 w-25">
                                                    <input type="number"
                                                           {{--                                                   onchange="test('{{$set}}')"--}}
                                                           onchange="getSetInfo('{{$set}}',this.value)"
                                                           value="0" class="set" class="w-100 rounded-lg" style="border: 1px solid #ccc">
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--                    item-->
                            <div class="pb-5 tab-pane fade" id="items" role="tabpanel" aria-labelledby="items-tab" >
                                <div class=" border rounded-lg">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col" >Price</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <td class="border-top-0 border-bottom-0">
                                                    <h5 class="mb-0 pb-2">{{$item->name}}</h5>
                                                    <ul class=" pl-4" style="list-style: upper-roman">
                                                        @foreach($item->modifiers as $modifier)
                                                            <li class="pb-2">{{$modifier->name}}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td class="border-top-0 border-bottom-0">
                                                    <ul class="pl-0 list-unstyled" >
                                                        <li class="pb-2">${{$item->price}}</li>
                                                        @foreach($item->modifiers as $modifier)
                                                            <li class="pb-2">${{$modifier->price}}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right pl-0 w-25 ">
                                                    <ul class="pl-0 list-unstyled" >
                                                        <li class="pb-2">
                                                            <input type="number"
                                                                   onchange="getItemInfo('{{$item}}',this.value)"
                                                                   value="0" class="w-100 rounded-lg item" style="border: 1px solid #ccc"></li>
                                                        @foreach($item->modifiers as $modifier)
                                                            <li class="pb-2">
                                                                <input type="number"
                                                                       onchange="getModifierInfo('{{$item}}','{{$modifier}}',this.value)"
                                                                       value="0" class="w-100 rounded-lg modifier" style="border: 1px solid #ccc"></li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-1">

                    </div>

                    <!--                table-->
                    <div class="col">
                        {{--                    <h3 class="pb-2">result</h3>--}}
                        <div class="border rounded-lg px-3 py-2" >
                            <div class="border-bottom py-2">
                                <p>Shift-id=1</p>
                                <p>staff=1</p>
                            </div>
                            <div class="row mx-0 pb-2 pt-3">
                                <div class="col">Name</div>
                                <div class="col">Quantity</div>
                                <div class="col">Price</div>
                            </div>

                            <div id="receipt_set">
                            </div>
                            <div id="receipt_item">
                            </div>

                            <div class="pt-3 border-top" style="padding-left: 15px">
                                <input type="checkbox" id="cash">
                                <label for="cash"  class="pl-3">Cash</label>

                            </div>
                            <div class="text-right pr-5 pt-3" style="padding-left: 15px">
                                <p >Sub Total : <span id="sub_total"></span></p>
                                <p >Total : <span id="total"></span></p>
                                <p >Discount : <span id="discount"></span></p>
                            </div>
                        </div>
                        <div class="justify-content-end d-flex pt-4">
                            <button type="button" onclick="submitData()" id="submit" class="btn btn-primary">Submit</button>
                        </div>
                        {{--                    <a href="{{route('print')}}">Print PDF</a>--}}

                    </div>
                </div>
            </div>





        </div>
    </form>
</div>


</body>
</html>

<script>

    let data = [];
    let sets = [];
    let items = [];
    data[0] = {};
    data[0].sets = [];
    data[0].items = [];

    function findPrevious(type,type_id) {
        return $('.'+type).filter(function(){
            return parseInt($(this).val())===type_id;
        });
    }

    function findTarget(type,target) {
        data[0].type.find(function (typeItem) {
            return typeItem.name === target;
        });
    }
    function getSetInfo(set_obj,qty) {
        let set = JSON.parse(set_obj);
        let prev_set = findPrevious('set_id',set.id);
        // let prev_set = $('.set_id').filter(function(){
        //     return parseInt($(this).val())===set.id;
        // });
        if(prev_set){
            prev_set.parent().remove();
            let targetSet = data[0].sets.find(function (setItem) {
                return setItem.name === set.name;
            });
            const index = data[0].sets.indexOf(targetSet);
            if (index > -1) {
                data[0].sets.splice(index, 1);
            }
        }
        if(qty>0){
            set.quantity= parseInt(qty);
            set.type = 'set';
            sets.push(set);
            data[0].sets = sets;
            // data.push(set);
            let price = set.price*qty;
            $('#receipt_set').append(`
                 <div class="row mx-0 py-2" >
                            <input class="set_id" hidden value="${set.id}"/>
                            <div class="col">${set.name}</div>
                            <div class="col">${qty}</div>
                            <div class="col">${price}</div>
                        </div>
           `)
        }
        console.log(data);
    }

    function getItemInfo(item_obj,qty) {
        let item = JSON.parse(item_obj);
        let prev_item = findPrevious('item_id',item.id);
        // let prev_item = $('.item_id').filter(function(){
        //     return parseInt($(this).val())===item.id;
        // });
        if(prev_item){
            prev_item.parent().remove();
            let targetItem = data[0].items.find(function (itemSample) {
                return itemSample.name === item.name;
            });
            const index = data[0].items.indexOf(targetItem);
            if (index > -1) {
                data[0].items.splice(index, 1);
            }
        }
        if(qty>0){
            item.quantity= parseInt(qty);
            item.type = 'item';
            items.push(item);
            data[0].items = items;
            let price = item.price*qty;
            $('#receipt_item').append(`
                 <div>
                            <div class="row mx-0 py-2">
                                <input class="item_id" hidden value="${item.id}"/>
                                <div class="col">${item.name}</div>
                                <div class="col">${qty}</div>
                                <div class="col">${price}</div>
                            </div>
                        </div>
           `);
        }
    }

    function getModifierInfo(item_obj,mod_obj,qty) {
        let item = JSON.parse(item_obj);
        let modifier = JSON.parse(mod_obj);
        // let target_div= $('.item_id').filter(function(){
        //     return parseInt($(this).val())===item.id;
        // }).parent().parent();
        let target_div = findPrevious('item_id',item.id).parent().parent();
        // let prev_mod = $('.mod_id').filter(function(){
        //     return parseInt($(this).val())===modifier.id;
        // });
        let prev_mod = findPrevious('mod_id',modifier.id);
        let targetItem = data[0].items.find(function (itemSample) {
            return itemSample.name === item.name;
        });
        if(prev_mod){
            prev_mod.parent().remove();
            let targetMod = targetItem.modifiers.find(function (modItem) {
                return modItem.name === modifier.name;
            });
            const index = targetItem.modifiers.indexOf(targetMod);
            if (index > -1) {
                targetItem.modifiers.splice(index, 1);
            }
        }
        if(qty>0){
            modifier.quantity= parseInt(qty);
            targetItem.modifiers.push(modifier);
            let price = modifier.price*qty;
            target_div.append(`
                 <div style="font-size:12px" class="row mx-0 py-2" >
                            <input class="mod_id" hidden value="${modifier.id}"/>
                            <div class="col">${modifier.name}</div>
                            <div class="col">${qty}</div>
                            <div class="col">${price}</div>
                        </div>
           `);
        }
    }


    function submitData () {

        data[0].cash = !!$('#cash').is(":checked");
        data[0].staff_id = 1;
        data[0].shift_id = 1;
        let receipt_data = JSON.stringify(data);
        fetch('/save_transaction',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: receipt_data
        })
            .then(response => response.json())
            .then(data => {
                // console.log(data);
                // console.log(data.data.grand_total);
                $('#total').html(data.data.grand_total);
                $('#sub_total').html(data.data.sub_total);
                $('#discount').html(data.data.discount_amount);
            })
    }
</script>
