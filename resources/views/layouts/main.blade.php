<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="{{ app()->getLocale() }}" class="no-js"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
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
        .top-right {
            background-color: #e0e9fc;
            position: absolute;
            right: 10px;
            top: 18px;
        }
        .content {
            text-align: center;
        }
        .title {
            font-size: 84px;
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .m-b-md {
            margin-bottom: 30px;
        }

        .dop-header a{
            color: #3049ec!important;
            /*text-transform: none!important;*/
        }
    </style>

    @php

        echo "<style>";
        include  "/css/inheader.css";
        echo "</style>";

    @endphp

    <link href="/css/misc.css" rel="stylesheet" type="text/css">
    <link href="/css/main.css" rel="stylesheet" type="text/css">
    <link href="/css/global.css" rel="stylesheet" type="text/css">
    <link href="/css/other.css" rel="stylesheet" type="text/css">

</head>
<body>


<header>
    <div class="header-wraper">
        <div class="header-block">
            <div class="header-box">

                <div class="header-logo-block">
                    <a class="header-logo-link" href="/" >
                        <img src="/img/logo.png">
                    </a>

                    <div class="header-phones-up">
                        <a href="tel:+380505310613" class="header-menu-phone">
                            (050) 531-06-13
                        </a>
                        <a href="tel:+380487061030" class="header-menu-phone">
                            (048) 706-10-30
                        </a>
                    </div>

                    <div class="header-menu-button">
                        <div class="menu icon"></div>
                    </div>
                </div>






                <div class="header-drop-mob">
                    <div class="header-zayavka-mob">

                    </div>

                    <div class="header-menu-block">
                        <div class="header-menu-box">

                            <div class="header-menu-phones">
                                <div class="header-menu-phones-box">
                                    <div class="header-menu-phone-icon">
                                        <img class="header-menu-phone-img" src="/img/header_phone.png">
                                    </div>
                                    <a href="tel:+380505310613" class="header-menu-phone">
                                        (050) 531-06-13
                                    </a>
                                    <a href="tel:+380487061030" class="header-menu-phone">
                                        (048) 706-10-30
                                    </a>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="header-menu-items">
                                <div id="menu-item-uslugi" class="header-menu-item">
                                    <div class=" header-menu-item-dop" data-link="/services">
                                        <div class="header-menu-item-word">Услуги</div>
                                        <div class="fa-down-open header-chevron" ></div>
                                        <!--<div class="fa fa-comment" ></div>-->
                                    </div>
                                    <div class="header-menu-drop">
                                        <div class="h-m-drop-col">
                                            <div class="h-m-drop-item">
                                                <a href="/services/ocenka-nedvizhimosti-v-odesse">
                                                    <span>Оценка недвижимости</span>
                                                </a>
                                            </div>
                                            <div class="itempadding h-m-drop-item">
                                                <a href="/services/ocenka-nedvizhimosti-v-odesse/ocenka-kvartiry-v-odesse">
                                                    <span>Оценка квартиры</span>
                                                </a>
                                            </div>
                                            <div class="itempadding h-m-drop-item">
                                                <a href="/services/ocenka-nedvizhimosti-v-odesse/ocenka-chasti-kvartiry">
                                                    <span>Оценка части квартиры</span>
                                                </a>
                                            </div>
                                            <div class="itempadding h-m-drop-item">
                                                <a href="/services/ocenka-nedvizhimosti-v-odesse/ocenka-komnaty-v-kommune">
                                                    <span>Оценка комнаты в коммуне</span>
                                                </a>
                                            </div>
                                            <div class="itempadding h-m-drop-item">
                                                <a href="/services/ocenka-nedvizhimosti-v-odesse/ocenka-doma-v-odesse">
                                                    <span>Оценка дома</span>
                                                </a>
                                            </div>
                                            <div class="itempadding h-m-drop-item">
                                                <a href="/services/ocenka-nedvizhimosti-v-odesse/ocenka-kommercheskoj-hedvizhimosti-v-odesse">
                                                    <span>Оценка коммерческой недвижимости</span>
                                                </a>
                                            </div>
                                            <div class="itempadding h-m-drop-item">
                                                <a href="/services/ocenka-nedvizhimosti-v-odesse/ocenka-dlya-sdachi-v-arendu-odessa">
                                                    <span>Оценка для сдачи в аренду</span>
                                                </a>
                                            </div>
                                            <div class="itempadding h-m-drop-item">
                                                <a href="/services/ocenka-zemli-v-odesse">
                                                    <span>Оценка земли</span>
                                                </a>
                                            </div>
                                            <div class="h-m-drop-item">
                                                <a href="/services/ocenka-imuchestva-v-odesse">
                                                    <span>Оценка имущества</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="h-m-drop-col">

                                            <div class="h-m-drop-item">
                                                <a href="/services/zemleustroitelnyie-rabotyi-v-odesse">
                                                    <span>Землеустроительные работы</span>
                                                </a>
                                            </div>
                                            <div class="h-m-drop-item">
                                                <a href="/services/ocenka-avto-odessa">
                                                    <span>Оценка автотранспорта</span>
                                                </a>
                                            </div>

                                            <div class="h-m-drop-item">
                                                <a href="/services/ocenka-kredita-odessa">
                                                    <span>Оценка для кредита</span>
                                                </a>
                                            </div>
                                            <div class="h-m-drop-item">
                                                <a href="/services/ocenka-vstupleniya-v-nasledstvo-odessa">
                                                    <span>Оценка для вступления в наследство</span>
                                                </a>
                                            </div>

                                            <div class="h-m-drop-item">
                                                <a href="/services/ocenka-dlya-nalogooblozheniya-v-odesse">
                                                    <span>Оценка для налогообложения</span>
                                                </a>
                                            </div>

                                            <div class="h-m-drop-item">
                                                <a href="/services/ocenka-dlya-notariusa-v-odesse">
                                                    <span>Оценка для нотариуса</span>
                                                </a>
                                            </div>

                                            <div class="h-m-drop-item">
                                                <a href="/services/ocenka-dlya-dogovora-v-odesse">
                                                    <span>Оценка для договора</span>
                                                </a>
                                            </div>

                                            <div class="h-m-drop-item">
                                                <a href="/services/ocenka-ysherba-nedvijimosti">
                                                    <span>Оценка ущерба недвижимости</span>
                                                </a>
                                            </div>
                                            <div class="h-m-drop-item">
                                                <a href="/services/ocenka-ysherba-avto">
                                                    <span>Оценка ущерба авто</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/products" class="header-menu-item">
                                    Кухни
                                </a>
                                <a href="/ocenka-blog" class="header-menu-item">
                                    Блог
                                </a>
                                <a href="/about" class="header-menu-item">
                                    О Компании
                                </a>
                                <a href="/contact" class="header-menu-item">
                                    Контакты
                                </a>
                                <div class="clear"></div>
                            </div>

                            <div class="header-menu-phones-mob">
                                <div class="header-menu-phones-box">
                                    <a href="tel:+380505310613" class="header-menu-phone">
                                        (050) 531-06-13
                                    </a>
                                    <a href="tel:+380487061030" class="header-menu-phone">
                                        (048) 706-10-30
                                    </a>
                                </div>
                                <div class="clear"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="header-zayavka-block">
                    <a href="/online-zayavka-anketa" onclick="gtag('event', 'clickformtop', { 'event_category': 'sendformTop', 'event_action': 'click', });" class="header-zayavka-btn main_bt color_white Primary_800_bg br_circle">
                        Заказать оценку
                    </a>
                </div>

                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</header>
<div class="clear"></div>




<div class="position-ref full-height">

    <div class="top-right links dop-header">
        @if (Route::has('login'))
                @if (Auth::check())
                    <a href="{{ url('/home') }}">Home</a>


                    @if (!Auth::guest())

                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                <span style="text-transform: none">(Logout)</span> <span style="color:#ff0f00">{{ Auth::user()->name }}</span> <span class="caret"></span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                    @endif

                @else
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                @endif
        @endif

        <a href="{{ url('news') }}">Links</a>
        <a href="{{ url('/user/profile') }}">User</a>
            <a href="{{ url('/user/send') }}">send</a>

            <div class="clear"></div>
    </div>

    <div class="content">

        @yield('content')

    </div>
</div>



<script src="/js/jquery/jquery-3.1.1.min.js"></script>
<script src="/js/jquery.maskedinput.min.js"></script>
<script src="/js/misc.js"></script>
<script src="/js/global.js"></script>

</body>
</html>