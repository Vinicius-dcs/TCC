<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Imports CAR</title>
    <script src="https://kit.fontawesome.com/9b557ca9f0.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="./css/login.css" rel="stylesheet">
</head>

<body>

    <div class="containerM">
        <div class="conteudo primeiro-conteudo">
            <div class="primeira-coluna">
                <h2 class="titulo-primario">Seja Bem Vindo!</h2>
                <p class="descricao descricao-primaria">Para se manter conectado conosco</p>
                <p class="descricao descricao-primaria">faça login com suas informações pessoais</p>
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
                <p class="descricao descricao-secundaria">ou utilize seu e-mail para registro</p>
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
                        <input type="" name="cadSenha" id="cadSenha" placeholder="Senha" required>
                    </label>
                    <label class="label-input" id="campoConfCadSenha">
                        <i class="fas fa-lock modificar-icon"></i>
                        <input type="" name="cadConfSenha" id="cadConfSenha" placeholder="Confirmar Senha" required>
                    </label>
                    <button type="submit" id="btnCadastrar" class="botaoCadastrar btn btn-light mt-2" disabled>Cadastrar</button>
                </form>
            </div><!-- segunda coluna -->
        </div><!-- primeiro conteudo -->

        <div class="conteudo segundo-conteudo">
            <div class="primeira-coluna">
                <h2 class="titulo titulo-primario">Olá, Imports!</h2>
                <p class="descricao descricao-primaria">Entre com seus dados pessoais</p>
                <p class="descricao descricao-primaria">e comece sua jornada conosco.</p>
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
                <p class="descricao descricao-secundaria">Ou utilize seu usuário para entrar</p>

                <form action="" class="form">
                    <label class="label-input">
                        <i class="far fa-envelope modificar-icon"></i>
                        <input type="email" placeholder="Email">
                    </label>
                    <label class="label-input">
                        <i class="fas fa-lock modificar-icon"></i>
                        <input type="password" placeholder="Senha">
                    </label>
                    <a class="senha" href="#">Esqueceu sua senha?</a>
                    <button class="botao botao-secundario">Entrar</button>
                </form>
            </div><!-- segunda coluna -->
        </div><!-- segundo conteudo -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="./js/login.js"></script>

</body>

</html>
