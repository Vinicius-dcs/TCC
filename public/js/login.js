var botaoEntrar = document.querySelector("#botaoEntrar");
var botaoCadastrar = document.querySelector("#botaoCadastrar");
var body = document.querySelector("body");

botaoEntrar.addEventListener("click", function () {
    body.className = "entrar-js";
})

botaoCadastrar.addEventListener("click", function () {
    body.className = "cadastrar-js"
})

//Verificar se senhas são iguais
jQuery(document).ready(function() {
    jQuery('#cadConfSenha, #cadSenha').on('keyup', function() {
        if(document.getElementById('cadSenha').value != document.getElementById('cadConfSenha').value) {
            //documento.getElementById('btnCadastrar').disabled = true;
            document.getElementById('campoCadSenha').style.border="1px solid red";
            document.getElementById('campoConfCadSenha').style.border="1px solid red";
        } else {
            //documento.getElementById('btnCadastrar').disabled = false;
            document.getElementById('campoCadSenha').style.border="0px solid";
            document.getElementById('campoConfCadSenha').style.border="0px solid";
        }
    });
});