function setInformations(idInputs, values = null) {
    let i = 0;
    while (idInputs[i] != null) {
        document.getElementById(idInputs[i]).value = values[i];
        i++;
    }
}

function consultarCEP() {
    let cep = document.getElementById('cep').value;

    if(cep.length != 8) {
        alert('CEP Inválido!');
    }

    let url = "https://viacep.com.br/ws/" + cep + "/json/";
    fetch(url).then(function(response) {
        response.json().then(function(dados) {
            setInformations(['cidade', 'estado'], [dados.localidade, dados.uf]);
        });
    });

    let cepFormatado = cep.substring(0,5) + "-" + cep.substring(5);
    document.getElementById('cep').value = cepFormatado;

}