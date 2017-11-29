@extends('admin_layouts.admin')

@section('content')
    <h2>Производители</h2>
    <div style="width:70%;">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Редактировать производителя</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">

                <form role="form" action="{{route('update.manufacturer')}}" method="POST" enctype="multipart/form-data">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <input name="id" type="hidden" value="{{$manufacturer->id}}"/>

                    <div class="form-group">
                        <label for="exampleInputCategories">Название</label>
                        <input type="text" name="name" class="form-control" id="exampleInputCategories"
                               value="{{$manufacturer->name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputAbout"> О Бренде</label>
                        <textarea class="form-control" name="information" 
                                          id="froala-editor"
                                          placeholder="Описание брендa">{{$manufacturer->information}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputMetaDescription">Страна</label>
                        <input type="text" name="country" class="form-control" id="exampleMetaDescription"
                               value="{{$manufacturer->country}}">
                    </div>
                    <div class="form-group">
                        <label for=" exampleMetaKey">Изменить лого</label>
                        <div>
                            <img src="{{url('public/images-manuf/'.$manufacturer->image)}}" class="admin_images">
                        </div>
                        <input type="file" name="image" id="exampleMetaKey">
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>

            </div>
            <!-- /.box-body -->

        </div>
    </div>


    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


@endsection
