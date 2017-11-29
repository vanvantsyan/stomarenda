@extends('site_layout.front')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{url('add_order')}}" method="POST" id="orderForm">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="{{url('/')}}">Главная </a></li>
                        <li class="active"><span>Взять в аренду</span></li>
                    </ol>
                </div>
            </div>
        </div>
        <section class="registration-rent">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Оформление аренды
</h1>
                    </div>
                    <div class="col-lg-6 col-md-12 registration-section">
                        <div class="product-container"><img
                                    src="{{ URL::to("$layout_path/images-$product->image_path/$product->image")}}"
                                    alt="Оборудование"></div>
                        <span class="product-name">{{$product->name}}</span><span
                                class="product-price product-price__mart">{{$product->price}} <i
                                    class="fa fa-rub"></i></span>
                        <input type="hidden" id="product_name" name="product_name" value="{{$product->name}}">
                        <input type="hidden" id="product_price" name="product_price" value="{{$product->price}}">
                        <input type="hidden" id="product_type" name="product_type" value="{{$product->type}}">
                        <input type="hidden" id="product_id" name="product_id" value="{{$product->id}}">

                        @if($product->type =='products')
                           

                            <div class="related-block">
                                <div class="related-block-title">Сопутствующие товары</div>
                                @foreach($related_products as $related_product)
                                    <div class="checkbox-container">
                                        <label class="checkbox-label">
                                            <span>{{$related_product->name .' '.$related_product->model}}</span>
                                            <input class="custom-control-input related_checkbox" value="{{$related_product->id}}" type="checkbox"><span
                                                    class="cr cr2"><i
                                                        class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        </label>
                                    </div>
                                    <input type='hidden' id="related_price{{$related_product->id}}" name="related_price"
                                               value="{{$related_product->price}}">
                                    <input type='hidden' name="related_count_price[]" id="related_count_price{{$related_product->id}}"
                                                                                   value="0">

                                    
                                    
                                    <div class="related-block-quantity related_divs" id="related_count_price_top{{$related_product->id}}">

                                        <div class="quantity-container-wrapper">
                                                <input type="hidden" value="{{$related_product->id}}" class="related_product_id"
                                           name="related_product_id[]">
                                                <span class="quantity-container plus">
                                                    <i class="fa fa-plus"></i>
                                                </span>
                                                <input class="quantity-number" id="quantity-number{{$related_product->id}}" type="text" name="related_count{{$related_product->id}}" value="0">
                                                <span class="quantity-container minus">
                                                    <i class="fa fa-minus"></i>
                                                </span>
                                                <span class="quantity-text">шт.</span>
                                        </div>
                                        <span class="product-price product-price-count">
                                                <span class="related_total_price{{$related_product->id}}">0 </span>
                                                <i class="fa fa-rub"></i>
                                        </span>
                                    
                                    </div>
                                @endforeach
                                
                            </div>

                        @endif

                    </div>
                </div>
            </div>
        </section>
        <section class="information-client container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="related-block-title"> Информация о клиенте</h3>
                    </div>
                    <div class="col-md-6 my-col">
                        <label class="information-label" for="name">Ваше имя
                            <input class="information-input test" name="name" id="name" type="text" minlength="3">
                        </label>
                        {{--<svg class="icon icon-check-ok ">--}}
                        {{--<use xlink:href="https://stomarenda.herokuapp.com/static/img/svg/symbol/sprite.svg#check-ok"></use>--}}
                        {{--</svg>--}}
                        <label class="information-label" for="tel">Контактный телефон
                            <input class="information-input" name="tel" id="tel" type="text">
                        </label>
                        <label class="information-label" for="email">Ваш е-mail
                            <input class="information-input" name="email" id="email" type="email">
                        </label>
                        <label class="information-label test2" for="company">Название компании
                            <input class="information-input" name="company_name" id="company" type="text" >
                        </label>
                        @if($product->type == 'products')
                            <div class="time-block">Срок аренды:
                                <div style="display: inline-block; float: right;">
                                    <span>c</span>
                                    <div class="input-group date" style="display: inline-block;">
                                        <i class="fa fa-calendar-o calendar-icon2"></i>
                                        <input type="text" required class="calendar-input calendar_from"
                                               name="from_date"
                                               readonly>
                                        <i class="fa fa-chevron-down chevron-icon2"></i>
                                        <div class="input-group-addon" style="display: none">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                    <span>до</span>
                                    <div class="input-group date" style="display: inline-block;">
                                        <i class="fa fa-calendar-o calendar-icon2"></i>
                                        <input type="text" required class="calendar-input calendar_to" name="to_date"
                                               readonly>
                                        <i class="fa fa-chevron-down chevron-icon2"></i>
                                        <div class="input-group-addon" style="display: none">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="time-block time-block__mart">Время доставки
                                <div class="calendar-input-container2">
                                    <select class="time-select" name="time">
                                        <option value="09:00">09:00</option>
                                        <option value="10:00">10:00</option>
                                        <option value="11:00">11:00</option>
                                        <option value="12:00">12:00</option>
                                        <option value="13:00">13:00</option>
                                        <option value="14:00">14:00</option>
                                        <option value="15:00">15:00</option>
                                        <option value="16:00">16:00</option>
                                        <option value="17:00">17:00</option>
                                        <option value="18:00">18:00</option>
                                        <option value="19:00">19:00</option>
                                    </select><i class="fa fa-chevron-down chevron-icon3"></i>
                                </div>
                            </div>
                            <div class="total-rent-container rent_for_period">Стоимость аренды за период с
                                <span class="rent-data from_data_span"> </span> по
                                <span class="rent-data to_data_span"></span>
                                <span class="rent-total rent__marl">
                                    <span class="product_total_price">{{$product->price}}  </span>
                                    <i class="fa fa-rub"></i>
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <section class="delivery-date">
            <div class="container">
                @if($product->type != 'packages')
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="related-block-title related-block-title__marb"> Способ доставки</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="self-delivery-wrapper">
                                <label class="delivery-radio-label" for="SelfDelivery">Самовывоз
                                    <input id="SelfDelivery" type="radio" name="delivery" value="0"><span class="cr"><i
                                                class="cr-icon fa fa-circle"></i></span>
                                </label>
                                <div class="self-delivery-icon"></div>
                            </div>
                            <div class="self-delivery-wrapper">
                                <label class="delivery-radio-label" for="SelfDelivery2">Доставка
                                    <input id="SelfDelivery2" type="radio" name="delivery" value="1" checked><span
                                            class="cr"><i
                                                class="cr-icon fa fa-circle"></i></span>
                                </label>
                                <div class="delivery-icon"></div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="address_row">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="related-block-title"> Адрес доставки</h3>
                            <input id="autocomplete" class="information-input delivery-input address_field"
                                   placeholder="Внесите адресс" onFocus="geolocate()" name="address" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="delivery_text">
                                Цена и возможность доставки за пределами МКАДа будет обговорена с Вами по телефону.
                                Мы перезвоним вам за короткое время.
                            </div>
                            <div class="total-rent-container total-rent-container__mart delivery_price">Стоимость
                                доставки <span
                                        class="product-price"><span class="delivery_fee">1 000 </span><i
                                            class="fa fa-rub"></i>  </span></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="information-client container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="related-block-title related-block-title__marb"> выберите способ оплаты</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="self-delivery-wrapper">
                            <label class="delivery-radio-label" for="payment">Наличные при получении
                                <input id="payment" type="radio" name="payment" value="0"><span class="cr"><i
                                            class="cr-icon fa fa-circle"></i></span>
                            </label>
                            {{--<svg class="icon icon-cash ">--}}
                            {{--<use xlink:href="https://stomarenda.herokuapp.com/static/img/svg/symbol/sprite.svg#cash"></use>--}}
                            {{--</svg>--}}
                        </div>
                        <div class="self-delivery-wrapper">
                            <label class="delivery-radio-label" for="payment2">Безналичная оплата
                                <input id="payment2" type="radio" name="payment" value="1"><span class="cr"><i
                                            class="cr-icon fa fa-circle"></i></span>
                            </label>
                            {{--<svg class="icon icon-non-cash ">--}}
                            {{--<use xlink:href="https://stomarenda.herokuapp.com/static/img/svg/symbol/sprite.svg#non-cash"></use>--}}
                            {{--</svg>--}}
                        </div>
                        <div class="self-delivery-wrapper">
                            <label class="delivery-radio-label" for="payment3">Онлайн оплата
                                <input id="payment3" type="radio" name="payment" value="2" checked><span class="cr"><i
                                            class="cr-icon fa fa-circle"></i></span>
                            </label>
                            <div class="online-payment-icon"></div>
                        </div>
                        <div class="total-rent-container total-rent-container__martop">Сумма аренды<span
                                    class="product-price"><span class="product_total_price">{{$product->price}} </span> <i
                                        class="fa fa-rub"></i></span>
                        </div>

                        <div class="delivery_price total-rent-container total-rent-container__martop">
                            Доставка<span
                                    class="product-price"><span class="delivery_fee">1000 </span><i
                                        class="fa fa-rub"></i>   </span>
                        </div>
                        <input type='hidden' name="delivery_fee" id="delivery_fee" value="1000">
                        @if($product->type == 'products')
                            @foreach($related_products as $related_product)
                            <div class="total-rent-container total-rent-container__martop related_divs related_total_div{{$related_product->id}}">{{$related_product->name .' '.$related_product->model}}
                                AP<span class="product-price"><span
                                            class="related_total_price{{$related_product->id}}">0 </span> <i
                                            class="fa fa-rub"></i></span>
                            </div>
                            @endforeach
                        @endif
                        <div class="total-rent-container total-rent-container__mart total-rent-container__ttu">Общая
                            сумма<span class="product-price"><span class="total_amount"> </span> <i
                                        class="fa fa-rub"></i></span>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <input type="submit" class="btn-blue btn-blue-slider rent-btn" value="Подтвердить аренду"></a>
                    </div>
                </div>
            </div>
        </section>
    </form>
    <script>
        var mkd_coords = [
            [
                55.897702887224796,
                37.67240905761718
            ],
            [
                55.89664192633831,
                37.6752414703369
            ],
            [
                55.89591852721012,
                37.67807388305662
            ],
            [
                55.8956291637662,
                37.6829662322998
            ],
            [
                55.89538802590739,
                37.687686920166
            ],
            [
                55.89553270880329,
                37.69146347045898
            ],
            [
                55.89529157034246,
                37.69669914245605
            ],
            [
                55.89466460330075,
                37.69996070861816
            ],
            [
                55.89312125646775,
                37.705282211303704
            ],
            [
                55.89215663339145,
                37.70751380920409
            ],
            [
                55.89152961547806,
                37.70957374572752
            ],
            [
                55.89046848506115,
                37.712148666381815
            ],
            [
                55.888635554797155,
                37.715324401855455
            ],
            [
                55.8874296322104,
                37.71798515319823
            ],
            [
                55.88622367199341,
                37.720216751098604
            ],
            [
                55.88545183770592,
                37.722448348999016
            ],
            [
                55.884872951875,
                37.72493743896484
            ],
            [
                55.884872951875,
                37.73025894165038
            ],
            [
                55.88279853978146,
                37.73025894165038
            ],
            [
                55.8811582281455,
                37.73111724853514
            ],
            [
                55.880000319199695,
                37.7330913543701
            ],
            [
                55.87903536858371,
                37.735065460205064
            ],
            [
                55.87816689243558,
                37.737468719482415
            ],
            [
                55.87464453915709,
                37.743562698364244
            ],
            [
                55.86373768471359,
                37.76553535461424
            ],
            [
                55.84804765603748,
                37.79574775695799
            ],
            [
                55.833558904954586,
                37.8228702545166
            ],
            [
                55.83148173964286,
                37.82776260375975
            ],
            [
                55.83090204571783,
                37.83093833923339
            ],
            [
                55.82925953247555,
                37.831968307495096
            ],
            [
                55.824331574788744,
                37.83746147155761
            ],
            [
                55.82186736083274,
                37.83866310119629
            ],
            [
                55.81930634494508,
                37.83995056152341
            ],
            [
                55.81640687737011,
                37.84115219116209
            ],
            [
                55.815923611680155,
                37.84321212768552
            ],
            [
                55.815198701844565,
                37.84458541870117
            ],
            [
                55.814038817900894,
                37.84381294250486
            ],
            [
                55.81244392079273,
                37.84252548217771
            ],
            [
                55.81075229152879,
                37.84063720703125
            ],
            [
                55.80698210925112,
                37.84106636047361
            ],
            [
                55.80209966167469,
                37.841667175292955
            ],
            [
                55.80011750252675,
                37.84192466735837
            ],
            [
                55.780193594328715,
                37.84381294250486
            ],
            [
                55.77913351008552,
                37.844783264391616
            ],
            [
                55.77845628577709,
                37.84701486229202
            ],
            [
                55.77792417267178,
                37.84813066124222
            ],
            [
                55.776618045932416,
                37.84778733848831
            ],
            [
                55.77526349769469,
                37.84581323265335
            ],
            [
                55.773812143546046,
                37.844697433703146
            ],
            [
                55.75997317538473,
                37.84426828026078
            ],
            [
                55.753487486017335,
                37.84435411094925
            ],
            [
                55.75198691106874,
                37.8441824495723
            ],
            [
                55.74898558725352,
                37.84383912681839
            ],
            [
                55.74675864876349,
                37.845555740587926
            ],
            [
                55.7449673229946,
                37.84950395225785
            ],
            [
                55.74482207674487,
                37.85173555015823
            ],
            [
                55.74332116703625,
                37.85019059776566
            ],
            [
                55.741481263136315,
                37.844869095080114
            ],
            [
                55.736784271297495,
                37.8430666506221
            ],
            [
                55.73179612239952,
                37.84289498924515
            ],
            [
                55.731166504711425,
                37.844697433703146
            ],
            [
                55.72898698012023,
                37.84177919029495
            ],
            [
                55.72491820726679,
                37.841521698229506
            ],
            [
                55.72080056319119,
                37.84092088341019
            ],
            [
                55.71818442163351,
                37.845126587145536
            ],
            [
                55.716585581821896,
                37.84435411094925
            ],
            [
                55.71571345967627,
                37.840405899279325
            ],
            [
                55.713823794608125,
                37.84135003685256
            ],
            [
                55.7119340377362,
                37.84461160301467
            ],
            [
                55.710722606838814,
                37.84461160301467
            ],
            [
                55.709414219096786,
                37.84169335960648
            ],
            [
                55.70985035323334,
                37.83731599449416
            ],
            [
                55.70849347541899,
                37.83851762413284
            ],
            [
                55.70645806996491,
                37.83971925377152
            ],
            [
                55.70587650599171,
                37.83774514793656
            ],
            [
                55.705149538801436,
                37.83551355003615
            ],
            [
                55.70350169621928,
                37.8343119203975
            ],
            [
                55.701708376470975,
                37.833110290758825
            ],
            [
                55.69758827484921,
                37.83216615318557
            ],
            [
                55.69356469588598,
                37.83156533836623
            ],
            [
                55.6894922165988,
                37.832766968004904
            ],
            [
                55.686631530014225,
                37.83499856590531
            ],
            [
                55.684207054812255,
                37.83748765587111
            ],
            [
                55.6821703789833,
                37.83499856590531
            ],
            [
                55.680279084622,
                37.834655243151396
            ],
            [
                55.678775682559596,
                37.83620019554396
            ],
            [
                55.675235183954115,
                37.83723016380569
            ],
            [
                55.667182989135455,
                37.840405899279325
            ],
            [
                55.66053624948339,
                37.84203668236037
            ],
            [
                55.65641179002368,
                37.84263749717971
            ],
            [
                55.6535972024768,
                37.84014840721388
            ],
            [
                55.64859838232795,
                37.83448358177445
            ],
            [
                55.64529783914648,
                37.83027787803908
            ],
            [
                55.64243390621512,
                37.82572885154982
            ],
            [
                55.63913284127208,
                37.824613052599645
            ],
            [
                55.637919144215985,
                37.818604904406286
            ],
            [
                55.62854813179519,
                37.80358453392288
            ],
            [
                55.61820341705874,
                37.78667588829299
            ],
            [
                55.617086218110366,
                37.78899331688187
            ],
            [
                55.614948878859664,
                37.78959413170121
            ],
            [
                55.61509461025296,
                37.7873625338008
            ],
            [
                55.614997456051206,
                37.784444290392614
            ],
            [
                55.614997456051206,
                37.78075357078811
            ],
            [
                55.61120825360195,
                37.773543792956076
            ],
            [
                55.60217097907149,
                37.75852342247268
            ],
            [
                55.59726276567736,
                37.74642129539749
            ],
            [
                55.59342323822858,
                37.736464935534215
            ],
            [
                55.59118739019748,
                37.733718353502965
            ],
            [
                55.58875697549044,
                37.73251672386429
            ],
            [
                55.58875697549044,
                37.72891183494826
            ],
            [
                55.5889514142296,
                37.72530694603226
            ],
            [
                55.58584027831145,
                37.71826882957717
            ],
            [
                55.58345814747422,
                37.7134623110225
            ],
            [
                55.58127034840715,
                37.7057375490596
            ],
            [
                55.57845033787414,
                37.69964357017777
            ],
            [
                55.577088880670665,
                37.695094543688505
            ],
            [
                55.575532871526356,
                37.692691284411154
            ],
            [
                55.57358777301203,
                37.692262130968786
            ],
            [
                55.57120489546283,
                37.69234796165726
            ],
            [
                55.57188573243677,
                37.689773041002965
            ],
            [
                55.57266381732086,
                37.68642564415238
            ],
            [
                55.572128885626164,
                37.68239160179398
            ],
            [
                55.57057267908735,
                37.67071862816117
            ],
            [
                55.57042678154921,
                37.655612426989286
            ],
            [
                55.57086447253071,
                37.645570236437536
            ],
            [
                55.571496684188844,
                37.63930459617874
            ],
            [
                55.57208025510925,
                37.63381143211625
            ],
            [
                55.57208025510925,
                37.62437005638381
            ],
            [
                55.57266381732086,
                37.621108490221694
            ],
            [
                55.57353914430943,
                37.61527200340529
            ],
            [
                55.57383091561797,
                37.61115213035842
            ],
            [
                55.573879543957716,
                37.606860595934606
            ],
            [
                55.573101483264445,
                37.603684860460966
            ],
            [
                55.57144805288571,
                37.60196824669143
            ],
            [
                55.56896777623045,
                37.60308404564163
            ],
            [
                55.56648734226576,
                37.601624923937536
            ],
            [
                55.5659036878825,
                37.59759088157914
            ],
            [
                55.56673052902162,
                37.59467263817092
            ],
            [
                55.57008635184344,
                37.593642669909215
            ],
            [
                55.57378228721773,
                37.59252687095901
            ],
            [
                55.57601913103611,
                37.58969445823929
            ],
            [
                55.57699163191336,
                37.5841154634883
            ],
            [
                55.57854758300307,
                37.577163177721715
            ],
            [
                55.579617263456626,
                37.5727858126094
            ],
            [
                55.58039519449406,
                37.569524246447294
            ],
            [
                55.58195101012762,
                37.56188531517287
            ],
            [
                55.58972915951208,
                37.530900436632834
            ],
            [
                55.58919446129312,
                37.52729554771683
            ],
            [
                55.590652711931135,
                37.52592225670121
            ],
            [
                55.592256724782665,
                37.52223153709671
            ],
            [
                55.59313161313196,
                37.5185408174922
            ],
            [
                55.59415229144777,
                37.51373429893752
            ],
            [
                55.59677677040253,
                37.50738282799025
            ],
            [
                55.599012298609146,
                37.50369210838577
            ],
            [
                55.60192801271931,
                37.49931474327346
            ],
            [
                55.604843509200315,
                37.49776979088089
            ],
            [
                55.60722433656079,
                37.494594055407255
            ],
            [
                55.6090220079864,
                37.491332489245146
            ],
            [
                55.60790454629169,
                37.48910089134476
            ],
            [
                55.60596105848462,
                37.48747010826369
            ],
            [
                55.611256835447605,
                37.488585907213896
            ],
            [
                55.61412305735588,
                37.48686929344436
            ],
            [
                55.61834913630358,
                37.48111863731642
            ],
            [
                55.62340040051834,
                37.47622628807327
            ],
            [
                55.62786828167662,
                37.47099061607619
            ],
            [
                55.632044316744654,
                37.46661325096388
            ],
            [
                55.63592859929264,
                37.46172090172073
            ],
            [
                55.63665685921782,
                37.458373504870146
            ],
            [
                55.63626845561624,
                37.45622773765824
            ],
            [
                55.63578294567616,
                37.45348115562697
            ],
            [
                55.63811333828267,
                37.455111938708036
            ],
            [
                55.64068631839994,
                37.455541092150426
            ],
            [
                55.64660838237857,
                37.44910379051468
            ],
            [
                55.6556353723766,
                37.43837495445512
            ],
            [
                55.65903208541546,
                37.43416925071975
            ],
            [
                55.659905478070506,
                37.431079345934585
            ],
            [
                55.66063329033317,
                37.42884774803421
            ],
            [
                55.660875891400586,
                37.426616150133825
            ],
            [
                55.66330181902196,
                37.429105240099624
            ],
            [
                55.66655232529556,
                37.427817779772475
            ],
            [
                55.680279084622,
                37.4175180971553
            ],
            [
                55.688910399066174,
                37.41305490135452
            ],
            [
                55.69293445909798,
                37.407990890734396
            ],
            [
                55.698994005599275,
                37.40052362083694
            ],
            [
                55.70049662715336,
                37.39691873192091
            ],
            [
                55.702726216740054,
                37.39503045677445
            ],
            [
                55.705343398046864,
                37.393142181627965
            ],
            [
                55.70626421627299,
                37.39176889061234
            ],
            [
                55.70960805709442,
                37.3874773561885
            ],
            [
                55.71144946990421,
                37.38567491173048
            ],
            [
                55.71237014362427,
                37.382413345568374
            ],
            [
                55.712757789198164,
                37.38078256248733
            ],
            [
                55.714938223574464,
                37.3838724672725
            ],
            [
                55.718620457447926,
                37.38224168419143
            ],
            [
                55.72307743204297,
                37.38009591697952
            ],
            [
                55.72661358103612,
                37.378207641833036
            ],
            [
                55.72985880462025,
                37.37657685875199
            ],
            [
                55.72981037043872,
                37.37219949363968
            ],
            [
                55.72951976408239,
                37.36653466820022
            ],
            [
                55.73005254074289,
                37.3611273348262
            ],
            [
                55.731892985754094,
                37.37134118675492
            ],
            [
                55.734992485659596,
                37.373057800524435
            ],
            [
                55.74501573829052,
                37.368680435412145
            ],
            [
                55.751212398090566,
                37.36773629783889
            ],
            [
                55.76215096246012,
                37.36799378990431
            ],
            [
                55.76418345353268,
                37.36550469993851
            ],
            [
                55.76655455864643,
                37.36610551475785
            ],
            [
                55.76849004730127,
                37.368251281969755
            ],
            [
                55.77158662843581,
                37.36567636131546
            ],
            [
                55.77361862555876,
                37.36893792747757
            ],
            [
                55.77739205226982,
                37.36893792747757
            ],
            [
                55.7812134822765,
                37.36885209678909
            ],
            [
                55.78493780505847,
                37.369023758166044
            ],
            [
                55.787404367494126,
                37.37031121849319
            ],
            [
                55.78943553645033,
                37.36885209678909
            ],
            [
                55.791369884195,
                37.36430307029983
            ],
            [
                55.792530446538024,
                37.374259430163114
            ],
            [
                55.79562510967724,
                37.377520996325224
            ],
            [
                55.80031498774618,
                37.381898361437536
            ],
            [
                55.80442420841985,
                37.38533158897659
            ],
            [
                55.808484657453775,
                37.387563186876974
            ],
            [
                55.82303110743136,
                37.39185472130082
            ],
            [
                55.83076121703942,
                37.39417214988967
            ],
            [
                55.831727372273825,
                37.39099641441603
            ],
            [
                55.83192060042838,
                37.388421493761754
            ],
            [
                55.831775679402845,
                37.38558908104201
            ],
            [
                55.83414265491183,
                37.38576074241899
            ],
            [
                55.83568835674609,
                37.38782067894242
            ],
            [
                55.834625693362945,
                37.392369705431676
            ],
            [
                55.835640054497695,
                37.39554544090529
            ],
            [
                55.839648936077,
                37.39468713402053
            ],
            [
                55.84394715517475,
                37.391940551989286
            ],
            [
                55.84814832383642,
                37.39133973716995
            ],
            [
                55.85452164003844,
                37.39460130333206
            ],
            [
                55.85959057388015,
                37.39674707054397
            ],
            [
                55.86311429845631,
                37.399665313952184
            ],
            [
                55.866782492613076,
                37.40378518699905
            ],
            [
                55.86924384891148,
                37.407733398668974
            ],
            [
                55.8718980772097,
                37.41219659446976
            ],
            [
                55.873876565242476,
                37.418204742663114
            ],
            [
                55.875565438348396,
                37.4226679384639
            ],
            [
                55.87947369034666,
                37.43477006553909
            ],
            [
                55.88121056442022,
                37.44077821373244
            ],
            [
                55.884442872291174,
                37.4417223513057
            ],
            [
                55.88285087383534,
                37.4453272402217
            ],
            [
                55.88285087383534,
                37.44970460533402
            ],
            [
                55.882995603677216,
                37.458287674181676
            ],
            [
                55.883815729211854,
                37.46661325096388
            ],
            [
                55.885745367711415,
                37.47339387535355
            ],
            [
                55.888784352998634,
                37.48257775902054
            ],
            [
                55.889122003279596,
                37.48549600242873
            ],
            [
                55.889218474246576,
                37.488500076525426
            ],
            [
                55.89119607599798,
                37.492619949572294
            ],
            [
                55.89433109088146,
                37.49450822471878
            ],
            [
                55.894041715548205,
                37.50043054222366
            ],
            [
                55.90055213634929,
                37.51373429893752
            ],
            [
                55.90416856273664,
                37.52214570640823
            ],
            [
                55.9071096731802,
                37.532445389025426
            ],
            [
                55.90826676999187,
                37.54059930443069
            ],
            [
                55.91115936034281,
                37.54471917747756
            ],
            [
                55.90870067235796,
                37.5464357912471
            ],
            [
                55.91038802410236,
                37.56274362205765
            ],
            [
                55.91130398417253,
                37.57338662742874
            ],
            [
                55.91140039975807,
                37.58248468040726
            ],
            [
                55.91072548560348,
                37.58737702965042
            ],
            [
                55.91279839869436,
                37.59055276512405
            ],
            [
                55.90870067235796,
                37.594071823351584
            ],
            [
                55.90720609923871,
                37.6005949556758
            ],
            [
                55.90508467033431,
                37.60797639488478
            ],
            [
                55.90064857878059,
                37.626687484972685
            ],
            [
                55.89789987512875,
                37.64428277611039
            ],
            [
                55.89621197772044,
                37.65990396141311
            ],
            [
                55.89577793503864,
                37.668057876818395
            ],
            [
                55.897702887224796,
                37.67240905761718
            ]
        ];
        var placeSearch, autocomplete;
        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'long_name',
            postal_code: 'short_name'
        };

        function initAutocomplete() {

            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {types: ['geocode']});

            autocomplete.addListener('place_changed', fillInAddress);

        }

        function fillInAddress() {
            var place = autocomplete.getPlace();
            var lat = autocomplete.getPlace().geometry.location.lat();
            var lng = autocomplete.getPlace().geometry.location.lng();
            var newcoords = mkd_coords.map(function (coord) {
                return {lat: coord[0], lng: coord[1]};
            });

            var curPositionB = new google.maps.LatLng(lat, lng);


            var mkadAngle = new google.maps.Polygon({paths: newcoords});

            // console.log(google.maps.geometry.poly.containsLocation(curPositionB, mkadAngle));
            var result = google.maps.geometry.poly.containsLocation(curPositionB, mkadAngle) ?
                'in' :
                'out';
            if (result == 'out') {
                $(".delivery_text").fadeIn();
                $('.delivery_price').hide();
                $('#delivery_fee').val('out');
                count_total();
            }
            else {
                $(".delivery_text").hide();
                $('.delivery_price').fadeIn();
                $('#delivery_fee').val('in');
                count_total();
            }


            for (var component in componentForm) {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }

            // Get each component of the address from the place details
            // and fill the corresponding field on the form.
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }

        }

        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                    });
                    autocomplete.setBounds(circle.getBounds());
                });
            }

        }


    </script>

@endsection