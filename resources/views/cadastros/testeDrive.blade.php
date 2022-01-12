@include('layouts.menu')

<?php

use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TesteDriveController;
?>

<body>
    <div class="position-relative vh-100">
        <h1 class="display-4 text-center">Cadastro de Teste Drive</h1>

        <div class="position-absolute top-50 start-50 translate-middle col-6">
            @include('layouts.alert')

            <form method="POST" action="../testedrive/cadastrar">
                @csrf
                <div class="form-group">
                    <div class="row">

                        <div class="col">
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
                                $arraySelect = $veiculoController->listarVeiculosConcessionaria();
                                var_dump($veiculoController);
                                foreach ($arraySelect as $retorno) {
                                ?>
                                    <option value="<?php echo $retorno['id']; ?>">
                                        <?php echo $retorno['id']; ?> - <?php echo $retorno['descricao']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col">
                            <label>Funcionário</label>
                            <select class="form-control" name="funcionario" id="funcionario" required>
                                <option value="" selected disabled>Selecionar...</option>
                                <?php
                                $funcionarioController = new FuncionarioController();
                                $arraySelect = $funcionarioController->listarFuncionarios(1, 1);
                                foreach ($arraySelect as $retorno) {
                                ?>
                                    <option value="<?php echo $retorno['id']; ?>">
                                        <?php echo $retorno['id']; ?> - <?php echo $retorno['nome']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                    <!-- -->
                    <div class="row mt-3">
                        <div class="col">
                            <label>Data Teste Drive</label>
                            <input type="date" class="form-control" name="data" id="data" required>
                        </div>

                        <div class="col">
                            <label>Horário</label>
                            <select class="form-control" name="horario" id="horario" required disabled>
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

                    <!-- -->
                    <div class="row mt-3">
                        <div class="col">
                            <label>Observações</label>
                            <input type="text" class="form-control" name="observacao" id="observacao">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Cadastrar</button>
            </form>
        </div>
    </div>
</body>