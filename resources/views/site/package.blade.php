@extends('site_layout.front')
@section('title', $package->title)
@section('description', $package->meta_description)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">Главная</a></li>
                    <li><a href="{{url('/packages')}}">Пакеты для лицензирования</a></li>
                    <li class="active"><span>{{$package->name}} </span></li>
                </ol>
            </div>
        </div>
        <section class="physio">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{$package->name}}</h1>
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col-md-8 col-sm-8 text-center">
                    <img height="350px" src="{{ URL::to("$layout_path/images-licensepack/$package->image")}}" alt="{{$package->name}}">
            </div>
            <div class="col-md-4 col-sm-4">

                <div class="stock"><i class="fa fa-check-circle-o"></i><span class="physio-producer">в наличии</span>
                </div>
                <div class="lease-price">{{$package->price}} <i class="fa fa-rub"></i></div>
                <a class="btn-blue btn-blue-slider" href="{{url('card/packages/'.$package->slug)}}">Заказать</a><a
                        class="btn-white btn-white-slider" data-toggle="modal" data-target="#exampleModal">Получить
                    консультацию</a>
            </div>
        </div>
    </div>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="tab-content clearfix">
                        <div class="tab-pane active" id="1a" style="    margin: 36px 0 0 0;">
                            <div class="row" >
                                <div class="col-md-12 col-sm-12">
                                        <h2>Информация</h2>
                                        {!! $package->information !!}
                                </div>
                            </div>
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