<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width-device-width initial-scale=1.0"/>
    <title>IMali Payment System</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('vendor/imali/style.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/imali/form.css')}}">

{{--    <!-- CSS only -->--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"--}}
{{--          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">--}}
{{--    <!--font awesome con CDN-->--}}
{{--    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"--}}
{{--          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">--}}
</head>

<body>

<div class="container">

    <aside>
        <div class="top">
            <div class="logo">
                <img src="{{asset('vendor/imali/images/imali_logo.png')}}" alt="imali">
                <h2>I.Mali SDK</h2>
            </div>

            <div class="close" id="close-btn">
                <span class="material-icons-sharp">close</span>
            </div>
        </div>

        <div class="sidebar" id="main-menu">

            <a href="#" class="active">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Dashboard</h3>
            </a>
            <a href="#">
                <span class="material-icons-sharp">local_convenience_store</span>
                <h3>Pagamentos</h3></a>
            <a href="/imali/payments"> <span class="material-icons-sharp">card_travel</span>
                <h3>Reembolsos</h3>
            </a>
            <a href="#">
                <span class="material-icons-sharp">qr_code_2</span>
                <h3>Qrcodes</h3>
            </a>
            <a href="#">
                <span class="material-icons-sharp">mail_outline</span>
                <h3>Relatórios</h3>
                <span class="message-count">4</span>
            </a>
            <a href="#">
                <span class="material-icons-sharp">logout</span>
                <h3>Logout</h3>
            </a>
        </div>

    </aside>

    {{--    ############# FIM DE ASIDE ####################--}}

    <main>

        @yield('imali::content')
    </main>

    <div class="right">


        <div class="top">
            <button id="menu-btn">
                <span class="material-icons-sharp">menu</span>
            </button>
            <div class="theme-toggler">
                <span class="material-icons-sharp active">light_mode</span>
                <span class="material-icons-sharp">dark_mode</span>
            </div>
            <div class="profile">
                <div class="info">
                    <p>Olá, <b>Miguel</b></p>
                    <small class="text-muted">Partner</small>
                </div>
                <div class="profile-photo">
                    <img src="{{asset('vendor/imali/images/profile/profile-1.jpg')}}" alt="profile"/>
                </div>
            </div>

        </div>
        <!--- FIM DO TOP --->

        @yield('imali::right')


    </div>

</div>


<script src="{{asset('vendor/imali/orders.js')}}"></script>
<script src="{{asset('vendor/imali/index.js')}}"></script>
</body>
</html>
