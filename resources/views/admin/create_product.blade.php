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
                        <h3 class="box-title">Добавить оборудование</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('add.products') }}" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputName">Название</label>
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                <input type="text" name="name" class="form-control" id="exampleInputName"
                                       placeholder="Лампа для отбеливания">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputModel">Модель</label>
                                <input type="text" name="model" class="form-control" id="exampleInputModel"
                                       placeholder="Lux  25-10">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPrice">Цена</label>
                                <input type="number" name="price" class="form-control" step="100" min="0" id="exampleInputPrice"
                                       placeholder="3500">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputImage">Главное изображение </label>
                                <small>Рекомендуемый размер (300 x 260)</small>
                                <input type="file" name="image" id="exampleInputImage">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputMainImage">Другие Изображения </label>
                                <small>Рекомендуемый размер (300 x 260)</small>
                                <input type="file" name="images[]" id="exampleInputMainImage" multiple>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFiles">Файлы </label>
                                <input type="file" name="files[]" id="exampleInputFiles" multiple>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputGroup">Группа</label>
                                <select class="form-control" name="group">
                                    <option value="">--Выберите группу--</option>
                                    @foreach ($prodGroups as $prodGroup)
                                        <option value="{{$prodGroup['id']}}">{{$prodGroup['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputGroup">Производитель</label>
                                <select class="form-control" name="manufacturer">
                                    <option value="">--Выберите производителя--</option>
                                    @foreach ($manufacturers as $manufacturer)
                                        <option value="{{$manufacturer['id']}}">{{$manufacturer['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputMetaTitle">Title</label>
                                <input type="text" name="title" class="form-control" id="exampleInputMetaTitle"
                                       placeholder="Title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputMetadesc">Мета-Описание</label>
                                <input type="text" name="meta_desc" class="form-control" id="exampleInputMetadesc"
                                       placeholder="Описание продукта">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputMetaSlug">Seo URL</label>
                                <input required type="text" name="slug" class="form-control" id="exampleInputMetaSlug"
                                       placeholder="fiziodispenser-ac-lux">
                            </div>
                            <div class="form-group">
                                <label for="froala-editor">Описание</label>
                                <textarea id="froala-editor" class="form-control" name="description"
                                          placeholder="Описание продукта"></textarea>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputAttributes"> Характеристика </label>
                                <textarea class="form-control" name="attributes" id="froala-editor"
                                          placeholder="Характеристика продукта"></textarea>
                            </div>
                            
                        </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
                </form>
            </div>

        </div>
    </section>
@endsection
