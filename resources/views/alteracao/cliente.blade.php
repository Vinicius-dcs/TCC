@include('layouts.menu')

<?php use App\Http\Controllers\ClienteController; ?>


<body>
    <div class="position-relative vh-100">
        <h1 class="display-4 text-center">Alteração de Clientes</h1>

        <div class="container mt-3">
            @include('layouts.alert')
        </div>

        <table class="table table-hover mt-4"  style="font-size: 85%;">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Nascimento</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">CEP</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">UF</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        $clienteController = new clienteController();
                        $arraySelect = $clienteController->listarClientes();

                         foreach ($arraySelect as $retorno) 
                          {
                    ?>
                <tr>
                    <th scope="row" class="col">
                        <?php echo $retorno['id']; ?>
                    </th>
                    <td class="col"> <?php echo $retorno['nome']; ?> </td>
                    <td class="col">
                        <?php
                        $cpf = $retorno['cpf'];
                        $parte1 = substr($cpf, 0, 3);
                        $parte2 = substr($cpf, 3, 3);
                        $parte3 = substr($cpf, 6, 3);
                        $parte4 = substr($cpf, 9, 2);
                        echo "$parte1.$parte2.$parte3-$parte4";
                        ?>
                    </td>
                    <td class="col"> <?php echo $retorno['dataNascimento']; ?> </td>
                    <td class="col"> <?php echo $retorno['endereco']; ?> </td>
                    <td class="col">
                        <?php
                        $cep = $retorno['cep'];
                        $parte1 = substr($cep, 0, 5);
                        $parte2 = substr($cep, 5, 3);
                        echo "$parte1-$parte2";
                        ?>
                    </td>
                    <td class="col"> <?php echo $retorno['cidade']; ?> </td>
                    <td class="col"> <?php echo $retorno['estado']; ?> </td>

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

    <!-- Modal Alterar -->
    <div class="modal fade" id="modalAlterar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alterar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../cliente/alterar">
                        @csrf
                        <div class="form-group">
                            <!-- -->
                            <div class="row">
                                <div class="col-7">
                                    <input type="hidden" class="form-control" name="id" id="id" value="">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" name="nome" id="nome" required>
                                </div>
                                <div class="col-5">
                                    <label>Data Nascimento</label>
                                    <input type="date" class="form-control" name="dataNascimento" id="dataNascimento"
                                        required>
                                </div>
                            </div>
                            <!-- -->
                            <div class="row mt-3">
                                <div class="col-7">
                                    <label>Endereço</label>
                                    <input type="" class="form-control" name="endereco" id="endereco" required>
                                </div>
                                <div class="col-5">
                                    <label>CPF</label>
                                    <input type="" class="form-control" name="cpf" id="cpf" required>
                                </div>
                            </div>
                            <!-- -->
                            <div class="row mt-3">
                                <div class="col-4">
                                    <label>CEP</label>
                                    <input type="text" class="form-control" name="cep" id="cep" required>
                                </div>
                                <div class="col-4">
                                    <label>Cidade</label>
                                    <input type="text" class="form-control" name="cidade" id="cidade" value=""
                                        readonly required>
                                </div>
                                <div class="col-4 mb-2">
                                    <label>Estado</label>
                                    <input type="text" class="form-control" name="estado" id="estado" value=""
                                        readonly required>
                                </div>
                            </div>
                            <!-- -->
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
                    <h5 class="modal-title">Excluir Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../cliente/excluir">
                        @csrf
                        <p>Deseja realmente excluir o cliente selecionado?</p>
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
