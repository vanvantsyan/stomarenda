@extends('admin_layouts.admin')

@section('content')
    <h2>Оборудование</h2>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-10">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
            @endif
            <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Редактировать </h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('update.product') }}" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputName">Название</label>
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                <input name="id" type="hidden" value="{{$product->id}}"/>
                                <input type="text" name="name" value="{{$product->name}}" class="form-control"
                                       id="exampleInputName" placeholder="Лампа для отбеливания">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputModel">Модель</label>
                                <input type="text" name="model" value="{{$product->model}}" class="form-control"
                                       id="exampleInputModel" placeholder="Lux  25-10">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPrice">Цена</label>
                                <input type="number" name="price" step="100" min="0" value="{{$product->price}}"
                                       class="form-control"
                                       id="exampleInputPrice" placeholder="3500">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputImage">Главное изображение </label>
                                @if($product->image)
                                    <div>
                                        <img src="{{url('public/images-products/'.$product->image)}}"
                                             class="admin_images">
                                    </div>
                                @endif
                                <input type="file" name="image" id="exampleInputImage">
                            </div>
                            <div class="form-group">
                                <label>Другие Изображения</label>
                                @if(count($images)==0)
                                    <small>(Нету)</small>
                                @endif
                                <div>
                                    @foreach($images as $image)
                                        <a href="{{route('delete.image', ['id' => $image->id ,'path_name' => 'images-products'])}}"
                                           title="Delete">
                                            <img class="admin_images"
                                                 src="{{url('public/images-products/'.$image->name)}}">
                                            <div class="fa fa-remove image-delete">
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <label for="exampleInputMainImage">Добавить </label>
                                <small>Рекомендуемый размер (300 x 260)</small>
                                <input type="file" name="images[]" id="exampleInputMainImage" multiple>
                            </div>
                            <div class="form-group">
                                <label>Файлы</label>
                                @if(count($files))
                                    <small>({{count($files)}} имеется)</small><br>
                                @else
                                    <small>(Нету)</small><br>

                                @endif

                                <label for="exampleInputFiles">Добавить </label>
                                <input type="file" name="files[]" id="exampleInputFiles" multiple>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputGroup">Группа</label>
                                <select class="form-control" name="group_id">
                                    <option value="">--Выберите группу--</option>
                                    @foreach ($prodGroups as $prodGroup)
                                        <option value="{{$prodGroup->id}}" {{ (($product->group_id == $prodGroup->id) ? "selected":"") }}>{{$prodGroup->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputGroup">Производитель</label>
                                <select class="form-control" name="manufacturer_id">
                                    <option value="">--Выберите производителя--</option>
                                    @foreach ($manufacturers as $manufacturer)
                                        <option value="{{$manufacturer->id}}" {{ (($product->manufacturer_id == $manufacturer->id) ? "selected":"") }}>{{$manufacturer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputMetaTitle">Title</label>
                                <input type="text" name="title" class="form-control"  value="{{$product->title}}" id="exampleInputMetaTitle"
                                       placeholder="Title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputMetadesc">Мета-Описание</label>
                                <input type="text" name="meta_desc"  value="{{$product->meta_description}}" class="form-control" id="exampleInputMetadesc"
                                       placeholder="Описание продукта">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputMetaSlug">Seo URL</label>
                                <input required type="text" name="slug" class="form-control"  value="{{$product->slug}}" id="exampleInputMetaSlug"
                                       placeholder="fiziodispenser-ac-lux">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputDesc">Описание</label>
                                <textarea class="form-control" name="description" id="froala-editor"
                                          placeholder="Описание продукта">{{$product->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputAttributes"> Характеристика </label>
                                <textarea class="form-control" name="attributes" id="froala-editor"
                                          placeholder="Характеристика продукта">{{$product->attributes}}</textarea>
                            </div>


                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>

                    </form>
                </div>
                <!-- /.box-body -->


            </div>

        </div>
    </section>
@endsection
