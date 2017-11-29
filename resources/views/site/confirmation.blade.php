@extends('site_layout.front')
@section('title', 'Результат')
@section('content')

    <section class="container-fluid advantages" id="advantages"><img class="object-left advantages-object-left"
                                                                     src="{{ URL::to("$layout_path/front/img/content/object-left.png")}}"
                                                                     alt="object">
        <div class="container">
            <div class="row">
                <div class="col-md-6 advantages-left" style="height:590px;padding-top:160px">
                    <img class="object-right advantages-object-right"
                         src="{{ URL::to("$layout_path/front/img/content/object-right.png")}}"
                         alt="object">
                    <h2>Ваш заказ оформлен</h2>
                    <div class="advantages-left-text" style="margin-top:0;"> {{$text_all}} </div>
                    <div class="advantages-left-desc">{{$text_online}}</div>
                </div>
                <div class="advantages-right padnone"><img class="advantages-bgr"
                                                           src="{{ URL::to("$layout_path/front/img/content/advantages-bgr.jpg")}}"
                                                           alt="advantages-bgr">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 advantages-items" style="padding: 65px 0;">
                                <div class="advantages-items-row">
                                    <div class="advantages-container"><img
                                                src="{{ URL::to("$layout_path/front/img/content/advantage1.png")}}"
                                                alt="advantage">
                                        <div class="advantages-title">Лидеры <br/>на рынке</div>
                                    </div>
                                    <div class="advantages-container"><img
                                                src="{{ URL::to("$layout_path/front/img/content/advantage2.png")}}"
                                                alt="advantage">
                                        <div class="advantages-title">Индивидуальный <br/>подход к задачам клиента</div>
                                    </div>
                                </div>
                                <div class="advantages-items-row">
                                    <div class="advantages-container"><img
                                                src="{{ URL::to("$layout_path/front/img/content/advantage3.png")}}"
                                                alt="advantage">
                                        <div class="advantages-title">Возможность <br/>онлайн оплаты</div>
                                    </div>
                                    <div class="advantages-container"><img
                                                src="{{ URL::to("$layout_path/front/img/content/advantage4.png")}}"
                                                alt="advantage">
                                        <div class="advantages-title">Оперативная <br/>доставка</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection