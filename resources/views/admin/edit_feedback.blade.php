@extends('admin_layouts.admin')

@section('content')
    <h2>Отзывы</h2>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Редактировать отзыв</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('update.feedback')}}" method="POST" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <input name="id" type="hidden" value="{{ $feedback->id }}"/>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputName">Имя </label>
                                <input type="text" name="username" class="form-control" id="exampleInputName"  value="{{$feedback->username}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPos">Должность </label>
                                <input type="text" name="position" class="form-control" id="exampleInputPos"  value="{{$feedback->position}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Комментарий </label>
                                <textarea name="message" class="form-control" id="exampleInputName" >{{$feedback->message}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Продукт </label>
                                <input type="text" name="product" readonly class="form-control" id="exampleInputName" value="{{$feedback->product}}">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
