@extends('site_layout.front')
@section('title', $page->title)
@section('description', $page->meta_description)
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">Главная</a></li>
                    <li><a href="{{url('/packages')}}">Пакеты для лицензирования</a></li>
                </ol>
            </div>
        </div>
    </div>
    <section class="physio" style="padding:10px 0 60px 0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><span> Пакеты для лицензирования</span></h1>
                </div>
            </div>
            <div class="row">
                <div class="physio-container-wrap">
                    <div class="physio-bgr-wrap">
                        @foreach ($packages as $key => $package)

                            <div class="col-md-6 col-sm-6 padnone">
                                <a href="{{url('package/'.$package->slug)}}">
                                    <div class="physio-container bgrc-dark">
                                        <div class="physio-img-container"><img
                                                    src="{{ URL::to("$layout_path/images-licensepack/".$package->image)}}"
                                                    alt="{{$package->meta_key}}"></div>
                                        <div class="physio-text-container">
                                            <h3>{{$package->name}}</h3>
                                            <div class="producer"></div>
                                            <div class="lease-price" style="margin-top: 165px;">{{$package->price}} <i class="fa fa-rub"></i></div>
                                            <span class="read-more" style="float:right">Подробнее <i
                                                        class="fa fa-angle-right"></i></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection