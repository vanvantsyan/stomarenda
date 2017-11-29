
@extends('admin_layouts.admin')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h2>Группы</h2>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->

            <div class="col-md-10">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Добавить категории</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('add.productGroup')}}" method="POST" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputName">Название </label>
                                <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Лампы">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Изображение</label>
                                <input type="file" name="image" id="exampleInputFile">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>

                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection
