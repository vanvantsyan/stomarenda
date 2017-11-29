@extends('admin_layouts.admin')

@section('content')
    <h2>Группа</h2>
    <div style="width:70%;">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Редактировать группу</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">

                <form role="form" action="{{route('update.productGroup')}}" method="POST" enctype="multipart/form-data">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <input name="id" type="hidden" value="{{$group->id}}"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputName">Название </label>
                            <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Лампы"
                            value="{{$group->name}}">
                        </div>
                        <div class="form-group">

                            <label for="exampleInputFile">Изменить изображение</label>
                            <div>
                                <img src="{{url('public/images-prodgroups/'.$group->image)}}" class="admin_images">
                            </div>
                            <input type="file" name="image" id="exampleInputFile">
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>

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
