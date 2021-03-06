/* Consumir API Via CEP */
jQuery(document).ready(function () {
    jQuery('#cep, #cepAlterar').on('keyup', function () {
        consumirAPIViaCEP();
    });
})

/* Mascara campo CPF */
jQuery(document).ready(function () {
    jQuery('#cpf, #cpfAlterar').on('keyup', function () {
        mascaraCPF();
    });
})

/* Desabilitar select quando for concessionária */
jQuery(document).ready(function () {
    jQuery('#origem, #btnAlterar').on('click', function () {
        disableSelectOrigem();
    })
})

/* Desabilitar horários ocupados ao clicar no select horários */
jQuery(document).ready(function () {
    jQuery('#horario').on('focusin', function () {
        desabilitarHorariosOcupados();
    })
})

/* Habilitar todos os horários ao sair do select horários */
jQuery(document).ready(function () {
    jQuery('#horario').on('focusout', function () {
        habilitarTodosHorarios();
    })
})

/* Habilitar campo horário */
jQuery(document).ready(function () {
    jQuery('#data, #funcionario').on('change', function () {
        habilitarCampoHorario();
    })
})

/*Habilita botão cadastro após receber true do validador CPF e CEP ou somente CPF no caso do funcionario*/
jQuery(document).ready(function () {
    jQuery('#cpf, #cep').on('keyup', function () {
        isValidCPF();
        if (document.querySelector('#validaCadastroOuAlterar') == null) {
            habilitarBtnCadastro()
        } else if (document.querySelector('#validaCadastroOuAlterar').value == 0) {
            habilitarBtnCadastroFuncionario()
        }
    })
})

/* Habilitar botão cadastro veículo após true do validador de ano */
jQuery(document).ready(function () {
    jQuery('#anoFabricacao, #anoModelo').on('keyup', function () {
        habilitarBtnCadVeiculo();
    })
})

/* Mascará telefone */
jQuery(document).ready(function () {
    jQuery('#telefone').on('keyup', function () {
        mascaraTelefone();
    })
})

/* Desabilitar botão ao sair do modal ALTERAÇÃO DE CLIENTES */
jQuery(document).ready(function () {
    jQuery('#btnModalFechar, #btnFecharModalCliente').on('click', function () {
        document.querySelector('#btnAlterar').disabled = true;
    })
})

/* Habilitar botão confirmar alteração no ALTERAÇÃO DE VEÍCULOS */
jQuery(document).ready(function () {
    jQuery('#descricao, #marca, #cor, #anoFabricacao, #anoModelo, #placa, #origem, #cliente').on('change keyup', function () {
        habilitarBtnCadVeiculo()
    })
})

/* Desabilitar botão confirmar alteração ao sair do modal ALTERAÇÃO DE VEÍCULOS */
jQuery(document).ready(function () {
    jQuery('#btnFecharModalVeiculoAlterar, #fecharModalAlterarVeiculo').on('click', function () {
        document.querySelector('#btnCadastro').disabled = true;
    })
})

/* Habilitar botão alterar funcionário */
jQuery(document).ready(function () {
    if (document.querySelector('#validaTela') != null) {
        if (document.querySelector('#validaTela').value == "alterarFuncionario") {
            jQuery('#nome, #dataNascimento, #dataAdmissao, #email, #sexo, #cpf, #telefone').on('keyup change', function () {
                if (isValidCPF()) {
                    document.querySelector('#btnAlterarFuncionario').disabled = false;
                } else {
                    document.querySelector('#btnAlterarFuncionario').disabled = true;
                }
            })
        }
    }
})

/* Desabilitar botão confirmar alteração funcionário ao sair do modal*/
jQuery(document).ready(function () {
    jQuery('#fecharModalAlterarFuncionario, #ModalAlterarFuncionariofechar').on('click', function () {
        document.querySelector('#btnAlterarFuncionario').disabled = true;
    })
})

/* ------------------------------------------------------------------- */
/* DOM botões CONCLUIR, ADIAR, CANCELAR telas CHECAGEM (manutenções e testes drives) */

/* Mostrar div botão CONCLUIR CHECAGEM*/
jQuery(document).ready(function () {
    jQuery('#btnConcluir').on('click', function () {
        document.querySelector('#divBotoesConcluir').hidden = false;
        document.querySelector('#divBotoesAdiar').hidden = true;
        document.querySelector('#divBotoesCancelar').hidden = true;
    });
})

