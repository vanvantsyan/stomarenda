@extends('admin_layouts.admin')

@section('content')
    <div>
        <h2 class="head_title">Отзывы</h2>
    </div>
    <div class="panel-body">

        <!-- right column -->
        <div class="col-sm-12">
            @if ($feedback)
                <div>

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Список</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
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
                            <table class="table table-condensed">
                                <tr style="color:#269abc">
                                    <th style="width: 10px">ID</th>
                                    <th>Имя</th>
                                    <th>Должность</th>
                                    <th>Комментарий</th>
                                    <th>Продукт</th>
                                    <th style="width: 80px"></th>
                                </tr>
                                @foreach ($feedback as $key => $feed)

                                    <tr>
                                        <td>
                                            {{ $feed['id'] }}
                                        </td>
                                        <td>
                                            <b>
                                                {{ $feed['username'] }}
                                            </b>
                                        </td>
                                        <td>
                                            {{ $feed['position'] }}
                                        </td>
                                        <td>
                                            {{ $feed['message'] }}
                                        </td>
                                        <td>
                                            {{ $feed['product'] }}
                                        </td>

                                        <td class="text-right">

                                            <a href="{{   route( 'edit.feedback' , ['id'=>$feed['id']])}}"
                                               type="submit" class="btn btn-xs btn-primary" style="width:22px">
                                                <div class="fa fa-edit"></div>
                                            </a>
                                            <a href="{{   route( 'delete.feedback' , ['id'=>$feed['id']])}}"
                                               type="submit" class="btn btn-xs btn-danger confirm">
                                                <div class="fa fa-trash-o "></div>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
