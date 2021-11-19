@include('layouts.menu')

<?php
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ClienteController;
?>

<body>
    <div class="position-relative vh-100">
        <h1 class="display-4 text-center">Cadastro de Veículos</h1>

        <div class="position-absolute top-50 start-50 translate-middle col-6">
            @include('layouts.alert')

            <form method="POST" action="../veiculo/cadastrar">
                @csrf
                <div class="form-group">
                    <!-- -->
                    <div class="row">
                        <div class="col-8">
                            <label>Modelo</label>
                            <input type="text" class="form-control" name="modelo" id="modelo"
                                placeholder="Ex: LT, LTZ, Trendline...">
                        </div>

                        <div class="col-4">
                            <label>Marca</label>
                            <select class="form-control">
                                <option value="" selected disabled>Selecionar...</option>
                                <?php 
                                    $marcaController = new MarcaController();
                                    $arraySelect = $marcaController->listarMarca(1, 1);
                                    foreach ($arraySelect as $retorno) { ?>
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
                            <input type="text" class="form-control" name="modelo" id="modelo"
                                placeholder="Ex: Prata, branco...">
                        </div>
                        <div class="col-4">
                            <label>Ano Fabricação</label>
                            <input type="number" class="form-control" name="modelo" id="modelo"
                                placeholder="Ex: 2000, 2010...">
                        </div>
                        <div class="col-4">
                            <label>Ano Modelo</label>
                            <input type="number" class="form-control" name="modelo" id="modelo"
                                placeholder="Ex: 2000, 2010...">
                        </div>
                    </div>
                    <!-- -->
                    <div class="row mt-3">
                        <div class="col-4">
                            <label>Placa</label>
                            <input type="text" class="form-control" name="modelo" id="modelo"
                                placeholder="Ex: BRA2E19...">
                        </div>
                        <div class="col">
                            <label>Cliente</label>
                            <select class="form-control">
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
                    <!-- -->
                </div>
                <button type="submit" class="btn btn-primary mt-3">Cadastrar</button>
            </form>
        </div>
    </div>
</body>
