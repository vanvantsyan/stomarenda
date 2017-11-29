@extends('admin_layouts.admin')

@section('content')
<h2>Пакеты</h2>
<section class="content">
     <div class="row">
          <!-- left column -->
          <div class="col-md-10">
               <!-- general form elements -->
               <div class="box box-primary">
                    <div class="box-header with-border">
                         <h3 class="box-title">Редактировать пакет</h3>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form role="form" action="{{route('update.licensePackage')}}" method="POST" enctype="multipart/form-data">
                         <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                         <input name="id" type="hidden" value="{{$package->id}}"/>

                         <div class="box-body">
                              <div class="form-group">
                                   <label for="exampleInputCategories">Название</label>
                                   <input type="text" name="name" value="{{$package->name}}" class="form-control" id="exampleInputCategories" placeholder="Category name">
                            </div>
                            <div class="form-group">
                                   <label for="froala-editor">Информация</label>
                                   <textarea id="froala-editor" name="information"  class="form-control">{{$package->information}}</textarea>
                            </div>
                            <div class="form-group">
                                   <label for="exampleInputMetaKey">Цена</label>
                                   <input type="number" step="100" min="0" name="price"  value="{{$package->price}}" class="form-control" id="exampleMetaKey" placeholder="2500">
                            </div>
                            <div class="form-group">
                                @if($package->image)
                                <div>
                                    <img src="{{url('public/images-licensepack/'.$package->image)}}" class="admin_images">
                                </div>
                                @endif
                                   <label for="exampleInputFile">Изменить изображение</label>
                                   <input type="file" name="image" id="exampleInputFile">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputMetaTitle">Title</label>
                                <input type="text" name="title" class="form-control"  value="{{$package->title}}" id="exampleInputMetaTitle"
                                       placeholder="Title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputMetadesc">Мета-Описание</label>
                                <input type="text" name="meta_desc"  value="{{$package->meta_description}}" class="form-control" id="exampleInputMetadesc"
                                       placeholder="Описание продукта">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputMetaSlug">Seo URL</label>
                                <input required type="text" name="slug" class="form-control"  value="{{$package->slug}}" id="exampleInputMetaSlug"
                                       placeholder="fiziodispenser-ac-lux">
                            </div>
                     </div>
                     <!-- /.box-body -->

                     <div class="box-footer">
                          <button type="submit" class="btn btn-primary">Добавить</button>
                   </div>
            </form>    </div>

     </div>
</section>        
@endsection
