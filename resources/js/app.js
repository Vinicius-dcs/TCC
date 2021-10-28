require('./bootstrap');

/* LOGIN */
var botaoEntrar = document.querySelector("#botaoEntrar");
var botaoCadastrar = document.querySelector("#botaoCadastrar");
var body = document.querySelector("body");

botaoEntrar.addEventListener("click", function() {
    body.className = "entrar-js";
})

botaoCadastrar.addEventListener("click", function () {
    body.className = "cadastrar-js"
})
/* -------- */