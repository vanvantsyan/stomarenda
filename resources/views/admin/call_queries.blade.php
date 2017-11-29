@extends('admin_layouts.admin')

@section('content')
    <div class="row">
        <div class="panel-heading">
            <h2 class="head_title">Заявки на звонки</h2>
        </div>
        <div class="col-sm-12">
            @if ($callQueries)
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Список</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
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
                        <table class="table table-condensed">
                            <tr style="color:#269abc">
                                <th style="width: 10px">ID</th>
                                <th>Имя</th>
                                <th>Номер тел.</th>
                                <th>Дата</th>
                                <th>Статус</th>
                                <th style="width: 40px">Сделано</th>
                            </tr>
                            @foreach ($callQueries as $key => $callQuery)

                                <tr>
                                    <td>
                                        {{ $callQuery['id'] }}
                                    </td>
                                    <td>
                                        <b>
                                            {{ $callQuery['name'] }}
                                        </b>
                                    </td>
                                    <td>
                                        {{ $callQuery['tel'] }}
                                    </td>
                                    <td>
                                        {{ date('Y-m-d',strtotime($callQuery['created_at']))}}
                                    </td>
                                    <?php
                                    $callButton = 'fa-square-o';
                                    $color = 'red';
                                    if ($callQuery['status'] == '1') {
                                        $color = 'green';
                                        $callButton = 'fa-check-square-o';
                                    }
                                    ?>
                                    <td style="color:{{$color}};font-size: 16px;">

                                        <div class="fa {{$callButton}}"></div>
                                    </td>

                                    <td class="text-right">
                                        <?php
                                        $callButton = 'fa-minus';
                                        $status = 'danger';
                                        if ($callQuery['status'] == '0') {
                                            $callButton = 'fa-plus';
                                            $status = 'success';
                                        }
                                        ?>
                                        <a href="{{   route( 'update.callQuery' , ['id'=>$callQuery['id']])}}"
                                           type="submit" class="btn btn-xs btn-{{$status}}" style="width:22px">
                                            <div class="fa {{$callButton}} "></div>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>

            @endif
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.fa-check-square-o').on('click', function () {

            });
        });
    </script>
@endsection
