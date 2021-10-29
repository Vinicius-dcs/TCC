<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Imports CAR</title>
    <script src="https://kit.fontawesome.com/9b557ca9f0.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./css/login.css" rel="stylesheet">
</head>

<body>

    <div class="containerM">
        <div class="conteudo primeiro-conteudo">
            <div class="primeira-coluna">
                <h2 class="titulo-primario">Seja Bem Vindo!</h2>
                <strong class="descricao descricao-primaria">Para se manter conectado conosco</strong> <br>
                <strong class="descricao descricao-primaria">faça login com suas informações pessoais.</strong> <br>
                <button name="botaoEntrar" id="botaoEntrar" class="botao botao-primario">Entrar</button>
            </div>
            <div class="segunda-coluna">
                <h2 class="titulo titulo-secundario mt-2">Crie sua conta</h2>
                <div class="social-media">
                    <ul class="social-media-lista">
                        <a href="#" class="link-social-midia">
                            <li class="item-social-midia">
                                <i class="fab fa-facebook-f">
                                </i>
                            </li>
                        </a>
                        <a href="#" class="link-social-midia">
                            <li class="item-social-midia">
                                <i class="fab fa-google"></i>
                            </li>
                        </a>
                        <a href="#" class="link-social-midia">
                            <li class="item-social-midia">
                                <i class="fab fa-linkedin-in">
                                </i>
                            </li>
                        </a>
                    </ul>
                </div><!-- social midia -->

                <!-- Alerta Sucess -->
                @if (isset($_SESSION['mensagemSucces']) == true)
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['mensagemSucces']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                <?php unset($_SESSION['mensagemSucces']); ?>

                <!-- Alerta Danger -->
                @if (isset($_SESSION['mensagemDanger']) == true)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['mensagemDanger']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                <?php unset($_SESSION['mensagemDanger']); ?>

                <form id="formCadastro" method="post" action="../public/usuario/insert" class="form">
                    @csrf
                    <label class="label-input">
                        <i class="far fa-user modificar-icon"></i>
                        <input type="text" name="cadNome" id="cadNome" placeholder="Nome" required>
                    </label>
                    <label class="label-input">
                        <i class="far fa-envelope modificar-icon"></i>
                        <input type="email" name="cadEmail" id="cadEmail" placeholder="Email" required>
                    </label>
                    <label class="label-input" id="campoCadSenha">
                        <i class="fas fa-lock modificar-icon"></i>
                        <input type="password" name="cadSenha" id="cadSenha" placeholder="Senha" required>
                    </label>
                    <label class="label-input" id="campoConfCadSenha">
                        <i class="fas fa-lock modificar-icon"></i>
                        <input type="password" name="cadConfSenha" id="cadConfSenha" placeholder="Confirmar Senha"
                            required>
                    </label>
                    <button type="submit" id="btnCadastrar" class="botaoCadastrar btn btn-light mt-2 mb-2"
                        disabled>Cadastrar</button>
                </form>
            </div><!-- segunda coluna -->
        </div><!-- primeiro conteudo -->

        <div class="conteudo segundo-conteudo">
            <div class="primeira-coluna">
                <h2 class="titulo titulo-primario">Olá, Imports!</h2>
                <strong class="descricao descricao-primaria">Entre com seus dados pessoais</strong> <br>
                <strong class="descricao descricao-primaria">e comece sua jornada conosco.</strong> <br>
                <button id="botaoCadastrar" class="botao botao-primario">Cadastrar</button>
            </div>
            <div class="segunda-coluna">
                <h2 class="titulo titulo-secundario">Entrar no sistema</h2>
                <div class="social-media">
                    <ul class="social-media-lista">
                        <a href="#" class="link-social-midia">
                            <li class="item-social-midia">
                                <i class="fab fa-facebook-f">
                                </i>
                            </li>
                        </a>
                        <a href="#" class="link-social-midia">
                            <li class="item-social-midia">
                                <i class="fab fa-google"></i>
                            </li>
                        </a>
                        <a href="#" class="link-social-midia">
                            <li class="item-social-midia">
                                <i class="fab fa-linkedin-in">
                                </i>
                            </li>
                        </a>
                    </ul>
                </div><!-- social midia -->

                <!-- Alerta Danger -->
                @if (isset($_SESSION['loginAutorizado']))
                    @if($_SESSION['loginAutorizado'] == false)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <p> Usuário ou senha incorreto!</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif    
                @endif
                <?php unset($_SESSION['loginAutorizado']); ?>

                <form method="POST" action="../public/usuario/logar" class="form">
                    @csrf
                    <label class="label-input">
                        <i class="far fa-envelope modificar-icon"></i>
                        <input type="email" name="loginEmail" placeholder="Email" required>
                    </label>
                    <label class="label-input">
                        <i class="fas fa-lock modificar-icon"></i>
                        <input type="password" name="loginSenha" placeholder="Senha" required>
                    </label>
                    <a class="senha" href="#">Esqueceu sua senha?</a>
                    <button class="botao botao-secundario">Entrar</button>
                </form>
            </div><!-- segunda coluna -->
        </div><!-- segundo conteudo -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="./js/login.js"></script>

</body>

</html>
