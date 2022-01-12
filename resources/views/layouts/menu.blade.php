@include('layouts.header')

<?php
use App\Http\Controllers\UsuarioController;

UsuarioController::verificaSeExisteSessao();
?>

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

                    <div class="nav__link collapseMenu">
                        <ion-icon name="clipboard-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Cadastros</span>
                        <ion-icon name="chevron-down-outline" class="collapse__link"></ion-icon>
                        <ul class="collapse__menu">
                            <a href="/carimports/public/sistema/cadastro/cliente" class="collapse__sublink">Cliente</a>
                            <a href="/carimports/public/sistema/cadastro/marca" class="collapse__sublink">Marca</a>
                            <a href="/carimports/public/sistema/cadastro/veiculo" class="collapse__sublink">Veículo</a>
                            <a href="/carimports/public/sistema/cadastro/funcionario" class="collapse__sublink">Funcionário</a>
                            <a href="/carimports/public/sistema/cadastro/manutencao" class="collapse__sublink">Manutenção</a>
                            <a href="/carimports/public/sistema/cadastro/testedrive" class="collapse__sublink">Teste_Drive</a>
                        </ul>
                    </div>

                    <div class="nav__link collapseMenu">
                        <ion-icon name="repeat-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Alteração</span>
                        <ion-icon name="chevron-down-outline" class="collapse__link"></ion-icon>
                        <ul class="collapse__menu">
                            <a href="/carimports/public/sistema/alteracao/cliente" class="collapse__sublink">Cliente</a>
                            <a href="/carimports/public/sistema/alteracao/marca" class="collapse__sublink">Marca</a>
                            <a href="/carimports/public/sistema/alteracao/veiculo" class="collapse__sublink">Veículo</a>
                            <a href="/carimports/public/sistema/alteracao/funcionario" class="collapse__sublink">Funcionario</a>
                            <a href="/carimports/public/sistema/alteracao/manutencao" class="collapse__sublink">Manutenção</a>
                        </ul>
                    </div>

                    <div class="nav__link collapseMenu">
                        <ion-icon name="construct-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Checagem</span>
                        <ion-icon name="chevron-down-outline" class="collapse__link"></ion-icon>
                        <ul class="collapse__menu">
                            <a href="/carimports/public/sistema/check/manutencao" class="collapse__sublink">Manutenção</a>
                            <a href="/carimports/public/sistema/check/testedrive" class="collapse__sublink">Teste_Drive</a>
                        </ul>
                    </div>

                    <div class="nav__link collapseMenu">
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

            <a href="/carimports/public/login" class="nav__link">
                <ion-icon name="log-out-outline" class="nav__icon"></ion-icon>
                <span class="nav__name">Sair</span>
            </a>
        </nav>
    </div>

    <!-- <h1>Componentes</h1> -->
    <!-- ===== IONICONS ===== -->
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

    <!-- ===== MAIN JS ===== -->
    <script src="/carimports/public/js/menu.js"></script>

</body>
