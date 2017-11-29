@extends('admin_layouts.admin')

@section('content')
    <h2>Оборудование для лицензирования</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">Добавить оборудование</div>
        <div class="panel-body">

            <form action="{{route('update.licenseProduct')}}" method="POST" enctype="multipart/form-data">
                <div class="col-sm-9">

                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="form-group">
                        <label for="ProdLisName">Тип лицензии </label>
                        <input type="hidden" value="{{$products->id}}" name="id">
                        <input type="text" name="type_name" id="ProdLisName" class="form-control"
                               placeholder="Лицензия для..."
                               value="{{$products->type_name}}">
                    </div>
                    <div class="form-group">
                        @if($products->image)
                            <div>
                                <img src="{{url('public/images-licenseprod/'.$products->image)}}" class="admin_images">
                            </div>
                        @endif
                        <label for="exampleInputFile">Изменить изображение</label>
                        <input type="file" name="image" id="exampleInputFile">
                    </div>
                            <div class="form-group">
                                <label for="exampleInputMetaTitle">Title</label>
                                <input type="text" name="title" class="form-control"  value="{{$products->title}}" id="exampleInputMetaTitle"
                                       placeholder="Title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputMetadesc">Мета-Описание</label>
                                <input type="text" name="meta_desc"  value="{{$products->meta_description}}" class="form-control" id="exampleInputMetadesc"
                                       placeholder="Описание продукта">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputMetaSlug">Seo URL</label>
                                <input required type="text" name="slug" class="form-control"  value="{{$products->slug}}" id="exampleInputMetaSlug"
                                       placeholder="fiziodispenser-ac-lux">
                            </div>
                    <div id="education_fields">
                        <div class="col-sm-6 nopadding">
                            <div class="form-group">
                                <label for="name">Название </label>
                            </div>
                        </div>

                        <div class="col-sm-2 nopadding">
                            <div class="form-group">
                                <label for="name">Цена </label>
                            </div>
                        </div>

                        <div class="col-sm-2 nopadding">
                            <div class="form-group">
                                <label for="name">В наличии </label>
                            </div>
                        </div>

                        <div class="col-sm-2 nopadding">
                            <div class="form-group">
                                <label for="name">Добавить поле </label>
                            </div>
                        </div>
                    </div>
                    <div class="appform">
                        @foreach ($license_product_info as $key => $product_info)

                            <div class="col-sm-6 nopadding">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name[{{$key}}]" placeholder="Название"
                                           value="{{$product_info->name}}">
                                </div>
                            </div>
                            <div class="col-sm-2 nopadding">
                                <div class="form-group">
                                    <input type="number" class="form-control" name="price[{{$key}}]" placeholder="2500"
                                           step="100" min="0"
                                           value="{{$product_info->price}}">
                                </div>

                            </div>
                            <div class="col-sm-2 nopadding">
                                <div class="form-group">
                                    <input type="checkbox" class="have_checkbox" name="have[{{$key}}]"
                                           value="1" {{ ($product_info->have == 1 ? "checked":"") }}>
                                </div>
                            </div>

                        @endforeach


                        <div class="col-sm-2 nopadding">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button class="btn btn-success" type="button" onclick="education_fields();">
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <button type="submit" class="btn btn-primary products_button">Сохранить</button>
                </div>
            </form>
        </div>

        <div class="clear"></div>


        <!-- Javascript -->
        <script type='text/javascript'>

            var room = "<?php echo count($license_product_info) ?>";

            function education_fields() {
                var divtest = "<div class=\"removeclass" + parseInt(room) + '" style="clear:both">';
                divtest +=
                    '<div class="col-sm-6 nopadding">' +
                    '<div class="form-group">' +
                    '<input type="text" class="form-control" name="name[' + room + ']" placeholder="Название">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-sm-2 nopadding">' +
                    '<div class="form-group">' +
                    '<input type="number" class="form-control" name="price[' + room + ']" placeholder="2500" step="100" min="0">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-sm-2 nopadding">' +
                    '<div class="form-group">' +
                    '<input type="checkbox"  class="have_checkbox" name="have[' + room + ']" value="1" >' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-sm-2 nopadding">' +
                    '<div class="form-group">' +
                    '<div class="input-group">' +
                    '<div class="input-group-btn">' +
                    '<button class="btn btn-danger" type="button" onclick="remove_education_fields(' + room + ');">' +
                    '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="clear"></div>';
                divtest += '</div>';
                $('.appform').append(divtest)
                room++;

            }

            function remove_education_fields(rid) {
                $('.removeclass' + rid).remove();
            }
        </script>


@endsection

