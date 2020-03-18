<!DOCTYPE html>
<html>
<head>
    <title>Explorer</title>
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
    <div class="overall-container container-fluid px-0 ">
        <div class="top-bar d-flex justify-content-between px-5" style="">
            <div class="py-2">
                <img src="{{asset('img/ggg.png')}} " class="logo-img" alt=":3">


            </div>
            <ul class="top-bar-ul mb-0">
                <li class="d-inline-block pb-3 pt-4"><a href="home.html"  class="fm-caladea py-3" style="letter-spacing: 2px">
                        Home
                    </a></li>
                <li class="d-inline-block pb-3 pt-4" id="package_hover">
                    <a href="package.html" class="fm-caladea py-3" style="letter-spacing: 2px">
                        Package
                    </a>

                </li>

                <li class="d-inline-block pb-3 pt-4"><a href="pricing.html" class="fm-caladea py-3" style="letter-spacing: 2px">
                        Food
                    </a></li>
                <li class="d-inline-block pb-3 pt-4" id="video_hover"><a href="video.html" class="fm-caladea py-3" style="letter-spacing: 2px">
                        Drink
                    </a></li>
                <li class="d-inline-block pb-3 pt-4"><a href="blog.html" class="fm-caladea py-3" style="letter-spacing: 2px">
                        Set
                    </a></li>
            </ul>

        </div>



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
                                            <input type="number" onchange="getSetInfo('{{$set->name}}','{{$set->price}}','{{$set->id}}',this.value)" value="0" class="set" class="w-100 rounded-lg" style="border: 1px solid #ccc">
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
                                                <li class="pb-2"><input type="number" onchange="getItemInfo('{{$item->name}}','{{$item->price}}','{{$item->id}}',this.value)" value="0" class="w-100 rounded-lg item" style="border: 1px solid #ccc"></li>
                                                @foreach($item->modifiers as $modifier)
                                                <li class="pb-2"><input type="number" onchange="getModifierInfo('{{$modifier->name}}','{{$modifier->price}}',this.value,'{{$item->id}}','{{$modifier->id}}')" value="0" class="w-100 rounded-lg modifier" style="border: 1px solid #ccc"></li>
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
                    <h3 class="pb-2">result</h3>
                    <div class="border rounded-lg px-3 py-2" >
                        <div class="border-bottom py-2">
                            <h5>Shift-id=1</h5>
                            <h5>staff=1</h5>
                        </div>
                        <div class="row mx-0 pb-2 pt-3">
                            <div class="col">Name</div>
                            <div class="col">Quantity</div>
                            <div class="col">Price</div>
                        </div>
{{--                        <div>--}}

{{--                            <div class="row mx-0 pb-2 pt-3">--}}
{{--                                <div class="col">Name</div>--}}
{{--                                <div class="col">Quantity</div>--}}
{{--                                <div class="col">Price</div>--}}
{{--                            </div>--}}
{{--                            <div style="font-size: 12px;" class="row mx-0 pb-2 pt-3">--}}
{{--                                <div class="col">Name</div>--}}
{{--                                <div class="col">Quantity</div>--}}
{{--                                <div class="col">Price</div>--}}
{{--                            </div>--}}
{{--                            <div style="font-size: 12px;" class="row mx-0 pb-2 pt-3">--}}
{{--                                <div class="col">Name</div>--}}
{{--                                <div class="col">Quantity</div>--}}
{{--                                <div class="col">Price</div>--}}
{{--                            </div>--}}
{{--                            <div class="row mx-0 pb-2 pt-3">--}}
{{--                                <div class="col">Name</div>--}}
{{--                                <div class="col">Quantity</div>--}}
{{--                                <div class="col">Price</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}



                        <div id="receipt_set">
                        </div>
                        <div id="receipt_item">
                        </div>



                        <div class="pt-3 border-top" style="padding-left: 15px">
                            <input type="checkbox" id="cash">
                            <label for="cash"  class="pl-3">Cash</label>

                        </div>
                        <div class="text-right pr-5 pt-3" style="padding-left: 15px">
                            <p>result : <span>2500ks</span></p>
                        </div>
                    </div>
                    <div class="justify-content-end d-flex pt-4">
                        <button type="button" class="btn btn-primary">cash</button>
                    </div>
                </div>
            </div>
        </div>





    </div>
</div>


</body>
</html>

<script>
    let i=0;
    let j=1000;
    let k= 10000;
    function getSetInfo(name,price,set_id,qty) {
       let previous_div = i-1;
       let previous_set_id = 0;
       if($('.'+previous_div).html()){
          previous_set_id = $('.'+previous_div+' .set_id').val();
       }

       if(qty>0){
           if(previous_set_id===set_id){
               $('.'+previous_div).remove();
           }
           price = price*qty;

           $('#receipt_set').append(`
                 <div class="row mx-0 py-2 ${i}" >
                            <input class="set_id" hidden value="${set_id}"/>
                            <div class="col">${name}</div>
                            <div class="col">${qty}</div>
                            <div class="col">${price}</div>
                        </div>

           `)
       }else{
           $('.'+previous_div).remove();
       }
        i++;
   }

    function getItemInfo(name,price,item_id,qty) {
        let previous_div = j-1;
        let previous_item_id = 0;
        if($('.'+previous_div).html()){
            previous_item_id = $('.'+previous_div+' .item_id').val();
        }

        if(qty>0){
            if(previous_item_id===item_id){
                $('.'+previous_div).remove();
            }
            price = price*qty;

            $('#receipt_item').append(`
                 <div class="${j}" >
                            <div class="row mx-0 py-2">
                                <input class="item_id" hidden value="${item_id}"/>
                                <div class="col">${name}</div>
                                <div class="col">${qty}</div>
                                <div class="col">${price}</div>
                            </div>

                        </div>

           `)
        }else{
            $('.'+previous_div).remove();
        }
        j++;
    }

    function getModifierInfo(name,price,qty,item_id,modifier_id) {
        let previous_div = k-1;
        let previous_mod_id = 0;
        if($('.'+previous_div).html()){
            previous_mod_id = $('.'+previous_div+' .mod_id').val();
        }

        let target_div= $('.item_id').filter(function(){
            return parseInt($(this).val())==item_id;
        }).parent().parent();

        if(qty>0){
            if(previous_mod_id===modifier_id){
                $('.'+previous_div).remove();
            }
            price = price*qty;

            target_div.append(`
                 <div style="font-size:12px" class="row mx-0 py-2 ${k}" >
                            <input class="mod_id" hidden value="${modifier_id}"/>
                            <div class="col">${name}</div>
                            <div class="col">${qty}</div>
                            <div class="col">${price}</div>
                        </div>

           `)
        }else{
            $('.'+previous_div).remove();
        }
        k++;
    }
</script>
