/* Consumir API Via CEP */
jQuery(document).ready(function () {
    jQuery('#cep').on('keyup', function () {
        consumirAPIViaCEP();
    });
});

/* Mascara campo CPF */
jQuery(document).ready(function () {
    jQuery('#cpf').on('keyup', function () {
        mascaraCPF();
    });
});

function setInformations(idInputs, values = null) {
    let i = 0;
    while (idInputs[i] != null) {
        document.getElementById(idInputs[i]).value = values[i];
        i++;
    }
}

function consumirAPIViaCEP() {
    mascaraCEP();

    let cep = document.getElementById('cep').value;
    cepFormatado = cep.replace("-", "");

    if (cepFormatado.length == 8) {
        let url = "https://viacep.com.br/ws/" + cepFormatado + "/json/";
        fetch(url).then(function (response) {
            response.json().then(function (dados) {
                if (!dados.erro) {
                    document.getElementById('cep').style.border = "1px solid grey";
                    setInformations(['cidade', 'estado'], [dados.localidade, dados.uf]);
                } else {
                    document.getElementById('cep').style.border = "1px solid red";
                    setInformations(['cidade', 'estado'], ['', '']);
                }
            });
        });
    } else {
        document.getElementById('cep').style.border = "1px solid red";
        setInformations(['cidade', 'estado'], ['', '']);
    }
}

function mascaraCPF() {
    let cpf = document.getElementById('cpf').value
    cpf = cpf.replace(/\D/g, "").slice(0, 11);
    cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
    cpf = cpf.replace(/^(\d{3}\.\d{3})(\d)/, "$1.$2");
    cpf = cpf.replace(/(.{11})(\d)/, "$1-$2");
    document.getElementById('cpf').value = cpf;
}

function mascaraCEP() {
    let cep = document.getElementById('cep').value
    cep = cep.replace(/\D/g, "").slice(0, 8);
    cep = cep.replace(/(\d+)(\d{3})$/, "$1-$2");
    document.getElementById('cep').value = cep;
}