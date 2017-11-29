@extends('admin_layouts.admin')

@section('content')
    <div>
        <h2 class="head_title">Оборудование для лицензирования</h2>
        <a href="{{   route( 'create.licenseProducts' )}}"
           type="submit" class="btn btn-primary link_to_add">Создать</a>

    </div>
    <div class="panel-body">

        <!-- right column -->
        <div class="col-sm-12">
            @if ($products)

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Список</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table class="table table-condensed">
                                <tr style="color:#269abc">
                                    <th style="width: 10px">ID</th>
                                    <th>Название</th>
                                    <th>Мета-описание</th>
                                    <th>Title</th>
                                    <th>Кол-во</th>
                                </tr>
                                @foreach ($products as $key => $product)

                                    <tr>
                                        <td>
                                            {{ $key+1 }}
                                        </td>
                                        <td>
                                            <b>
                                                {{ $product['type_name'] }}
                                            </b>
                                        </td>
                                        <td>
                                            {{ $product['meta_description'] }}
                                        </td>
                                        <td>
                                            {{ $product['title'] }}
                                        </td>
                                        <td>
                                            {{ count(json_decode($product['product_info'])) }}
                                        </td>
                                        <td class="text-right">
                                            <a href="{{   route( 'edit.licenseProduct' , ['id'=>$product['id']])}}"
                                               type="submit" class="btn btn-xs btn-primary">
                                                <div class="fa fa-edit"></div>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>

            @endif
        </div>
    </div>

@endsection

