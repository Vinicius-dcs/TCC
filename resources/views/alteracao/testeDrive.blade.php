@include('layouts.menu')

<?php

use App\Http\Controllers\TesteDriveController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\ClienteController;
?>

<body>
    <div class="position-relative vh-100">
        <h1 class="display-4 text-center">Alteração de Teste Drive</h1>

        <div class="container mt-4">
            @include('layouts.alert')

            <table class="table table-hover mt-4" style="font-size: 85%;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Veículo</th>
                        <th scope="col">Funcionário</th>
                        <th scope="col">Data</th>
                        <th scope="col">Horário</th>
                        <th scope="col">Observações</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $testeDriveController = new TesteDriveController();
                    $funcionarioController = new FuncionarioController();
                    $veiculoController = new VeiculoController();
                    $clienteController = new ClienteController();
                    $arraySelect = $testeDriveController->listarTesteDrive();

                    foreach ($arraySelect as $retorno) {
                        $retornoVeiculo = $veiculoController->listarVeiculo($retorno['idVeiculo']);
                        $retornoFuncionario = $funcionarioController->listarFuncionarios($retorno['idFuncionario']);
                        $retornoCliente = $clienteController->listarClientes($retorno['idCliente']);
                    ?>
                        <tr>
                            <th scope="row" class="col"><?php echo $retorno['id']; ?> </th>
                            <td class="col"> <?php echo $retornoCliente[0]['nome']; ?> </td>
                            <td class="col"> <?php echo $retornoVeiculo[0]['descricao']; ?> </td>
                            <td class="col"> <?php echo $retornoFuncionario[0]['nome']; ?> </td>
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
                            <td class="col">
                                <?php
                                if (empty($retorno['observacao'])) {
                                    echo "-";
                                } else {
                                    echo $retorno['observacao'];
                                }
                                ?>
                            </td>

                            <td class="col">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAlterar" onclick="setInformations
                                (['id', 'cliente', 'veiculo', 'funcionario', 'data', 'horario', 'observacao'],
                                    [<?php echo $retorno['id']; ?>, 
                                    '<?php echo $retorno['idCliente']; ?>',
                                    '<?php echo $retorno['idVeiculo']; ?>',
                                    '<?php echo $retorno['idFuncionario']; ?>',
                                    '<?php echo $retorno['data']; ?>',
                                    '<?php echo $retorno['horario']; ?>',
                                    '<?php echo $retorno['observacao']; ?>']
                                )">
                                    <ion-icon name="build">
                                </button>

                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalExcluir" onclick="setInformations
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

        </div>
    </div>

    <!-- Modal Alterar -->
    <div class="modal fade" id="modalAlterar" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alterar Manutenção</h5>
                    <button type="button" id="" name="" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../testedrive/alterar">
                        @csrf
                        <div class="form-group">
                            <div class="row">

                                <div class="col">
                                    <input type="hidden" class="form-control" name="id" id="id" required>
                                    <input type="hidden" class="form-control" name="selecionaURLAPI" id="selecionaURLAPI" value="2" required>
                                    <label>Cliente</label>
                                    <select class="form-control" name="cliente" id="cliente" required>
                                        <option value="" selected disabled>Selecionar...</option>
                                        <?php
                                        $clienteController = new ClienteController();
                                        $arraySelect = $clienteController->listarClientes(1, 1);
                                        foreach ($arraySelect as $retorno) {
                                        ?>
                                            <option value="<?php echo $retorno['id']; ?>">
                                                <?php echo $retorno['id']; ?> - <?php echo $retorno['nome']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col">
                                    <label>Veículo</label>
                                    <select class="form-control" name="veiculo" id="veiculo" required>
                                        <option value="" selected disabled>Selecionar...</option>
                                        <?php
                                        $veiculoController = new VeiculoController();
                                        $arraySelect = $veiculoController->listarVeiculosConcessionaria(1, 1);
                                        foreach ($arraySelect as $retorno) {
                                        ?>
                                            <option value="<?php echo $retorno['id']; ?>">
                                                <?php echo $retorno['id']; ?> - <?php echo $retorno['descricao']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>
                            <!-- -->
                            <div class="row mt-3">

                                <div class="col">
                                    <label>Funcionário</label>
                                    <select class="form-control" name="funcionario" id="funcionario" required>
                                        <option value="" selected disabled>Selecionar...</option>
                                        <?php
                                        $funcionarioController = new FuncionarioController();
                                        $arraySelect = $funcionarioController->listarFuncionarios(1, 1);
                                        foreach ($arraySelect as $retorno) { ?>
                                            <option value="<?php echo $retorno['id']; ?>">
                                                <?php echo $retorno['id']; ?> - <?php echo $retorno['nome']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col">
                                    <label>Horário</label>
                                    <select class="form-control" name="horario" id="horario" required>
                                        <option value="" selected disabled>Selecionar...</option>
                                        <option value="08:00">08:00</option>
                                        <option value="09:00">09:00</option>
                                        <option value="10:00">10:00</option>
                                        <option value="11:00">11:00</option>
                                        <option value="14:00">14:00</option>
                                        <option value="15:00">15:00</option>
                                        <option value="16:00">16:00</option>
                                        <option value="17:00">17:00</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <label>Data</label>
                                <input type="date" class="form-control" name="data" id="data" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <label>Observação</label>
                                <input type="text" class="form-control" name="observacao" id="observacao">
                            </div>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="submit" id="" name="" class="btn btn-danger">Confirmar Alteração</button>
                            <button type="button" class="btn btn-primary" id="" name="" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Excluir -->
    <div class="modal fade" id="modalExcluir" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir Teste Drive</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../testedrive/excluir">
                        @csrf
                        <p>Deseja realmente excluir o teste drive selecionado?</p>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="idExcluir" id="idExcluir" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>