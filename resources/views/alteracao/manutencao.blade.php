@include('layouts.menu')

<?php
use App\Http\Controllers\ManutencaoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\VeiculoController;
?>

<body>
    <div class="position-relative vh-100">
        <h1 class="display-4 text-center">Alteração de Manutenção</h1>

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
                        <th scope="col">Funcionário</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $manutencaoController = new ManutencaoController();
                        $funcionarioController = new FuncionarioController();
                        $veiculoController = new VeiculoController();
                        $arraySelect = $manutencaoController->listarManutencao();
                        
                        foreach ($arraySelect as $retorno) {
                            $retornoVeiculo = $veiculoController->listarVeiculo($retorno['idVeiculo']);
                            $retornoFuncionario = $funcionarioController->listarFuncionarios($retorno['idFuncionario']);
                            ?>
                    <tr>
                        <th scope="row" class="col">
                            <?php echo $retorno['id']; ?>
                        </th>
                        <td class="col"> <?php echo $retornoVeiculo[0]['descricao']; ?> </td>
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
                        <td class="col"> <?php echo $retornoFuncionario[0]['nome']; ?> </td>

                        <td class="col">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalAlterar" onclick="setInformations
                                (['id', 'veiculo', 'data', 'horario', 'valor', 'tipoManutencao', 'situacao', 'funcionario', 'descricao'],
                                    [<?php echo $retorno['id']; ?>, 
                                    '<?php echo $retorno['idVeiculo']; ?>',
                                    '<?php echo $retorno['data']; ?>',
                                    '<?php echo $retorno['horario']; ?>',
                                    '<?php echo $retorno['valor']; ?>',
                                    '<?php echo $retorno['tipoManutencao']; ?>',
                                    '<?php echo ucfirst($retorno['situacao']); ?>',
                                    '<?php echo $retorno['idFuncionario']; ?>',
                                    '<?php echo $retorno['descricao']; ?>']
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

        </div>
    </div>

    <!-- Modal Alterar -->
    <div class="modal fade" id="modalAlterar" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alterar Manutenção</h5>
                    <button type="button" id="" name="" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../manutencao/cadastrar">
                        @csrf
                        <div class="form-group">
                            <div class="row">

                                <div class="col">
                                    <label>Veículo</label>
                                    <input type="hidden" class="form-control" name="id" id="id" required>
                                    <select class="form-control" name="veiculo" id="veiculo" required>
                                        <option value="" selected disabled>Selecionar...</option>
                                        <?php 
                                            $veiculoController = new VeiculoController();
                                            $arraySelect = $veiculoController->listarVeiculo(1, 1);
                                            foreach ($arraySelect as $retorno) { 
                                        ?>
                                        <option value="<?php echo $retorno['id']; ?>">
                                            <?php echo $retorno['id']; ?> - <?php echo $retorno['descricao']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col">
                                    <label>Data Manutenção</label>
                                    <input type="date" class="form-control" name="data" id="data" required>
                                </div>

                            </div>
                            <!-- -->
                            <div class="row mt-3">
                                <div class="col">
                                    <label>Horário</label>
                                    <select class="form-control" name="horario" id="horario" disabled required>
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
                                <div class="col">
                                    <label>Valor</label>
                                    <input type="text" class="form-control" name="valor" id="valor" required>
                                </div>
                                <div class="col">
                                    <label>Tipo</label>
                                    <select class="form-control" name="tipoManutencao" id="tipoManutencao" required>
                                        <option value="" selected disabled>Selecionar...</option>
                                        <option value="preventiva">Preventiva</option>
                                        <option value="corretiva">Corretiva</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <label>Situação</label>
                                <input type="text" class="form-control" name="situacao" id="situacao" required
                                    disabled>
                            </div>

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
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <label>Descrição da Manutenção</label>
                                <input type="text" class="form-control" name="descricao" id="descricao" required>
                            </div>
                        </div>

                        <!-- -->


                        <button type="submit" class="btn btn-primary mt-3">Cadastrar</button>
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
                    <h5 class="modal-title">Excluir Funcionário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../funcionario/excluir">
                        @csrf
                        <p>Deseja realmente excluir o funcionário selecionado?</p>
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
