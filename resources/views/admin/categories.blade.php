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
                <h2 class="head_title"> Категории</h2>
                <a href="{{   route( 'create.category' )}}"
                   type="submit" class="btn btn-primary link_to_add">Создать</a>
            </div>
            <div class="box-body">
                <table class="table table-condensed">
                    <tr style="color:#269abc">
                        <th style="width: 10px">ID</th>
                        <th>Название</th>
                        <th>Мета-key</th>
                        <th>Мета-описание</th>
                    </tr>
                    @if ($categories)
                        @foreach ($categories as $key => $category)

                            <tr>
                                <td>
                                    {{ $category['id'] }}
                                </td>
                                <td>
                                    <b>
                                        {{ $category['name'] }}
                                    </b>
                                </td>
                                <td>
                                    {{ $category['meta_description'] }}
                                </td>
                                <td>
                                    {{ $category['meta_key'] }}
                                </td>

                                <td class="text-right">

                                    <a href="{{   route( 'edit.category' , ['id'=>$category['id']])}}"
                                       type="submit" class="btn btn-xs btn-primary" style="width:22px">
                                        <div class="fa fa-edit"></div>
                                    </a>
                                    <a href="{{   route( 'delete.category' , ['id'=>$category['id']])}}"
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
