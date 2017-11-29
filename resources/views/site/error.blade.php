@extends('site_layout.front')
@section('title', 'Ошибка')

@section('content')

    <style>


        .full-height {
            height: 500px;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 36px;
            padding: 20px;
        }
    </style>

    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title" style="color:grey">
                @if(!isset($paymentError))
                Извините , вами запрашиваемая страница не найдена.
                    @else
                    {{$paymentError}}
                @endif
            </div>
        </div>
    </div>


@endsection