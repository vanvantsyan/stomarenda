@extends('admin_layouts.admin')

@section('content')
    <div class="row">
        <div class="panel-heading">
            <h2 class="head_title">Заказы</h2>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Список</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Заказано</th>
                                <th>Имя</th>
                                <th>Оборудование/Пакет</th>
                                <th>Тел.</th>
                                <th>Сумма</th>
                                <th>Способ доставки</th>
                                <th>Статус</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach ($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->date}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->product_name}}</td>
                                <td>{{$order->tel}}</td>
                                <td>{{$order->total_amount}}</td>
                                <td>
                                    {{($order->delivery_type == '0')?"Самовывоз":"Доставка"}}
                                </td>
                                <td>
                                    <span class="label label-{{$order->data2['status']}}">{{$order->data2['text']}}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{   route( 'edit.order' , ['id'=>$order->id])}}"
                                       type="submit" class="btn btn-primary btn-xs" style="width:22px">
                                        <div class="fa fa-edit"></div>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    @endsection
