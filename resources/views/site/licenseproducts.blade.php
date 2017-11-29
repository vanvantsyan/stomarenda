@extends('site_layout.front')
@section('title', $page->title)
@section('description', $page->meta_description)
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">Главная</a></li>
                    <li><a>Оборудование для лицензирования</a></li>
                </ol>
            </div>
        </div>
    </div>
    <section class="physio" style="padding:10px 0 60px 0">

        <div class="container">
            <div class="row related-products-section">
                <div class="col-md-12">
                    <h1><span>Оборудование для лицензирования</span></h1>
                </div>
                <div class="physio-container-wrap">
                        @foreach($licenseProducts as $licenseProduct)
                        <a  href="{{url('license-product/'.$licenseProduct->slug)}}">
                            <div class="col-md-3 col-sm-6 padnone">
                                <div class="related-product-container bgrc-{{$licenseProduct->color}}" style="height: 340px;">
                                    <div class="related-img-container" style="height: 175px;">
                                        <img src="{{ URL::to("$layout_path/images-licenseprod/".$licenseProduct->image)}}"
                                             alt="{{$licenseProduct->model}}">
                                    </div>
                                    <div class="physio-text-container related-text-container text-center" style=" position: relative;   height: 145px;">
                                        <h2  style="color:grey;line-height: 26px;margin-top: 10px;">{{$licenseProduct->type_name}}
                                        </h2>
                                        <span class="read-more" style="position: absolute;bottom: 5px;right:65px;">Подробнее <i class="fa fa-angle-right"></i></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach

                </div>
            </div>
        </div>

    </section>
@endsection