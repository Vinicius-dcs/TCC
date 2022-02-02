@include('layouts.menu')

<?php use App\Http\Controllers\MarcaController; ?>

<body>
    <div class="position-relative vh-100">
        <h1 class="display-4 text-center">Alteração de Marcas</h1>

        <div class="container mt-4">
            @include('layouts.alert')

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
                        <td class="col-8"> <?php echo $retorno['nome']; ?> </td>
                        <td>

                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalAlterar" onclick="setInformations
                                (
                                    ['idAlt', 'nomeAlt'],
                                    [<?php echo $retorno['id']; ?>, 
                                    '<?php echo $retorno['nome']; ?>']
                                )"><ion-icon name="build"></ion-icon></button>


                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalExcluir" onclick="setInformations
                                (
                                    ['idExcluir'],
                                    [<?php echo $retorno['id']; ?>]
                                )"><ion-icon name="trash"></ion-icon></button>
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

        <!-- Modal Alterar -->
        <div class="modal fade" id="modalAlterar" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Alterar Marca</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="../marca/alterar">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="idAlt" id="idAlt" value="">
                                <input type="text" class="form-control" name="nomeAlt" id="nomeAlt" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Confirmar Alteração</button>
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
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
                        <h5 class="modal-title">Excluir Marca</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="../marca/excluir">
                            @csrf
                            <p>Deseja realmente excluir a marca selecionada?</p>
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

    </div>
</body>
