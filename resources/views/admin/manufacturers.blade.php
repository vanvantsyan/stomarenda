@extends('admin_layouts.admin')

@section('content')


    <!-- Main content -->
    <section class="content">
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
            <div class="box-header">
                <h2 class="head_title"> Производители</h2>
                <a href="{{   route( 'create.manufacturer' )}}"
                   type="submit" class="btn btn-primary link_to_add">Создать</a>
            </div>
            <div class="box-body">
                <table class="table table-condensed">
                    <tr style="color:#269abc">
                        <th style="width: 10px">ID</th>
                        <th>Название</th>
                        <th>Страна</th>
                        <th style="width: 80px"></th>
                    </tr>
                    @if ($manufacturers)
                        @foreach ($manufacturers->all() as $manufacturer)

                            <tr>
                                <td>
                                    {{ $manufacturer['id'] }}
                                </td>
                                <td>
                                    <b>
                                        {{ $manufacturer['name'] }}
                                    </b>
                                </td>
                                <td>
                                    {{ $manufacturer['country'] }}
                                </td>

                                <td class="text-right">
                                    <a href="{{   route( 'edit.manufacturer' , ['id'=>$manufacturer['id']])}}"
                                       type="submit" class="btn btn-xs btn-primary" style="width:22px">
                                        <div class="fa fa-edit"></div>
                                    </a>
                                    <a href="{{   route( 'delete.manufacturer' , ['id'=>$manufacturer['id']])}}"
                                       type="submit" class="btn btn-xs btn-danger confirm">
                                        <div class="fa fa-trash-o "></div>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>

        </div>
    </section>
@endsection

