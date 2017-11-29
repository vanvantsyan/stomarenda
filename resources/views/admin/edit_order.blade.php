@extends('admin_layouts.admin')

@section('content')
    <h2>Заказы</h2>
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
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{Session::get('error')}}
                    </div>
            @endif
            <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Редактировать </h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">

                        <div class="row">
                            <form role="form" method="POST" action="{{route('update.order') }}"
                                  enctype="multipart/form-data">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputName">Имя</label>
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                        <input name="id" type="hidden" value="{{$order->id}}"/>
                                        <input name="product_type" type="hidden" value="{{$order->product_type}}"/>
                                        <input type="text" name="name" value="{{$order->name}}"
                                               class="form-control"
                                               id="exampleInputName">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputModel">Телефон</label>
                                        <input type="text" name="tel" value="{{$order->tel}}"
                                               class="form-control"
                                               id="exampleInputModel">
                                    </div>
                                    @if($order->product_type == "products")
                                        <label for="examplePeriod">Срок аренды</label>
                                        <div class=" form-inline col-md-12">
                                            <div class="row" id="examplePeriod">
                                                <div class="col-md-6 no-padding ">
                                                    <label for="exampleInputFrom">С</label>
                                                    <input type="text" name="from_date" value="{{$order->from_date}}"
                                                           class="form-control admin_form_dates"
                                                           id="exampleInputFrom">
                                                </div>
                                                <div class="col-md-6 no-padding ">
                                                    <label for="exampleInputTo">До</label>
                                                    <input type="text" name="to_date" value="{{$order->to_date}}"
                                                           class="form-control admin_form_dates"
                                                           id="exampleInputTo ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputTime">Время</label>

                                            <select class="form-control" name="time" id="exampleInputTime">
                                                <option value="09:00" {{ $order->time == '09:00' ? 'selected' : '' }}>
                                                    09:00
                                                </option>
                                                <option value="10:00" {{ $order->time == '10:00' ? 'selected' : '' }}>
                                                    10:00
                                                </option>
                                                <option value="11:00" {{ $order->time == '11:00' ? 'selected' : '' }}>
                                                    11:00
                                                </option>
                                                <option value="12:00" {{ $order->time == '12:00' ? 'selected' : '' }}>
                                                    12:00
                                                </option>
                                                <option value="13:00" {{ $order->time == '13:00' ? 'selected' : '' }}>
                                                    13:00
                                                </option>
                                                <option value="14:00" {{ $order->time == '14:00' ? 'selected' : '' }}>
                                                    14:00
                                                </option>
                                                <option value="15:00" {{ $order->time == '15:00' ? 'selected' : '' }}>
                                                    15:00
                                                </option>
                                                <option value="16:00" {{ $order->time == '16:00' ? 'selected' : '' }}>
                                                    16:00
                                                </option>
                                                <option value="17:00" {{ $order->time == '17:00' ? 'selected' : '' }}>
                                                    17:00
                                                </option>
                                                <option value="18:00" {{ $order->time == '18:00' ? 'selected' : '' }}>
                                                    18:00
                                                </option>
                                                <option value="19:00" {{ $order->time == '19:00' ? 'selected' : '' }}>
                                                    19:00
                                                </option>
                                            </select>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="exampleInputModel">Название</label>
                                        <input readonly type="text" name="product_name" value="{{$order->product_name}}"
                                               class="form-control"
                                               id="exampleInputModel">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputRelPrice">Цена оборудований/пакета (руб.)</label>
                                        <input type="number" min="0" step="100" name="product_price"
                                               value="{{$order->product_price}}"
                                               class="form-control"
                                               id="exampleInputRelPrice">
                                    </div>
                                    @if($order->product_type == 'products')
                                        <div class="row">
                                            <div class="col-md-12">

                                                @foreach($related_products as  $key => $related_product)
                                                    <label for="exampleInputCount">Соп.
                                                        товар: {{$related_product->name.' '.$related_product->model}}</label>
                                                    <div class="form-inline">
                                                        <input type="number" style="width:70px;" min="0" readonly
                                                               name="related_count[]"
                                                               value="{{$rel_counts[$key]}}"
                                                               class="form-control "
                                                               id="exampleInputCount">
                                                        <small>(шт.)</small>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputRelPrice">Цена сопутствующих товаров (руб.)</label>
                                            <input type="number" min="0" step="100" name="related_price"
                                                   value="{{$order->related_price}}"
                                                   class="form-control"
                                                   id="exampleInputRelPrice">
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="exampleInputPrice">Эл. почта</label>
                                        <input type="text" name="email" value="{{$order->email}}"
                                               class="form-control"
                                               id="exampleInputPrice">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputAddress">Адрес доставки</label>
                                        <input type="text" name="address" value="{{$order->address}}"
                                               class="form-control"
                                               id="exampleInputAddress">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPrice">Компания</label>
                                        <input type="text" name="company_name" value="{{$order->company_name}}"
                                               class="form-control"
                                               id="exampleInputPrice">
                                    </div>


                                </div>

                                <div class="col-md-6">
                                    @if($order->product_type != 'packages')
                                        <label for="del_type">Способ доставки</label>
                                        <div class="form-group" id="del_type">
                                            <input {{ $order->delivery_type == '0' ? 'checked' : '' }}  type="radio"
                                                   name="delivery_type" value="0" id="exampleInputDelType2">
                                            <label for="exampleInputDelType1">Самовывоз</label>
                                            <input {{ $order->delivery_type == '1' ? 'checked' : '' }}  type="radio"
                                                   name="delivery_type" value="1" id="exampleInputDelType2">
                                            <label for="exampleInputDelType2">Доставка</label>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="exampleInputPrice">Цена доставки (руб.)</label>
                                        <input type="number" name="delivery_fee" step="100" min="0"
                                               value="{{$order->delivery_fee}}"
                                               class="form-control"
                                               id="exampleInputPrice">
                                    </div>

                                    <label for="pay_type">Способ оплаты</label>
                                    <div class="form-group">
                                        <input type="radio" name="pay_type"
                                               {{ $order->pay_type == '0' ? 'checked' : '' }}
                                               id="pay_type1" value="0">
                                        <label for="exampleInputPrice">Наличные при получении</label>
                                        <input type="radio" name="pay_type"
                                               {{ $order->pay_type == '1' ? 'checked' : '' }}
                                               id="pay_type2" value="1">
                                        <label for="exampleInputPrice">Безналичная оплата </label>
                                        <input type="radio" name="pay_type"
                                               {{ $order->pay_type == '2' ? 'checked' : '' }}
                                               id="pay_type3" value="2">
                                        <label for="exampleInputPrice">Онлайн оплата</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPrice">Итоговая сумма (руб.)</label>
                                        <input type="number" name="total_amount" step="100" min="0"
                                               value="{{$order->total_amount}}"
                                               class="form-control"
                                               id="exampleInputPrice">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPrice">Дата</label>
                                        <input type="text" name="date" value="{{$order->date}}"
                                               class="form-control"
                                               id="exampleInputPrice">
                                    </div>
                                    @if($order->pay_type == '2' && $order->status == '2')
                                        <div class="form-group">
                                            <label for="exampleInputPrice">Оплачено (руб.)</label>
                                            <input type="text" readonly name="text" value="{{$order->payed_amount}}"
                                                   class="form-control"
                                                   id="exampleInputPrice">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPrice">Дата оплаты</label>
                                            <input type="text" readonly name="text" value="{{$order->payed_time}}"
                                                   class="form-control"
                                                   id="exampleInputPrice">
                                        </div>
                                    @endif

                                </div>
                                <div class="form-group col-md-2 col-md-offset-5 ">

                                    <label for="select_input">Статус заказа</label>
                                    <select class="form-control " name="status" id="select_input">
                                        <option
                                                value="0" {{ (($order->status == "0") ? "selected":"") }}>Отказ
                                        </option>
                                        <option
                                                value="1" {{ (($order->status == "1") ? "selected":"") }}>Ожидание
                                        </option>
                                        <option
                                                value="2" {{ (($order->status == "2") ? "selected":"") }}>Оплачен
                                        </option>
                                    </select>
                                    {{--value="{{$order->status}}"--}}
                                    <div class="box-footer" style="padding: 10px 0;">
                                        <button type="submit" class="btn btn-primary">Сохранить</button>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <hr>
                        <div class='center'>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputDocsEmail">Отправить документы</label>
                                    <div>
                                        <h6>
                                            {!! $order->data_email['checked'] !!}
                                            {{  $order->data_email['description']}}
                                        </h6>
                                        <form action="{{route('sendDocs')}}" method="POST" id="formSendDocs">
                                            <input type="hidden" name="name" value="{{$order->name}}">
                                            <input type="hidden" name="email" value="{{$order->email}}">
                                            <input type="hidden" name="product_name" value="{{$order->product_name}}">
                                            <input type="hidden" name="id" value="{{$order->product_id}}">
                                            <input type="hidden" name="order_id" value="{{$order->id}}">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <button form="formSendDocs" type="submit" class=" btn btn-sm btn-success"
                                                    id="exampleInputDocsEmail"> {{$order->data_email['send']}} </button>
                                        </form>
                                    </div>
                                </div>
                                @if($order->pay_type == '2')
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputDocsEmail">Выставить счет</label>
                                        <div>
                                            <h6>
                                                {!! $order->data_payment['checked'] !!}
                                                {{ $order->data_payment['description'] }}
                                            </h6>
                                            <form action="{{route('sendRoboCheck')}}" method="POST" id="formSendCheck">
                                                {!! csrf_field() !!}


                                                <input type="hidden" name="name" value="{{$order->name}}">
                                                <input type="hidden" name="email" value="{{$order->email}}">
                                                <input type="hidden" name="id" value="{{$order->id}}">
                                                <input type="hidden" name="from_date" value="{{$order->from_date}}">
                                                <input type="hidden" name="to_date" value="{{$order->to_date}}">
                                                <input type="hidden" name="product_id" value="{{$order->product_id}}">
                                                <input type="hidden" name="product_name"
                                                       value="{{$order->product_name}}">
                                                <input type="hidden" name="product_price"
                                                       value="{{$order->product_price}}">
                                                <input type="hidden" name="related_price"
                                                       value="{{$order->related_price}}">
                                                <input type="hidden" name="related_count"
                                                       value="{{$order->related_count}}">
                                                <input type="hidden" name="related_product"
                                                       value="{{$order->related_product}}">
                                                <input type="hidden" name="related_product_id"
                                                       value="{{$order->related_product_id}}">
                                                <input type="hidden" name="delivery_fee"
                                                       value="{{$order->delivery_fee}}">
                                                <input type="hidden" name="total_amount"
                                                       value="{{$order->total_amount}}">
                                                <button form="formSendCheck" type="submit"
                                                        class=" btn btn-sm btn-success"
                                                        id="exampleInputDocsEmail"> {{$order->data_payment['send']}} </button>
                                            </form>

                                        </div>
                                    </div>
                                @endif
                            </div>


                        </div>

                    </div>

                    <div class="box-footer">

                        <div style="float:right;">
                            <a href="{{   route( 'delete.order' , ['id'=>$order->id])}}"
                               type="submit" title="Удалить заказ"
                               class="btn  btn-danger btn-xs confirm text-right">
                                <div class="fa fa-trash-o "></div>
                            </a>
                        </div>

                    </div>


                </div>
                <!-- /.box-body -->


            </div>

        </div>
    </section>
@endsection