/* Mostrar div botão ADIAR CHECAGEM*/
jQuery(document).ready(function () {
    jQuery('#btnAdiar').on('click', function () {
        document.querySelector('#divBotoesAdiar').hidden = false;
        document.querySelector('#divBotoesConcluir').hidden = true;
        document.querySelector('#divBotoesCancelar').hidden = true;
    });
})

/* Mostrar div botão CANCELAR CHECAGEM*/
jQuery(document).ready(function () {
    jQuery('#btnCancelar').on('click', function () {
        document.querySelector('#divBotoesCancelar').hidden = false;
        document.querySelector('#divBotoesConcluir').hidden = true;
        document.querySelector('#divBotoesAdiar').hidden = true;
    });
})

/* Esconder div botão modal visualizar CHECAGEM*/
jQuery(document).ready(function () {
    jQuery('#fecharBtnManutencao, #btnFecharModal').on('click', function () {
        document.querySelector('#divBotoesConcluir').hidden = true;
        document.querySelector('#divBotoesAdiar').hidden = true;
        document.querySelector('#divBotoesCancelar').hidden = true;
    });
})

/* ------------------------------------------------------------------- */

function validaAnoVeiculo() {
    let retorno = false;
    let anoFabricacao = document.querySelector('#anoFabricacao').value
    let anoModelo = document.querySelector('#anoModelo').value
    if (anoFabricacao.length === 4 && anoModelo.length === 4) {
        retorno = anoModelo >= anoFabricacao ? true : false
        document.querySelector('#anoInvalido').hidden = true;
        document.querySelector('#anoInvalido').hidden = true;
        document.querySelector('#AnoFabMaior').hidden = true;
        document.querySelector('#AnoModMaior').hidden = true;
        document.querySelector('#anoFabricacao').style.border = "1px solid grey";
        document.querySelector('#anoModelo').style.border = "1px solid grey";
        if (!retorno) {
            document.querySelector('#anoInvalido').hidden = false;
            document.querySelector('#anoFabricacao').style.border = "1px solid red";
            document.querySelector('#anoModelo').style.border = "1px solid red";
        }
    } else if (anoFabricacao.length > 4) {
        document.querySelector('#AnoFabMaior').hidden = false;
        document.querySelector('#anoFabricacao').style.border = "1px solid red";
    } else if (anoModelo.length > 4) {
        document.querySelector('#AnoModMaior').hidden = false;
        document.querySelector('#anoModelo').style.border = "1px solid red";
    }
    return retorno;
}

