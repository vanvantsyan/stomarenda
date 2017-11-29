@extends('admin_layouts.admin')

@section('content')

<h2>Пакеты</h2>
<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-10">

      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Добавить пакет</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="{{route('license.packages')}}" method="POST" enctype="multipart/form-data">
          <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputCategories">Название</label>
              <input type="text" name="name" class="form-control" id="exampleInputCategories" placeholder="Category name">
            </div>
            <div class="form-group">
              <label for="froala-editor">Информация</label>
              <textarea id="froala-editor" name="information" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputMetaKey">Цена</label>
              <input type="number" step="100" min="0" name="price" class="form-control" id="exampleMetaKey" placeholder="2500">
            </div>
            <div class="form-group">
                  <label for="exampleInputFile">Изображение</label>
                  <input type="file" name="image" id="exampleInputFile">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputMetaTitle">Title</label>
                <input type="text" name="title" class="form-control" id="exampleInputMetaTitle"
                       placeholder="Title">
            </div>
            <div class="form-group">
                <label for="exampleInputMetadesc">Мета-Описание</label>
                <input type="text" name="meta_desc" class="form-control" id="exampleInputMetadesc"
                placeholder="Описание продукта">
            </div>
            <div class="form-group">
                <label for="exampleInputMetaSlug">Seo URL</label>
                <input required type="text" name="slug" class="form-control" id="exampleInputMetaSlug"
                placeholder="paket-dlya-licenzirovaniya">
            </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Добавить</button>
          </div>
        </form>
       
      </div>
    </div>
   
 </section>        
 @endsection
