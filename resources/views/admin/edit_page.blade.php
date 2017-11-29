@extends('admin_layouts.admin')

@section('content')
    <h2>Страницы</h2>
    <div style="width:70%;">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Редактировать</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">

                <form role="form" action="{{route('update.page')}}" method="POST">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <input name="id" type="hidden" value="{{$page->id}}"/>

                    <div class="form-group">
                        <label for="exampleInputpages">Название категории</label>
                        <input readonly type="text" name="name" class="form-control" id="exampleInputpages"
                               value="{{$page->name}}" placeholder="page name">
                    </div>
                    <div class="form-group">
                        <label for=" exampleMetaTitle">Title</label>
                        <input type="text" name="title" class="form-control" id="exampleMetaTitle"
                               value="{{$page->title}}" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputMetaDescription">Мета-описание</label>
                        <input type="text" name="meta-desc" class="form-control" id="exampleMetaDescription"
                               value="{{$page->meta_description}}" placeholder="Meta-Description">
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>

            </div>
            <!-- /.box-body -->

        </div>
    </div>


    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


@endsection
