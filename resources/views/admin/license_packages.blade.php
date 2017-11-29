@extends('admin_layouts.admin')

@section('content')
    <div>
        <h2 class="head_title">Пакеты лицензирования</h2>
        <a href="{{   route( 'create.licensePackage' )}}"
           type="submit" class="btn btn-primary link_to_add">Создать</a>

    </div>
    <div class="panel-body">

        <!-- right column -->
        <div class="col-sm-12">
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
            @if ($packages)
                <div>

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
                                    <th>Информация</th>
                                    <th>Цена</th>
                                    <th style="width:80px;"></th>
                                </tr>
                                @foreach ($packages as $key => $package)

                                    <tr>
                                        <td>
                                            {{ $package['id'] }}
                                        </td>
                                        <td>
                                            <b>
                                                {{ $package['name'] }}
                                            </b>
                                        </td>
                                        <td>
                                            {!!  $package['information'] !!}
                                        </td>
                                        <td>
                                            {{ $package['price'] }}
                                        </td>

                                        <td class="text-right">
                                            <a href="{{   route( 'edit.licensePackage' , ['id'=>$package['id']])}}"
                                               type="submit" class="btn btn-xs btn-primary" style="width:22px">
                                                <div class="fa fa-edit"></div>
                                            </a>
                                            <a href="{{   route( 'delete.licensePackage' , ['id'=>$package['id']])}}"
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

