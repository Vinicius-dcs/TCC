@include('layouts.menu')

<?php
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ClienteController;
?>

<body>

    <div class="position-relative vh-100">
        <h1 class="display-4 text-center">Alteração de Veículos</h1>

        <div class="position-absolute top-50 start-50 translate-middle mt-4">
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $veiculoController = new VeiculoController();
                        $marcaController = new MarcaController();
                        $clienteController = new ClienteController();
                        $arraySelect = $veiculoController->listarVeiculo();

                        foreach ($arraySelect as $retorno) {
                        ?>
                    <tr>
                        <th scope="row" class="col-2">
                            <?php echo $retorno['id']; ?>
                        </th>
                        <td class="col-8"> <?php echo $retorno['descricao']; ?> </td>
                        <td class="col-8"> <?php echo $retorno['idMarca']; ?> </td>
                        <td class="col-8"> <?php echo $retorno['cor']; ?> </td>
                        <td class="col-8"> <?php echo $retorno['anoFabricacao']; ?> </td>
                        <td class="col-8"> <?php echo $retorno['anoModelo']; ?> </td>
                        <td class="col-8"> <?php echo $retorno['placa']; ?> </td>
                        <td class="col-8"> <?php echo $retorno['idCliente']; ?> </td>
                        <td>

                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalAlterar" onclick="setInformations
                                (
                                    ['idAlt', 'nomeAlt'],
                                    [<?php echo $retorno['id']; ?>, 
                                    '<?php echo $retorno['nome']; ?>']
                                )">
                                <ion-icon name="build"></ion-icon>
                            </button>


                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalExcluir" onclick="setInformations
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

        </div>
    </div>

</body>
