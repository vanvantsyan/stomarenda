@extends('site_layout.front')
@section('title', $product->title)
@section('description', $product->meta_description)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">Главная</a></li>
                    <li><a href="{{url('/category/'.$product->group_id)}}">{{$product->group}}</a></li>
                    <li class="active"><span>{{$product->name}} {{$product->model}}</span></li>
                </ol>
            </div>
        </div>
        <section class="physio">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{$product->name}}&nbsp{{$product->model}}</h1>
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col-md-9 col-sm-9">
                <div class="fotorama" data-nav="thumbs" data-width="600" data-height="357" data-arrows="false"
                     data-thumbwidth="136" data-thumbheight="114">
                    <img src="{{ URL::to("$layout_path/images-products/$product->image")}}"
                         alt="{{$product->meta_description}}">
                    @foreach ($images as $image)
                        <img src="{{ URL::to("$layout_path/images-products/$image->name")}}"
                             alt="{{$product->meta_description}}">
                    @endforeach
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="physio-producer">Производитель: {{$product->manufacturer}} </div>
                <div class="physio-producer">Страна производитель: {{$product->country}}</div>
                <div class="stock"><i class="fa fa-check-circle-o"></i><span class="physio-producer">в наличии</span>
                </div>
                <div class="lease-price">{{$product->price}} <i class="fa fa-rub"></i></div>
                <a class="btn-blue btn-blue-slider" href="{{url('card/products/'.$product->slug)}}">Взять в аренду</a>
                <a class="btn-white btn-white-slider" data-toggle="modal" data-target="#exampleModal">Получить
                    консультацию</a>
            </div>
        </div>
    </div>
    <section>
        <div class="nav-pills-bgr"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills">
                        <li class="active">
                            <a href="#1a" data-toggle="tab">Описание</a>
                        </li>
                        <li>
                            <a href="#2a" data-toggle="tab">Характеристики</a>
                        </li>
                        <li>
                            <a href="#3a" data-toggle="tab">Отзывы ({{count($feedback)}})</a>
                        </li>
                        <li>
                            <a href="#4a" data-toggle="tab">Доставка

                            </a>
                        </li>
                        <li>
                            <a href="#5a" data-toggle="tab">О бренде

                            </a>
                        </li>
                    </ul>
                    <div class="tab-content clearfix">
                        <div class="tab-pane active" id="1a">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="module-desc module-desc-mar">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="2a">
                            <div class="module-desc module-desc-mar">
                                {!! $product->attributes !!}
                            </div>
                        </div>
                        <div class="tab-pane" id="3a">
                            <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    @foreach($feedback as $feed)
                                        <div class="doctor-section">
                                            <h5 class="doctor-name">{{$feed->username}}</h5>
                                            <div class="doctor-info">{{$feed->position}}</div>
                                            <p class="doctor-text">{{$feed->message}}</p>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-4 col-sm-4 feedback_div">
                                    <h3 class="module-title">Оставить отзыв</h3>
                                    <form class="form-review" id="feedback_form" action="{{url('feedback')}}"
                                          method="POST">
                                        <input class="review-input form-name" type="text" name="username"
                                               placeholder="Имя" pattern=".{3,20}" required>
                                        <input class="review-input form-name" type="text" name="position"
                                               placeholder="Должность" pattern=".{3,30}" required>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <textarea class="review-input" name="message" placeholder="Ваш отзыв"
                                                  required></textarea>
                                        <input class="btn-blue btn-blue-slider" type="submit" value="Оставить отзыв">
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="4a">
                            <h3 class="module-title delivery-title">Доставка груза</h3>
                            <table class="table delivery-table">
                                <thead>
                                <tr>
                                    <th class="padln">Регион доставки</th>
                                    <th class="tac">Срок доставки</th>
                                    <th class="tac">Стоимость</th>
                                    <th class="tac">Способ оплаты</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="padln">Москва</td>
                                    <td class="tac">1 день</td>
                                    <td class="tac">1500-2000 <i class="fa fa-rub"></i></td>
                                </tr>
                                <tr>
                                    <td class="padln">Московская область</td>
                                    <td class="tac">1-2 дня</td>
                                    <td class="tac">2000-3000 <i class="fa fa-rub"></i></td>
                                    <td class="tac"> Наличными при получении</td>
                                </tr>
                                <tr>
                                    <td class="padln">Санкт Петербург</td>
                                    <td class="tac">2-4 дня </td>
                                    <td class="tac">от 3000 <i class="fa fa-rub"></i></td>
                                    <td class="tac">Безналичная предоплата</td>
                                </tr>
                                <tr>
                                    <td class="padln">Другие регионы</td>
                                    <td class="tac">сроки ТК</td>
                                    <td class="tac">индивидуальная</td>
                                </tr>
                                </tbody>
                            </table>
                            <h3 class="module-title delivery-title">Самовывоз</h3>
                            <table class="table delivery-table">
                                <thead>
                                <tr>
                                    <th class="padln">Пункт самовывоза</th>
                                    <th class="tac">Срок доставки</th>
                                    <th class="tac">Стоимость</th>
                                    <th class="tac">Способ оплаты</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="padln">Москва</td>
                                    <td class="tac">1 день</td>
                                    <td class="tac">бесплатно</td>
                                </tr>
                                <tr>
                                    <td class="padln">Московская область</td>
                                    <td class="tac">1-2 дня</td>
                                    <td class="tac">99 <i class="fa fa-rub"></i></td>
                                    <td class="tac"> Наличными при получении</td>
                                </tr>
                                <tr>
                                    <td class="padln">Санкт Петербург</td>
                                    <td class="tac">2-3 дня </td>
                                    <td class="tac">300 <i class="fa fa-rub"></i></td>
                                    <td class="tac">Карты VISA/MASTERCARD</td>
                                </tr>
                                <tr>
                                    <td class="padln">Другие регионы</td>
                                    <td class="tac">сроки EMS</td>
                                    <td class="tac">500 <i class="fa fa-rub"> </i></td>
                                    <td class="tac">Безналичная предоплата</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="attention-title">Обратите внимание:</div>
                            <div class="attention-info">Делая заказ в нашем интернет-магазине, Вы еще не платите деньги,
                                а всего лишь сообщаете нам о своих намерениях.  В любом случае, Вы имеете право
                                отказаться от заказанного товара до момента его доставки курьером.
                            </div>
                        </div>
                        <div class="tab-pane" id="5a">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <h3 class="module-title">{{$product->manufacturer}}</h3>
                                    <div class="module-desc module-desc-mar">
                                        {!! $product->about_brand !!}
                                    </div>
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
                                <div class="work-scheme-text"><span>1. </span>Выбираете  оборудование <br/>на сайте
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="work-scheme-container"><img class="scheme-icon1"
                                                                    src="{{ URL::to("$layout_path/front/img/general/scheme-icon2.png")}}"
                                                                    alt="icon">
                                <div class="work-scheme-text"><span>2. </span>указываете дату  и время, на которое  вам
                                    нужно оборудование
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="work-scheme-container"><img class="scheme-icon1"
                                                                    src="{{ URL::to("$layout_path/front/img/general/scheme-icon3.png")}}"
                                                                    alt="icon">
                                <div class="work-scheme-text"><span>3. </span>Оплачиваете  онлайн или курьеру  при
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
                                <div class="work-scheme-text"><span>4. </span>Мы доставляем <br/>или вывозите <br/>сами
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="work-scheme-container"><img class="scheme-icon1"
                                                                    src="{{ URL::to("$layout_path/front/img/general/scheme-icon5.png")}}"
                                                                    alt="icon">
                                <div class="work-scheme-text"><span>5. </span>заключаем<br/> договор</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="work-scheme-container"><img class="scheme-icon1"
                                                                    src="{{ URL::to("$layout_path/front/img/general/scheme-icon6.png")}}"
                                                                    alt="icon">
                                <div class="work-scheme-text"><span>6. </span> Вы работаете на <br/>нашем оборудовании
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
                    <div class="modal-title">Получить консультацию </div>
                    <div class="modal-info">Оставьте свой номер телефона и наш менеджер свяжется с вами в течении 10
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