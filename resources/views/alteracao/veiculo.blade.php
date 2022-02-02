@include('layouts.menu')

<?php

use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ClienteController;
?>

<body>

    <div class="position-relative vh-100">
        <h1 class="display-4 text-center">Alteração de Veículos</h1>

        <div class="container mt-4">
            @include('layouts.alert')

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Cor</th>
                        <th scope="col">Ano Frab.</th>
                        <th scope="col">Ano Modelo</th>
                        <th scope="col">Placa</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Origem</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $veiculoController = new VeiculoController();
                    $marcaController = new MarcaController();
                    $clienteController = new ClienteController();
                    $arraySelect = $veiculoController->listarVeiculo();

                    foreach ($arraySelect as $retorno) {
                        $retornoMarca = $marcaController->listarMarca($retorno['idMarca']);
                        $retornoCliente = $clienteController->listarClientes($retorno['idCliente']);
                    ?>
                        <tr>
                            <th scope="row" class="col">
                                <?php echo $retorno['id']; ?>
                            </th>
                            <td class="col"> <?php echo $retorno['descricao']; ?> </td>
                            <td class="col"> <?php echo $retornoMarca[0]['nome']; ?>
                            <td class="col"> <?php echo $retorno['cor']; ?> </td>
                            <td class="col"> <?php echo $retorno['anoFabricacao']; ?> </td>
                            <td class="col"> <?php echo $retorno['anoModelo']; ?> </td>
                            <td class="col"> <?php echo strtoupper($retorno['placa']); ?> </td>
                            <td class="col">
                                <?php
                                if ($retorno['origem'] != 'concessionária') {
                                    echo $retornoCliente[0]['nome'];
                                } elseif ($retorno['origem'] === 'concessionária') {
                                    echo '-';
                                }

                                ?>
                            </td>
                            <td class="col"> <?php echo ucfirst($retorno['origem']); ?> </td>
                            <td>

                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAlterar" onclick="setInformations
                                (
                                    ['id', 'descricao', 'marca', 'cor' , 'anoFabricacao', 'anoModelo', 'placa', 'origem', 'cliente'],
                                    [<?php echo $retorno['id']; ?>, 
                                    '<?php echo $retorno['descricao']; ?>', 
                                    '<?php echo $retorno['idMarca']; ?>',
                                    '<?php echo $retorno['cor']; ?>',
                                    '<?php echo $retorno['anoFabricacao']; ?>',
                                    '<?php echo $retorno['anoModelo']; ?>',
                                    '<?php echo $retorno['placa']; ?>',
                                    '<?php echo $retorno['origem']; ?>',
                                    '<?php echo $retorno['idCliente']; ?>']
                                )">
                                    <ion-icon name="build"></ion-icon>
                                </button>

                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalExcluir" onclick="setInformations
                                (
                                    ['idExcluir'],
                                    [<?php echo $retorno['id']; ?>]
                                )">
                                    <ion-icon name="trash"></ion-icon>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div>
                {{ $arraySelect->links() }}
            </div>

            <p class="mt-5" style="font-size: 11px; position: relative; top: 95%;">*Nessa tela é possível consultar, alterar e excluir informações.</p>
            
        </div>
    </div>

    <!-- Modal Alterar -->
    <div class="modal fade" id="modalAlterar" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alterar Veículo</h5>
                    <button type="button" id="btnFecharModalVeiculoAlterar" name="btnFecharModalVeiculoAlterar" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../veiculo/alterar">
                        @csrf
                        <div class="form-group">
                            <!-- -->
                            <div class="row">
                                <div class="col-8">
                                    <label>Descrição</label>
                                    <input type="hidden" class="form-control" name="id" id="id" value="">
                                    <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Ex: Cruze LTZ" value="" required>
                                </div>

                                <div class="col-4">
                                    <label>Marca</label>
                                    <select class="form-control" name="marca" id="marca" required>
                                        <option value="" selected disabled>Selecionar...</option>
                                        <?php
                                        $marcaController = new MarcaController();
                                        $arraySelect = $marcaController->listarMarca(1, 1);
                                        foreach ($arraySelect as $retorno) {
                                        ?>
                                            <option value="<?php echo $retorno['id']; ?>"> <?php echo $retorno['nome']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- -->
                            <div class="row mt-3">
                                <div class="col-4">
                                    <label>Cor</label>
                                    <input type="text" class="form-control" name="cor" id="cor" placeholder="Ex: Prata, branco..." required>
                                </div>
                                <div class="col-4">
                                    <label>Ano Fabricação</label>
                                    <input type="number" class="form-control" name="anoFabricacao" id="anoFabricacao" placeholder="Ex: 2000, 2010..." required>
                                    <p hidden id="anoInvalido" style="position: absolute; font-size:12px; color:red;">
                                        Ano Modelo não pode ser menor que o ano fabricação! </p>
                                    <p hidden id="AnoFabMaior" style="position: absolute; font-size:12px; color:red;"> O
                                        ano deve conter 4 digitos! </p>
                                </div>
                                <div class="col-4">
                                    <label>Ano Modelo</label>
                                    <input type="number" class="form-control" name="anoModelo" id="anoModelo" placeholder="Ex: 2000, 2010..." required>
                                    <p hidden id="AnoModMaior" style="position: absolute; font-size:12px; color:red;"> O
                                        ano deve conter 4 digitos! </p>
                                </div>
                            </div>
                            <!-- -->
                            <div class="row mt-3">
                                <div class="col">
                                    <label>Placa</label>
                                    <input type="text" class="form-control" name="placa" id="placa" placeholder="Ex: BRA2E19..." required>
                                </div>
                                <div class="col">
                                    <label>Origem Veículo</label>
                                    <select class="form-control" name="origem" id="origem" required>
                                        <option value="" selected disabled>Selecionar...</option>
                                        <option value="cliente"> Cliente </option>
                                        <option value="concessionária"> Concessionária </option>
                                    </select>
                                </div>
                            </div>
                            <!-- -->
                            <div class="row mt-3">
                                <div class="col">
                                    <label>Cliente</label>
                                    <select class="form-control" name="cliente" id="cliente" required>
                                        <option value="" selected disabled>Selecionar...</option>
                                        <?php
                                        $clienteController = new ClienteController();
                                        $arraySelect = $clienteController->listarClientes(1, 1);
                                        foreach ($arraySelect as $retorno) { ?>
                                            <option value="<?php echo $retorno['id']; ?>"> <?php echo $retorno['nome']; ?></option>
                                        <?php }
                                        ?>
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="submit" class="btn btn-danger" id="btnCadastro" name="btnCadastro" disabled>Confirmar Alteração</button>
                            <button type="button" class="btn btn-primary" id="fecharModalAlterarVeiculo" name="fecharModalAlterarVeiculo" data-bs-dismiss="modal">Fechar</button>
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
                    <h5 class="modal-title">Excluir Veículo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../veiculo/excluir">
                        @csrf
                        <p>Deseja realmente excluir o veículo selecionado?</p>
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