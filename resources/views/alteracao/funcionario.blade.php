@include('layouts.menu')

<?php use App\Http\Controllers\FuncionarioController; ?>

<body>
    <div class="position-relative vh-100">
        <h1 class="display-4 text-center">Alteração de Clientes</h1>

        <div class="container mt-4">
            @include('layouts.alert')

            <table class="table table-hover mt-4" style="font-size: 85%;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Nascimento</th>
                        <th scope="col">Admissão</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $funcionarioController = new FuncionarioController();
                        $arraySelect = $funcionarioController->listarFuncionarios();

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
                            $data = $retorno['dataNascimento'];
                            $ano = substr($data, 0, 4);
                            $mes = substr($data, 5, 2);
                            $dia = substr($data, 8, 2);
                            echo "$dia-$mes-$ano";
                            ?>
                        </td>
                        <td class="col">
                            <?php
                            $data = $retorno['dataAdmissao'];
                            $ano = substr($data, 0, 4);
                            $mes = substr($data, 5, 2);
                            $dia = substr($data, 8, 2);
                            echo "$dia-$mes-$ano";
                            ?>
                        </td>
                        <td class="col"> <?php echo $retorno['email']; ?> </td>
                        <td class="col"> <?php echo ucfirst($retorno['sexo']); ?> </td>
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
                        <td class="col">
                            <?php
                            $telefone = $retorno['telefone'];
                            $parte1 = substr($telefone, 0, 2);
                            $parte2 = substr($telefone, 2, 1);
                            $parte3 = substr($telefone, 3, 4);
                            $parte4 = substr($telefone, 7, 4);
                            echo "($parte1) $parte2 $parte3-$parte4";
                            ?>
                        </td>

                        <td class="col">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalAlterar" onclick="setInformations
                                (['id', 'nome', 'dataNascimento', 'dataAdmissao', 'email', 'sexo', 'cpf', 'telefone'],
                                    [<?php echo $retorno['id']; ?>, 
                                    '<?php echo $retorno['nome']; ?>',
                                    '<?php echo $retorno['dataNascimento']; ?>',
                                    '<?php echo $retorno['dataAdmissao']; ?>',
                                    '<?php echo $retorno['email']; ?>',
                                    '<?php echo $retorno['sexo']; ?>',
                                    '<?php echo $retorno['cpf']; ?>',
                                    '<?php echo $retorno['telefone']; ?>']
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
    <div class="modal fade" id="modalAlterar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alterar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../funcionario/alterar">
                        @csrf
                        <div class="form-group">
                            <!-- -->
                            <div class="row">
                                <div class="col">
                                    <label>Nome</label>
                                    <input type="hidden" class="form-control" name="id" id="id" required>
                                    <input type="text" class="form-control" name="nome" id="nome" required>
                                </div>
                            </div>
                            <!-- -->
                            <div class="row mt-3">
                                <div class="col">
                                    <label>Data Nascimento</label>
                                    <input type="date" class="form-control" name="dataNascimento" id="dataNascimento"
                                        required>
                                </div>
                                <div class="col">
                                    <label>Data Admissão</label>
                                    <input type="date" class="form-control" name="dataAdmissao" id="dataAdmissao"
                                        required>
                                </div>
                            </div>
                            <!-- -->
                            <div class="row mt-3">
                                <div class="col-8">
                                    <label>E-mail</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>

                                <div class="col">
                                    <label>Sexo</label>
                                    <select class="form-control" name="sexo" id="sexo" required>
                                        <option value="" selected disabled>Selecionar...</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="feminino">Feminino</option>
                                    </select>
                                </div>
                            </div>
                            <!-- -->
                            <div class="row mt-3">
                                <div class="col">
                                    <label>CPF</label>
                                    <input type="" class="form-control" name="cpf" id="cpf" required>
                                </div>
                                <div class="col">
                                    <label>Telefone</label>
                                    <input type="number" class="form-control" name="telefone" id="telefone" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-3">
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
