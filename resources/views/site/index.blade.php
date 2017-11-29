@extends('site_layout.front')
@section('title', $page->title)
@section('description', $page->meta_description)
@section('content')

    <section class="container-fluid lease"><img class="object-left"
                                                src="{{ URL::to("$layout_path/front/img/content/object-left.png")}}"
                                                alt="object"><img class="object-right"
                                                                  src="{{ URL::to("$layout_path/front/img/content/object-right.png")}}"
                                                                  alt="object"><img class="main-device"
                                                                                    src="{{ URL::to("$layout_path/front/img/content/main-device.png")}}"
                                                                                    alt="device">
        <div class="container">
            <div class="row">
                <div class="col-md-6 lease-section-left">
                    <h1>Аренда стоматологического
 оборудования с доставкой
 или самовывозом</h1>
                 {{--  <a class="btn-white" href="{{url('/category/1')}}">В
                        каталог</a>--}}
                </div>
                <div class="lease-section-right"></div>
            </div>
        </div>
    </section>
    <section class="container-fluid equipment" id="equipment">
        <div class="container padnone">
            <div class="row">
                <div class="col-md-12">
                    <h1>Оборудование</h1>
                </div>
            </div>
            <div class="row equipment-s">
                <div class="col-md-6">
                    <a href="{{url('category/'.$groups[0]->slug)}}">
                        <div class="physioadispersers">
                            <div class="card-hover"></div>
                            <h2>{{$groups[0]->name}}</h2>
                            <img class="physioadisperser-img"
                                 src="{{ URL::to("$layout_path/images-prodgroups/".$groups[0]['image'])}}"
                                 alt="physioadisperser">
                            <img class="object-img"
                                 src="{{ URL::to("$layout_path/front/img/content/object-left.png")}}"
                                 alt="object">
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{url('category/'.$groups[1]->slug)}}">
                                <div class="lamp">
                                    <div class="card-hover"></div>
                                    <h2>{{$groups[1]->name}}</h2>
                                    <img class="lamp-img"
                                         src="{{ URL::to("$layout_path/images-prodgroups/".$groups[1]['image'])}}"
                                         alt="lamp">
                                    <img class="object-img"
                                         src="{{ URL::to("$layout_path/front/img/content/object-left.png")}}"
                                         alt="object">
                                </div>
                            </a>
                        </div>
                        <div class="col-md-12">
                            <a href="{{url('license-products')}}">
                                <div class="complect">
                                    <div class="card-hover"></div>
                                    <h2>{!! $groups[2]->name !!}</h2>
                                    <img class="complect-img"
                                         src="{{ URL::to("$layout_path/images-prodgroups/".$groups[2]['image'])}}"
                                         alt="complect">
                                    <img class="object-img"
                                         src="{{ URL::to("$layout_path/front/img/content/object-left.png")}}"
                                         alt="object">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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
    <section class="container-fluid advantages" id="advantages"><img class="object-left advantages-object-left"
                                                                     src="{{ URL::to("$layout_path/front/img/content/object-left.png")}}"
                                                                     alt="object">
        <div class="container">
            <div class="row">
                <div class="col-md-6 advantages-left"><img class="object-right advantages-object-right"
                                                           src="{{ URL::to("$layout_path/front/img/content/object-right.png")}}"
                                                           alt="object">
                    <h1>Наши преимущества</h1>
                    <div class="advantages-left-text"><a href="#"><span>Stomarenda </span></a>— торгово-производственная
                        компания федерального масштаба
                    </div>
                    <div class="advantages-left-desc">В партнерстве с ведущими производителями медицинской техники
                        Европы и Азии мы создали и успешно развиваем под единой торговой маркой широчайший спектр
                        высококачественного медицинского оборудования.
                    </div>
                </div>
                <div class="advantages-right padnone"><img class="advantages-bgr"
                                                           src="{{ URL::to("$layout_path/front/img/content/advantages-bgr.jpg")}}"
                                                           alt="advantages-bgr">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 advantages-items">
                                <div class="advantages-items-row">
                                    <div class="advantages-container"><img
                                                src="{{ URL::to("$layout_path/front/img/content/advantage1.png")}}"
                                                alt="advantage">
                                        <div class="advantages-title">Лидеры
<br/>на рынке</div>
                                    </div>
                                    <div class="advantages-container"><img
                                                src="{{ URL::to("$layout_path/front/img/content/advantage2.png")}}"
                                                alt="advantage">
                                        <div class="advantages-title">Индивидуальный
<br/>подход к задачам клиента</div>
                                    </div>
                                </div>
                                <div class="advantages-items-row">
                                    <div class="advantages-container"><img
                                                src="{{ URL::to("$layout_path/front/img/content/advantage3.png")}}"
                                                alt="advantage">
                                        <div class="advantages-title">Возможность
<br/>онлайн оплаты</div>
                                    </div>
                                    <div class="advantages-container"><img
                                                src="{{ URL::to("$layout_path/front/img/content/advantage4.png")}}"
                                                alt="advantage">
                                        <div class="advantages-title">Оперативная
<br/>доставка</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container companies-manufacturers">
        <div class="row">
            <div class="col-md-12">
                <h1>КОМПАНИИ-ПРОИЗВОДИТЕЛИ

</h1>
                <div class="owl-carousel">
                    @foreach($manufacturers as $manufacturer)
                        <img class="brand1" src="{{ URL::to("$layout_path/images-manuf/".$manufacturer->image)}}"
                             alt="{{$manufacturer->name}}">
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="container-fluid form"><img class="object-form-right"
                                               src="{{ URL::to("$layout_path/front/img/general/object-form-right.png")}}"
                                               alt="object">
        <div class="container">
            <div class="row">
                <div class="form-left">
                    <div class="form-left-overlay"></div>
                    <img class="form-bgr" src="{{ URL::to("$layout_path/front/img/content/advantages-bgr.jpg")}}"
                         alt="advantages-bgr">
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-6 form-right"><img class="object-form-left"
                                                      src="{{ URL::to("$layout_path/front/img/general/object-form-left.png")}}"
                                                      alt="object"><img class="form-pic"
                                                                        src="{{ URL::to("$layout_path/front/img/general/form-pic.png")}}"
                                                                        alt="photo">
                    <h1>Форма связи </h1>
                    <div class="form-right-desc">Для получения дополнительной информации, пожалуйста, заполните форму и
                        мы обязательно с Вами свяжемся.
                    </div>
                    <div class="callquery_form" style="height: 100px">
                        <form id="form" action="{{url('call')}}" method="POST">
                            <input class="form-input form-name" type="text" name="name" placeholder="Имя"
                                   pattern=".{3,20}" required>
                            <input class="form-input form-tel" type="text" name="tel" placeholder="Телефон"
                                   pattern="[0-9]{6,12}" required>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <button class="btn-blue" type="submit">Перезвоните мне</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
