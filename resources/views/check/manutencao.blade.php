@include('layouts.menu')

<?php
use App\Http\Controllers\ManutencaoController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\FuncionarioController;
?>

<body>
    <div class="position-relative vh-100" id="divPrincipal">
        <h1 class="display-4 text-center mt">Manutenções Pendetes e Atrasadas</h1>

        <div class="container mt-4">
            @include('layouts.alert')

            <table class="table table-hover mt-4" style="font-size: 85%;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Veículo</th>
                        <th scope="col">Data</th>
                        <th scope="col">Horário</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Situação</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $manutencaoController = new ManutencaoController();
                        $veiculoController = new VeiculoController();
                        $funcionarioController = new FuncionarioController();
                        $arraySelect = $manutencaoController->listarManutencoesPeA();

                        foreach ($arraySelect as $retorno)  {
                            $retornoVeiculo = $veiculoController->listarVeiculo($retorno['idVeiculo']);
                            $retornoFuncionario = $funcionarioController->listarFuncionarios($retorno['idFuncionario']);
                        ?>
                    <tr>
                        <th scope="row" class="col"> <?php echo $retorno['id']; ?> </th>
                        <td class="col"> <?php echo $retornoVeiculo[0]['descricao']; ?> </th>
                        <td class="col">
                            <?php
                            $data = $retorno['data'];
                            $ano = substr($data, 0, 4);
                            $mes = substr($data, 5, 2);
                            $dia = substr($data, 8, 2);
                            echo "$dia-$mes-$ano";
                            ?>
                        </td>
                        <td class="col"> <?php echo $retorno['horario']; ?> </td>
                        <td class="col"> <?php echo $retorno['valor']; ?> </td>
                        <td class="col"> <?php echo ucfirst($retorno['tipoManutencao']); ?> </td>
                        <td class="col"> <?php echo ucfirst($retorno['situacao']); ?> </td>

                        <td class="col">
                            <button type="button" class="btn btn-primary btn-sm" id="btnVisualizar" name="btnVisualizar"
                                data-bs-toggle="modal" data-bs-target="#modalVisualizar" onclick="setInformations
                                (
                                    ['id', 'data', 'horario', 'valor', 'tipoManutencao', 'descricao', 'veiculo', 'funcionario', 'situacao'],
                                    [<?php echo $retorno['id']; ?>, 
                                    '<?php echo $retorno['data']; ?>',
                                    '<?php echo $retorno['horario']; ?>',
                                    '<?php echo $retorno['valor']; ?>',
                                    '<?php echo ucfirst($retorno['tipoManutencao']); ?>',
                                    '<?php echo ucfirst($retorno['descricao']); ?>',
                                    '<?php echo $retornoVeiculo[0]['descricao']; ?>',
                                    '<?php echo $retornoFuncionario[0]['nome']; ?>',
                                    '<?php echo ucfirst($retorno['situacao']); ?>']
                                )">
                                <ion-icon name="layers"></ion-icon>
                            </button>

                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalAlterar" onclick="setInformations
                                (
                                    ['id', 'nome', 'dataNascimento', 'endereco', 'cpf', 'cep', 'cidade', 'estado'],
                                    [<?php echo $retorno['id']; ?>, 
                                    '<?php echo $retorno['nome']; ?>',
                                    '<?php echo $retorno['dataNascimento']; ?>',
                                    '<?php echo $retorno['endereco']; ?>',
                                    '<?php echo $retorno['cpf']; ?>',
                                    '<?php echo $retorno['cep']; ?>',
                                    '<?php echo $retorno['cidade']; ?>',
                                    '<?php echo $retorno['estado']; ?>'
                                ]
                                )">
                                <ion-icon name="build">
                            </button>

                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalExcluir" onclick="setInformations
                                (
                                    ['idExcluir'],
                                    [<?php echo $retorno['id']; ?>]
                                )">
                                <ion-icon name="trash">
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div>
                {{ $arraySelect->links() }}
            </div>

            <br>
        </div>
    </div>

    <!-- Modal Visualizar -->
    <div class="modal fade" id="modalVisualizar" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Visualizar Manutenção</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btnFecharModal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" id="formAcoesManutencao">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" class="form-control" name="id" id="id">
                                    <label>Veículo</label>
                                    <input type="text" class="form-control" name="veiculo" id="veiculo" disabled>
                                </div>
                                <div class="col">
                                    <label>Funcionário</label>
                                    <input type="text" class="form-control" name="funcionario" id="funcionario"
                                        disabled>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label>Data</label>
                                    <input type="date" class="form-control" name="data" id="data" disabled>
                                </div>
                                <div class="col">
                                    <label>Horário</label>
                                    <input type="text" class="form-control" name="horario" id="horario" disabled>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label>Valor</label>
                                    <input type="text" class="form-control" name="valor" id="valor" disabled>
                                </div>
                                <div class="col">
                                    <label>Tipo</label>
                                    <input type="text" class="form-control" name="tipoManutencao" id="tipoManutencao"
                                        disabled>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label>Descrição</label>
                                    <textarea class="form-control" name="descricao" id="descricao"
                                        disabled></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center mt-3">
                                    <b>Situação</b>
                                    <input type="text" class="form-control text-center" name="situacao" id="situacao"
                                        disabled>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="row justify-content-around">

                                <button type="button" class="btn btn-primary ms-0 col-4" id="btnConcluirManutencao">
                                    Concluir Manutenção
                                </button>

                                <button type="button" class="btn btn-warning ms-0 col-4" id="btnAdiarManutencao">
                                    Adiar Manutenção
                                </button>

                                <button type="button" class="btn btn-danger ms-0 col-4" id="btnCancelarManutencao">
                                    Cancelar Manutenção
                                </button>

                                {{-- Div concluir --}}
                                <div class="row mx-auto mt-4" id="divBotoesConcluir" hidden>
                                    <button type="submit" class="btn btn-success btn-sm mb-1" id="btnConfirmarConclusao"
                                        formaction="../manutencao/concluir">
                                        Confirmar Conclusão
                                    </button>
                                    <button type="button" class="btn btn-secondary btn-sm" id="fecharBtnManutencao">
                                        Fechar
                                    </button>
                                </div>

                                {{-- Div adiar --}}
                                <div class="row mx-auto mt-4" id="divBotoesAdiar" hidden>
                                    <label>Nova data da manutenção</label>
                                    <input type="date" class="form-control mb-2" name="novaData" id="novaData">
                                    <button type="submit" class="btn btn-success btn-sm mb-1" id="btnConfirmarAdiar"
                                        formaction="../manutencao/adiar">
                                        Alterar data manuteção
                                    </button>
                                    <button type="button" class="btn btn-secondary btn-sm" id="fecharBtnManutencao">
                                        Fechar
                                    </button>
                                </div>

                                {{-- Div cancelar --}}
                                <div class="row mx-auto mt-4" id="divBotoesCancelar" hidden>
                                    Deseja realmente cancelar a manutenção?
                                    <button type="submit" class="btn btn-danger btn-sm mb-1" id="btnConfirmarCancelar"
                                        formaction="../manutencao/cancelar">
                                        Sim, quero cancelar
                                    </button>
                                    <button type="button" class="btn btn-secondary btn-sm" id="fecharBtnManutencao">
                                        Fechar
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        </form>
    </div>
    </div>
    </div>
    </div>

</body>
