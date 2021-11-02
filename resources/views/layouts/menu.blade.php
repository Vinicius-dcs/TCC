<?php
use App\Http\Controllers\UsuarioController;

UsuarioController::verificaSeExisteSessao();
?>

@include('layouts.header')

<link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="/carimports/public/css/menu.css">

<body id="body-pd">
    <div class="l-navbar" id="navbar">
        <nav class="nav">
            <div>
                <div class="nav__brand">
                    <ion-icon name="menu-outline" class="nav__toggle" id="nav-toggle"></ion-icon>
                    <a href="#" class="nav__logo">Car Imports</a>
                </div>
                <div class="nav__list">

                    <a href="/carimports/public/sistema/inicio" class="nav__link">
                        <ion-icon name="home-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Início</span>
                    </a>

                    <div class="nav__link collapse">
                        <ion-icon name="add-circle-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Cadastros</span>

                        <ion-icon name="chevron-down-outline" class="collapse__link"></ion-icon>

                        <ul class="collapse__menu">
                            <a href="/carimports/public/sistema/cadastro/cliente" class="collapse__sublink">Cliente</a>
                            <a href="#" class="collapse__sublink">Group</a>
                            <a href="#" class="collapse__sublink">Members</a>
                        </ul>
                    </div>

                    <div class="nav__link collapse">
                        <ion-icon name="options-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Alterações</span>

                        <ion-icon name="chevron-down-outline" class="collapse__link"></ion-icon>

                        <ul class="collapse__menu">
                            <a href="#" class="collapse__sublink">Data</a>
                            <a href="#" class="collapse__sublink">Group</a>
                            <a href="#" class="collapse__sublink">Members</a>
                        </ul>
                    </div>

                    <div class="nav__link collapse">

                        <ion-icon name="reader-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Relatórios</span>

                        <ion-icon name="chevron-down-outline" class="collapse__link"></ion-icon>

                        <ul class="collapse__menu">
                            <a href="#" class="collapse__sublink">Data</a>
                            <a href="#" class="collapse__sublink">Group</a>
                            <a href="#" class="collapse__sublink">Members</a>
                        </ul>
                    </div>
                </div>
            </div>

            <a href="#" class="nav__link">
                <ion-icon name="log-out-outline" class="nav__icon"></ion-icon>
                <span class="nav__name">Sair</span>
            </a>
        </nav>
    </div>

    @yield('content')

    <!-- <h1>Componentes</h1> -->
    <!-- ===== IONICONS ===== -->
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

    <!-- ===== MAIN JS ===== -->
    <script src="/carimports/public/js/menu.js"></script>
</body>
