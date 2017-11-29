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
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif
        <div class="row">
            <div class="panel-heading">
                <h2 class="head_title">Оборудование</h2>
                <a href="{{   route( 'create.product' )}}"
                   type="submit" class="btn btn-primary link_to_add">Создать</a>
            </div>
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Список</h3>
                    </div>

                    <div class="box-body table-responsive no-padding">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Модель</th>
                                <th>Цена</th>
                                <th>Производитель</th>
                                <th>Группа</th>
                                <th></th>
                                <!-- <th>Изображение</th> -->
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->model}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->manufacturer}}</td>
                                    <td>{{$product->groups}}</td>
                                <!--  <td>
                                                                      <img src="{{url('public/images-products/'.$product->image)}}" class="admin_images">
                                                                    </td> -->
                                    <td class="text-center">
                                        <a href="{{   route( 'edit.product' , ['id'=>$product->id])}}"
                                           type="submit" class="btn btn-primary btn-xs" style="width:22px">
                                            <div class="fa fa-edit"></div>
                                        </a>
                                        <a href="{{   route( 'delete.product' , ['id'=>$product->id])}}"
                                           type="submit" class="btn btn-danger btn-xs confirm">
                                            <div class="fa fa-trash-o "></div>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>

@endsection