function habilitarBtnCadVeiculo() {
    if (validaAnoVeiculo()) {
        document.querySelector('#btnCadastro').disabled = false;
    } else {
        document.querySelector('#btnCadastro').disabled = true;
    }
}

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

    if (cepFormatado.length === 8) {
        let url = "https://viacep.com.br/ws/" + cepFormatado + "/json/";
        fetch(url).then(function (response) {
            response.json().then(function (dados) {
                if (!dados.erro) {
                    document.getElementById('cep').style.border = "1px solid grey";
                    document.querySelector('#cepInvalido').hidden = true;
                    setInformations(['cidade', 'estado'], [dados.localidade, dados.uf]);
                } else {
                    document.getElementById('cep').style.border = "1px solid red";
                    document.querySelector('#cepInvalido').style.color = 'red';
                    document.querySelector('#cepInvalido').hidden = false;
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

function mascaraTelefone() {
    let telefone = document.querySelector('#telefone').value
    telefone = telefone.replace(/\D/g, ""); //Remove tudo o que não é dígito
    telefone = telefone.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    telefone = telefone.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos

    document.querySelector('#telefone').value = telefone
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
            if (select.options[i].text === text) {
                select.selectedIndex = i;
                break;
            }
        }
        document.getElementById('cliente').disabled = true;
    } else {
        document.getElementById('cliente').disabled = false;
    }
}

function desabilitarHorariosOcupados() {
    let valueSelectURLAPI = document.querySelector('#selecionaURLAPI').value;
    let urlAtual = window.location.host;
    let url;

    if (valueSelectURLAPI == 1) {
        url = "http://" + urlAtual + "/carimports/public/sistema/manutencao/api/get";
    } else if (valueSelectURLAPI == 2) {
        url = "http://" + urlAtual + "/carimports/public/sistema/testedrive/api/get";
    }

    let data = document.querySelector('#data').value;
    let idFuncionario = document.querySelector('#funcionario').value;
    let select = document.querySelector('#horario');

    fetch(url).then(function (response) {
        response.json().then(function (dados) {
            dados.forEach(element => {
                let text = element['horario'];
                if (idFuncionario == element['idFuncionario'] && data == element['data']) {
                    for (let i = 0; i < select.options.length; i++) {
                        if (select.options[i].text == text) {
                            select.options[i].text = " " + element['horario'] + " - Indisponível";
                            select.options[i].disabled = true;
                        }
                    }
                }
            });

        })
    })
}

function habilitarCampoHorario() {
    let data = document.querySelector('#data').value;
    let idFuncionario = document.querySelector('#funcionario').value;

    if (idFuncionario && data.length == 10 && data[0] != 0) {
        document.querySelector('#horario').disabled = false;
    }
}

function habilitarTodosHorarios() {
    let select = document.querySelector('#horario');
    select.options[1].text = "08:00";
    select.options[2].text = "09:00";
    select.options[3].text = "10:00";
    select.options[4].text = "11:00";
    select.options[5].text = "14:00";
    select.options[6].text = "15:00";
    select.options[7].text = "16:00";
    select.options[8].text = "17:00";

    for (let i = 0; i < select.options.length; i++) {
        select.options[i].disabled = false;
    }
}

function habilitarBtnCadastro() {
    setTimeout(() => {
        if (document.getElementById('cep').style.border == "1px solid grey" && isValidCPF() === true) {
            document.querySelector('#btnCadastrar').disabled = false;
        } else {
            document.querySelector('#btnCadastrar').disabled = true;
        }
    }, 10);
}

function habilitarBtnCadastroFuncionario() {
    setTimeout(() => {
        if (isValidCPF() === true) {
            document.querySelector('#btnCadastrar').disabled = false;
        } else {
            document.querySelector('#btnCadastrar').disabled = true;
        }
    }, 10);
}

/* Habilita botão confirmar alteração Cliente */
jQuery(document).ready(function () {
    if (document.querySelector('#validaTela') != null) {
        if (document.querySelector('#validaTela').value == "alterarCliente") {
            jQuery('#nome, #dataNascimento, #endereco, #cpf, #cep').on('change keyup', function () {
                if (document.querySelector('#validaCadastroOuAlterar') != null) {
                    if (document.querySelector('#validaCadastroOuAlterar').value == 1) {
                        habilitarBtnConfirmarAlteracao();
                    }
                }
            })
        }
    }
})

function habilitarBtnConfirmarAlteracao() {
    setTimeout(() => {
        if (isValidCEP() && isValidCPF()) {
            document.querySelector('#btnAlterar').disabled = false;
        } else {
            document.querySelector('#btnAlterar').disabled = true;
            isValidCEP()
        }
    }, 10);
}

function isValidCEP() {
    let cep = document.querySelector('#cep').value
    cep = cep.replace(/[^a-zA-Z0-9]/g, '')
    if (document.getElementById('cep').style.border != "1px solid red") {
        return true;
    } else {
        return false;
    }
}

function isValidCPF() {
    let cpf = document.querySelector('#cpf').value
    cpf = cpf.replace(/[^\d]+/g, '')
    if (cpf.length == 11) {
        cpf = cpf.split('')
        const validator = cpf
            .filter((digit, index, array) => index >= array.length - 2 && digit)
            .map(el => +el)
        const toValidate = pop => cpf
            .filter((digit, index, array) => index < array.length - pop && digit)
            .map(el => +el)
        const rest = (count, pop) => (toValidate(pop)
            .reduce((soma, el, i) => soma + el * (count - i), 0) * 10) % 11 % 10
        let condicao = !(rest(10, 2) !== validator[0] || rest(11, 1) !== validator[1])

        if (!condicao) {
            document.querySelector('#cpf').style.border = "1px solid red";
            document.querySelector('#cpfInvalido').style.color = 'red';
            document.querySelector('#cpfInvalido').hidden = false;
            return condicao;
        } else {
            document.querySelector('#cpf').style.border = "1px solid grey";
            document.querySelector('#cpfInvalido').hidden = true;
            return condicao;
        }
    }

}
