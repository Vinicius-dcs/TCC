@include('layouts.menu')

<?php
use App\Http\Controllers\MarcaController;
use App\Models\Marca;
?>

<body>
    <div class="position-relative vh-100">

        <h1 class="display-4 text-center">Alteração de Marcas</h1>

        <div class="position-absolute top-50 start-50 translate-middle mt-4">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $marcaController = new MarcaController();
                        $arraySelect = $marcaController->listarMarca();

                         foreach ($arraySelect as $retorno) 
                          {
                    ?>
                    <tr>
                        <th scope="row" class="col-2">
                            <?php echo $retorno['id']; ?>
                        </th>
                        <td class="col-5"> <?php echo $retorno['nome']; ?> </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm">Alterar</button>
                            <button type="button" class="btn btn-danger btn-sm">Excluir</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div>
                {{$arraySelect->onEachSide(2)->links()}}
            </div>

        </div>


    
    </div>


</body>
