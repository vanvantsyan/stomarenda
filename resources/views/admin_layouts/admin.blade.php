<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="{{ URL::to("$layout_path/logo.jpg") }}" type="image/x-icon">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>СтомАренда Страница Администратора</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::to("$layout_path/css/bootstrap.min.css")}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL::to("$layout_path/css/sb-admin.css")}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ URL::to("$layout_path/css/plugins/morris.css")}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ URL::to("$layout_path/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ URL::to("$layout_path/css/AdminLTE.min.css")}}">

    <link rel="stylesheet" href="{{ URL::to("$layout_path/css/admin_side.css")}}">
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ URL::to("$layout_path/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">

    <link rel="stylesheet" href="{{ URL::to("$layout_path/css/skins/_all-skins.min.css")}}">

    <!-- Text Editor -->

    <link rel="stylesheet" href="{{ URL::to("$layout_path/css/codemirror.min.css")}}">

    <link rel="stylesheet" href="{{ URL::to("$layout_path/css/froala_editor.pkgd.min.css")}}">

    <link rel="stylesheet" href="{{ URL::to("$layout_path/css/froala_style.min.css")}}">


    <!-- jQuery -->
    <script src="{{ URL::to("$layout_path/js/jquery.js")}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::to("$layout_path/js/bootstrap.min.js")}}"></script>

    <!-- Confirmation Javascript -->
    <script src="{{ URL::to("$layout_path/js/jquery.confirm.js")}}"></script>

    <script src='{{ URL::to("$layout_path/js/moment.min.js")}}'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.6.2/fullcalendar.min.css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
@php
    $active = URL::to("/admin/stats");
@endphp
@if(Session::get('active'))
    @php
        $active = URL::to("/admin/".Session::get('active'));
    @endphp

@endif
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation"
         style="background-color: #fff;border-color: lightblue;">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a href="index.html">
                <img src="{{ URL::to("$layout_path/logo.jpg") }}" width="223" height="69">
            </a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-nav navbar-right" style="margin:9px" >
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>


        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav" style="background:white">
                <li>
                    <a href="{{ URL::to("/admin/stats") }}"><i class="fa fa-fw fa-fw fa-table"></i> Календарь </a>
                </li>
                <li>
                    <a href="{{ URL::to("/admin/orders") }}"><i class="fa fa-fw fa-edit"></i> Заказы
                        <small class="label pull-right bg-red order-label">{{$data['unseen_orders']}}</small>
                    </a>
                </li>
                <li>
                    <a href="{{ URL::to("/admin/call_queries") }}"><i class="fa fa-fw fa-phone"></i> Заявки на звонки
                        <small class="label pull-right bg-red call-label">{{$data['unseen_calls']}}</small>
                    </a>
                </li>
                <li>
                    <a href="{{ URL::to("/admin/products") }}"><i class="fa fa-fw fa-stethoscope"></i> Оборудование </a>
                </li>
                <li>
                    <a href="{{ URL::to("/admin/related_products") }}"><i class="fa fa-fw fa-table"></i> Сопутствующие
                        товары
                    </a>
                </li>
                <li>
                    <a href="{{ URL::to("/admin/license_products") }}"><i class="fa fa-fw fa-table"></i> Оборудование
                        для
                        лиц.</a>
                </li>
                <li>
                    <a href="{{ URL::to("/admin/license_packages") }}"><i class="fa fa-fw fa-suitcase"></i> Пакеты
                        лицензирования </a>
                </li>
                <li>
                    <a href="{{ URL::to("/admin/feedback") }}"><i class="fa fa-fw fa-comments-o"></i> Отзывы
                        <small class="label pull-right bg-red feedback-label">{{$data['unseen_feedback']}}</small>
                    </a>
                </li>
                <li>
                    <a href="{{ URL::to("/admin/manufacturers") }}"><i class="fa fa-fw fa-table"></i> Производители </a>
                </li>
                <li>
                    <a href="{{ URL::to("/admin/pages") }}"><i class="fa fa-fw fa-th"></i> Страницы </a>
                </li>
                <li>
                    <a href="{{ URL::to("/admin/productGroups") }}"><i class="fa fa-fw fa-table"></i> Категории
                    </a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>


    <div id="page-wrapper">

        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
</div>

<<!-- confirmation -->
<script>

    $(".confirm").confirm();

    $('#select_input').change(function () {
        var color;
        if ($(this).val() == 0) {
            color = 'red';
        }
        else if ($(this).val() == 1) {
            color = 'orange';
        }
        else if ($(this).val() == 2) {
            color = 'green';
        }
        $(this).css("border", "1px solid " + color);

    });
    $(function () {
        $('textarea#froala-editor').froalaEditor()
    });
    $(function () {
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false,
//            'sort': [[1,'desc']]
        });
    });
    //Menu active page
    $(document).ready(function () {

        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }

        if (mm < 10) {
            mm = '0' + mm
        }

        today = mm + '/' + dd + '/' + yyyy;
        $('#calendar').fullCalendar({
            defaultDate: today,
            editable: false,
            eventLimit: false,
            height: 450,
            header: {
                left: 'title',
                center: '',
                right: 'prev,next today'
            },
            prev: 'left-single-arrow',
            next: 'right-single-arrow',
            prevYear: 'left-double-arrow',
            nextYear: 'right-double-arrow',
            themeSystem: 'bootstrap3',

        });
        $('#calendar').fullCalendar('next');

        var select = $('#select_input').val();
        if (select == 0) {
            var color = 'red';
        }
        else if (select == 1) {
            var color = 'orange';
        }
        else if (select == 2) {
            var color = 'green';
        }
        $('#select_input').css("border", "1px solid " + color);
        $('a[href="<?php echo $active ?>"]').parents('li').addClass('active');
        var audio = new Audio("{{ URL::to("$layout_path/bells/doorbell-5.wav") }}");
        $.ajaxSetup({ cache: false });
        setInterval(function() {

               $.get("/admin/feedback_check","",function(data) {
                    if(data)
                        {
                            $('.feedback-label').html(data)
                        }
            });
               $.get("/admin/order_check","",function(data) {
                    if(data)
                        {
                            if($('.order-label').html() != data){
                                audio.play();
                                $('.order-label').html(data)
                            }
                        }
            });
               $.get("/admin/call_check","",function(data) {
                    if(data)
                        {
                            if($('.call-label').html() != data){
                                audio.play();
                                $('.call-label').html(data)
                            }
                        }
            });
        }, 30000); 

    });
            {{--
               function check_all(order, call, feedback) {
                 var audio = new Audio("{{ URL::to("$layout_path/bells/doorbell-5.wav") }}");
        var order = $('.order-label').html();
        var call = $('.call-label').html();
        var feedback = $('.feedback-label').html();
        if (order == "") {
            order = 0;
        }
        if (call == "") {
            call = 0;
        }
        if (feedback == "") {
            feedback = 0;
        }
        $.ajax(
            {
                type: 'GET',
                url: '/admin/check_all',
                data: {
                    order: order,
                    call: call,
                    feedback: feedback
                },
                success: function (data) {
                    data = JSON.parse(data);
                    if ($('.call-label').html() != data.call) {
                        audio.play();
                        $('.call-label').html(data.call)
                    }
                    if ($('.order-label').html() != data.order) {
                        audio.play();
                        $('.order-label').html(data.order)
                    }
                    if ($('.feedback-label').html() != data.feedback) {
                        $('.feedback-label').html(data.feedback)
                    }
                    check_all(data.order, data.call, data.feedback);
                }

            }
        );
    }*/

    $(function () {
        check_all();
    });
  --}}

</script>
<script src="{{ asset('public/js/app.js') }}"></script>

<!-- jQuery -->
<script src="{{ URL::to("$layout_path/js/jquery.js")}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ URL::to("$layout_path/js/bootstrap.min.js")}}"></script>

<!-- Datatables Core JavaScript -->
<script src="{{ URL::to("$layout_path/datatables.net/js/jquery.dataTables.min.js")}}"></script>
<script src="{{ URL::to("$layout_path/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.6.2/fullcalendar.min.js"></script>


<!-- Text Editor -->
<script src="{{ URL::to("$layout_path/js/codemirror.min.js")}}"></script>

<script src="{{ URL::to("$layout_path/js/xml.min.js")}}"></script>

<script src="{{ URL::to("$layout_path/js/froala_editor.pkgd.min.js")}}"></script>

<!-- Morris Charts JavaScript 
<script src="{{ URL::to("$layout_path/js/plugins/morris/raphael.min.js")}}"></script>
<script src="{{ URL::to("$layout_path/js/plugins/morris/morris.min.js")}}"></script>
<script src="{{ URL::to("$layout_path/js/plugins/morris/morris-data.js")}}"></script>
-->
</body>

</html>
