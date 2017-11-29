<!DOCTYPE html>
<html lang="ru-RU">

<!-- Mirrored from stomarenda.herokuapp.com/build/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Oct 2017 13:40:28 GMT -->
<head>
    <meta charset="utf-8">
    <title>Stomarenda | @yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="@yield('description')">
    <link rel="shortcut icon" type="image/x-png" href="{{ URL::to("$layout_path/front/img/general/logo.png")}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;amp;subset=cyrillic"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&amp;amp;subset=cyrillic"
          rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::to("$layout_path/front/css/main.css")}}">
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

    <!--[if lt IE 9]>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->
</head>
<body>`
<div class="wrapper">
    <header>
        <div id="nav-wraper">
            <div class="container-fluid padnone">
                <nav class="navbar navbar-default">
                    <div class="container">
                        <div class="navbar-header">
                            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false"><span
                                        class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                                        class="icon-bar"></span><span class="icon-bar"></span></button>
                            <a class="navbar-brand" href="{{url('/')}}">
                                <img class="logo" src="{{ URL::to("$layout_path/front/img/general/logo.png")}}"  alt="logo"></a>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href="{{url('/')}}#equipment" data-target="anchor">Оборудование </a></li>
                                <li><a href="{{url('/')}}#scheme" data-target="anchor">Схема работы</a></li>
                                <li><a href="{{url('/packages')}}">Лицензирование </a></li>
                                <li><a href="{{url('/')}}#advantages" data-target="anchor">О нас </a></li>
                                <li><a href="{{url('/')}}#contacts" data-target="anchor">Контакты </a></li>
                            </ul>
                            <div class="nav navbar-nav navbar-right">
                                <div class="navbar-right-maxwidth">
                                    <div class="support" style="margin-top: 10px;">
                                        <div class="tech-sup-hotline"><a href="tel:+8 800 775 8013">8 800 775 8013 </a></div>
                                    </div>
                                    
                                </div>
                                <div class="navbar-right-minwidth"  style="margin-top: 10px;"><a href="tel:+8 800 775 8013">8 800 775 8013</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    @yield('content')
    <footer id="contacts">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 footer-contacts">
                        <h1>Связаться с нами</h1>
                        <div class="address-title">Адрес</div>
                        <i class="fa fa-map-marker"></i>
                        <div class="address-index">117420</div>
                        <div class="address-info">Москва, ул. Наметкина 14, корп.1</div>
                        <div class="address-title">Связаться с нами:</div>
                        <i class="fa fa-mobile"></i>
                        <div class="address-index"><a href="tel:+8 800 775 8013"> 8 800 775 8013 - горячая линия</a></div><br>
                        <i class="fa fa-envelope"></i><a class="address-mail" href="mailto:stomarenda@mail.ru">info@stomarenda.ru</a>
                    </div>
                    <div class="mymap" id="map"></div>
                </div>
            </div>
        </div>
        <div class="container-fluid footer-social">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="footer-social-left">
                            <div class="footer-social-website">Stomarenda © 2017 by United Dental Group</div>
                            <div class="footer-social-website">"Stomarenda". Все права защищены</div>
                        </div>
                        <div class="footer-social-right"><a href="#"><i class="fa fa-vk"></i></a><a href="#"><i
                                        class="fa fa-odnoklassniki"></i></a><a href="#"><i class="fa fa-facebook"> </i></a><a
                                    href="#"><i class="fa fa-youtube"></i></a><a href="#"><i
                                        class="fa fa-instagram"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<script src="{{ URL::to("$layout_path/front/js/jquery.js")}}"></script>
<script src="{{ URL::to("$layout_path/front/js/moment-with-locales.min.js")}}"></script>
<script src="{{ URL::to("$layout_path/front/js/libs.min.js")}}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script src="http://use.fontawesome.com/f7e9c6b655.js"></script>

<script src="{{ URL::to("$layout_path/front/js/additional-methods.min.js")}}"></script>
<script src="{{ URL::to("$layout_path/front/js/jquery.validate.min.js")}}"></script>


{{--<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="{{ URL::to("$layout_path/front/js/main.js")}}"></script>



<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVnfa5DEX_Guotw8R7LcbVbHyjBb6Xlgk&libraries=geometry,places&callback=initAutocomplete" async defer></script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter45210027 = new Ya.Metrika({
                    id:45210027,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });
 
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";
 
        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/45210027" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->



</body>

<!-- Mirrored from stomarenda.herokuapp.com/build/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Oct 2017 13:40:39 GMT -->
</html>