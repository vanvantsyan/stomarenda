@extends('admin_layouts.admin')

@section('content')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
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
                <div class="box-header">
                    <h2 class="head_title"> Сопутствующие товары</h2>
                    <a href="{{   route( 'create.relatedProduct' )}}"
                       type="submit" class="btn btn-primary link_to_add">Создать</a>
                </div>
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Модель</th>
                            <th>Оборудование</th>
                            <th>Производитель</th>
                            <th>Цена</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($related_products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->model}}</td>
                                <td>{{$product->group}}</td>
                                <td>{{$product->manufacturer}}</td>
                                <td>{{$product->price}}</td>
                                <td class="text-right">

                                    <a href="{{   route( 'edit.relatedProduct' , ['id'=>$product['id']])}}"
                                       type="submit" class="btn btn-xs btn-primary" style="width:22px">
                                        <div class="fa fa-edit"></div>
                                    </a>
                                    <a href="{{   route( 'delete.relatedProduct' , ['id'=>$product['id']])}}"
                                       type="submit" class="btn btn-xs btn-danger confirm">
                                        <div class="fa fa-trash-o "></div>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </section>

@endsection
