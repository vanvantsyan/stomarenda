@extends('admin_layouts.admin')

@section('content')

    <h2>Страницы</h2>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">

                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Добавить страницу</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('add.page')}}" method="POST">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputpages">Название</label>
                                <input type="text" name="name" class="form-control" id="exampleInputpages"
                                       placeholder="Главная">
                            </div>
                            <div class="form-group">
                                <label for="exampleMetaTitle">Title</label>
                                <input type="text" name="title" class="form-control" id="exampleMetaTitle"
                                       placeholder="Title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputMetaDescription">Мета-описание</label>
                                <input type="text" name="meta-desc" class="form-control" id="exampleMetaDescription"
                                       placeholder="Текс описывающий категорию.">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
