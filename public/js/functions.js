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

/* Desabilitar select quando for concessionária */
jQuery(document).ready(function () {
    jQuery('#origem, #btnAlterar').on('click', function () {
        disableSelectOrigem();
    })
})

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

function disableSelectOrigem() {
    let origem = document.getElementById('origem').value;
    if (origem === "concessionária") {
        let text = "Selecionar...";
        let select = document.getElementById('cliente');
        for (let i = 0; i < select.options.length; i++) {
            if(select.options[i].text === text) {
                select.selectedIndex = i;
                break;
            }
        }
        document.getElementById('cliente').disabled = true;
    } else {
        document.getElementById('cliente').disabled = false;
    }
}