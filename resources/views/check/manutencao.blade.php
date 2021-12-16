@include('layouts.menu')

<?php
use App\Http\Controllers\ManutencaoController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\FuncionarioController;
?>

<body>
    <div class="position-relative vh-100">
        <h1 class="display-4 text-center">Check de Manutenções</h1>

        <div class="container mt-4">
            @include('layouts.alert')

            <table class="table table-hover mt-4" style="font-size: 85%;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Data</th>
                        <th scope="col">Horário</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Veículo</th>
                        <th scope="col">Funcionário</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $manutencaoController = new ManutencaoController();
                        $veiculoController = new VeiculoController();
                        $funcionarioController = new FuncionarioController();
                        $arraySelect = $manutencaoController->listarManutencao();

                        foreach ($arraySelect as $retorno) 
                            $retornoVeiculo = $veiculoController->listarVeiculo($retorno['idVeiculo']);
                            $retornoFuncionario = $funcionarioController->listarFuncionarios($retorno['idFuncionario']);
                        {
                    ?>
                    <tr>
                        <th scope="row" class="col"> <?php echo $retorno['id']; ?> </th>
                        <td class="col"> <?php echo $retorno['Data']; ?> </td>
                        <td class="col"><?php echo $retorno['horario']; ?></td>
                        <td class="col"><?php echo $retorno['descricao']; ?></td>
                        <td class="col"> <?php echo $retorno['valor']; ?> </td>
                        <td class="col"> <?php echo $retorno['veiculo']; ?> </td>
                        <td class="col"> <?php echo $retornoFuncionario[0]['nome']; ?> </td>

                        <td class="col">
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
</body>
