@extends('admin_layouts.admin')

@section('content')
    <h2>Сопутствующие товары</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">Добавить</div>
        <div class="panel-body">

            <form action="{{route('add.relatedProduct')}}" method="POST" enctype="multipart/form-data">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputName">Название </label>
                        <input type="text" name="name" class="form-control" id="exampleInputName"
                               placeholder="Лампы">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputModel">Модель </label>
                        <input type="text" name="model" class="form-control" id="exampleInputModel"
                               placeholder="AC 2500">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputProd">Оборудование </label>
                        <select name="group_id" class="form-control" id="exampleInputProd">
                            <option value="">--Выберите оборудование--</option>
                            @foreach($groups as $group)
                                <option value="{{$group->id}}">{{$group->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputManuf">Производитель </label>
                        <select name="manufacturer_id" class="form-control" id="exampleInputManuf">
                            <option  value="">--Выберите производителя--</option>
                            @foreach($manufacturers as $manufacturer)
                                <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPrice">Цена </label>
                        <input type="number" name="price" step="100" min="0" class="form-control"
                               id="exampleInputPrice" placeholder="5000">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Изображение</label>
                        <input type="file" name="image" id="exampleInputFile">
                    </div>
                    <button type="submit" class="btn btn-primary products_button">Добавить</button>

                </div>

            </form>
        </div>

    </div>


@endsection

