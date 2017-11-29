@extends('admin_layouts.admin')

@section('content')

 <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
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
                <div class="title">
                    Извините , вами запрашиваемая страница не найдена.
                </div>
            </div>
        </div>

@endsection
