
@extends('admin_layouts.admin')

@section('content')

    <h2>Производители</h2>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->

            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Добавить производителя</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('add.manufacturer')}}" method="POST" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputManufacturer">Имя производителя</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Nouvag">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputAbout"> О Бренде</label>
                                <textarea class="form-control" name="information"
                                          id="froala-editor"
                                          placeholder="Описание брендa"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCountry">Страна</label>
                                <input type="text" name="country" class="form-control" id="exampleInputCountry" placeholder="Англия">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Лого</label>
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
