@extends('site_layout.front')
@section('title', $product->title)
@section('description', $product->meta_description)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">Главная</a></li>
                    <li><a href="{{url('/licenseProducts')}}">Оборудование для лицензирования</a></li>
                    <li class="active"><span>{{$product->type_name}}</span></li>
                </ol>
            </div>
        </div>
        <section class="physio">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{$product->type_name}}</h1>
                </div>
            </div>
        </section>

    </div>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="tab-content clearfix">


                        <div class="tab-pane active" id="2a">
                            <h3 class="module-title delivery-title">Список</h3>
                            <table class="table delivery-table">
                                <thead>
                                <tr>
                                    <th class="padln">Оборудование</th>
                                    <th class="tac">Стоимость</th>
                                    <th class="tac">В наличии</th>
                                    <th class="tac">В корзину</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($license_product_info as $info)
                                    <tr>
                                        <td class="padln">{{$info->name}}</td>

                                        <td class="tac">{{($info->price == "")?0:$info->price}} <i class="fa fa-rub"></i></td>
                                        <td class="tac">{{$info->have}} </td>
                                        <td class="tac">
                                            @if($info->purchase)
                                                <input type="checkbox" class="add_product" name="purchase[]"
                                                       value="{{$info->price}}">
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <form action="{{url('card')}}" method="POST">
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <input type="hidden" name="total_lprod_amount" id="total_lprod_amount" value="0">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <span style="float:right">
                                    <div class="stock licenseprod_price">
                                        <span class="physio-producer" style="float:left">Сумма:</span>
                                        <span class="lease-price " style="float:right">
                                             <span class="total_lprod_amount"> </span> <i class="fa fa-rub"></i>
                                        </span>
                                    </div>
                                    <button class="submit btn-blue btn-blue-slider license-prod-to-card">Взять в аренду</button>
                                </span>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-fluid card-scheme">
        <div class="container padnone">
            <div class="row work-scheme" id="scheme">
                <div class="col-md-12">
                    <h1>Схема работы</h1>
                    <div class="row work-scheme-bottom">
                        <div class="col-md-4">
                            <div class="work-scheme-container"><img class="scheme-icon1"
                                                                    src="{{ URL::to("$layout_path/front/img/general/scheme-icon1.png")}}"
                                                                    alt="icon">
                                <div class="work-scheme-text"><span>1. </span>Выбираете
 оборудование
<br/>на сайте
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="work-scheme-container"><img class="scheme-icon1"
                                                                    src="{{ URL::to("$layout_path/front/img/general/scheme-icon2.png")}}"
                                                                    alt="icon">
                                <div class="work-scheme-text"><span>2. </span>указываете дату
 и время, на которое
 вам
                                    нужно оборудование
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="work-scheme-container"><img class="scheme-icon1"
                                                                    src="{{ URL::to("$layout_path/front/img/general/scheme-icon3.png")}}"
                                                                    alt="icon">
                                <div class="work-scheme-text"><span>3. </span>Оплачиваете
 онлайн или курьеру
 при
                                    получении
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="work-scheme-container"><img class="scheme-icon1"
                                                                    src="{{ URL::to("$layout_path/front/img/general/scheme-icon4.png")}}"
                                                                    alt="icon">
                                <div class="work-scheme-text"><span>4. </span>Мы доставляем
<br/>или вывозите
<br/>сами
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="work-scheme-container"><img class="scheme-icon1"
                                                                    src="{{ URL::to("$layout_path/front/img/general/scheme-icon5.png")}}"
                                                                    alt="icon">
                                <div class="work-scheme-text"><span>5. </span>заключаем<br/>
договор</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="work-scheme-container"><img class="scheme-icon1"
                                                                    src="{{ URL::to("$layout_path/front/img/general/scheme-icon6.png")}}"
                                                                    alt="icon">
                                <div class="work-scheme-text"><span>6. </span> Вы работаете на
<br/>нашем оборудовании
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><i
                                class="fa fa-times-circle-o"></i></button>
                </div>
                <div class="modal-body">
                    <div class="modal-title">Получить консультацию
</div>
                    <div class="modal-info">Оставьте свой номер телефона и наш менеджер
свяжется с вами в течении 10
                        минут
                    </div>
                    <form class="modal-form" id="modal-form" action="{{url('call')}}" method="POST">
                        <input class="modal-input form-name" type="text" name="name" pattern=".{3,20}"
                               placeholder="Ваше имя" required>
                        <input class="modal-input form-tel" type="tel" name="tel" pattern="[0-9]{6,12}"
                               placeholder="Контактный телефон"
                               required>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input class="btn-blue btn-blue-slider modal-btn" type="submit" value="Получить консультацию">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection