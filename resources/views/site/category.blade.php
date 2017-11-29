@extends('site_layout.front')
@section('title', $page->title)
@section('description', $page->meta_description)
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">Главная</a></li>
                    <li class="active"><span>{{$group->name}}</span></li>
                </ol>
            </div>
        </div>
    </div>
    <section class="physio">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{$group->name}}</h1>
                </div>
            </div>
            <div class="row">
                <div class="physio-container-wrap">
                    <div class="physio-bgr-wrap">
                        @foreach ($products as $product)
                            <div class="col-md-6 col-sm-6 padnone">
                                <div class="physio-container bgrc-dark">
                                    <a href="{{url('product/'.$product->slug)}}">
                                        <div class="physio-img-container"><img
                                                    src="{{ URL::to("$layout_path/images-products/".$product->image)}}"
                                                    alt="{{$product->meta_key}}"></div>
                                        <div class="physio-text-container">
                                            <h3>{{$product->name}} <span>{{$product->model}}</span></h3>
                                            <div class="producer">{{$product->manufacturer}}
                                                , {{$product->country}}</div>
                                            <div class="lease-time">Аренда в день</div>
                                            <div class="lease-price">{{$product->price}} <i class="fa fa-rub"></i></div>
                                            <span class="read-more" style="float:right">Подробнее <i
                                                        class="fa fa-angle-right"></i></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row related-products-section">
                <div class="col-md-12">
                    <h1>сопутствующие товары
</h1>
                </div>
                <div class="physio-container-wrap">
                  
                    @foreach($related_products as $related_product)
                        <div class="col-md-3 col-sm-6 padnone">
                            <div class="related-product-container bgrc-{{$related_product->background}}">
                                <div class="related-img-container">
                                    <img src="{{ URL::to("$layout_path/images-related/".$related_product->image)}}"
                                         alt="{{$related_product->model}}">
                                </div>
                                <div class="physio-text-container related-text-container">
                                    <h3>{{$related_product->name}} <span>{{$related_product->model}} </span><span
                                                class="quantity">(1 шт)</span>
                                    </h3>
                                    <div class="producer">{{$related_product->manufacturer}}
                                        , {{$related_product->country}}</div>
                                    <div class="lease-price">{{$related_product->price}} <i class="fa fa-rub"></i></div>
                                    {{--<a class="read-more" href="#">Подробнее</a><i class="fa fa-angle-right"></i>--}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <section class="container companies-manufacturers">
            <div class="row">
                <div class="col-md-12">
                    <h1>КОМПАНИИ-ПРОИЗВОДИТЕЛИ

</h1>
                    <div class="owl-carousel">
                        @foreach($manufacturers as $manufacturer)
                            <img class="brand1"
                                 src="{{ URL::to("$layout_path/images-manuf/".$manufacturer->image)}}"
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
                        <img class="form-bgr"
                             src="{{ URL::to("$layout_path/front/img/content/advantages-bgr.jpg")}}"
                             alt="advantages-bgr">
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6 form-right"><img class="object-form-left"
                                                          src="{{ URL::to("$layout_path/front/img/general/object-form-left.png")}}"
                                                          alt="object"><img class="form-pic"
                                                                            src="{{ URL::to("$layout_path/front/img/general/form-pic.png")}}"
                                                                            alt="photo">
                        <h1>Форма связи </h1>
                        <div class="form-right-desc">Для получения дополнительной информации, пожалуйста, заполните
                            форму и
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
    </section>
@endsection