@include('layouts.menu')

<body>
    <div class="position-relative vh-100">
        <h1 class="display-4 text-center">Cadastro de Funcionários</h1>

        <div class="position-absolute top-50 start-50 translate-middle col-6">
            @include('layouts.alert')

            <form method="POST" action="../funcionario/cadastrar">
                @csrf
                <div class="form-group">
                    <!-- -->
                    <div class="row">
                        <div class="col">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="nome" id="nome" required>
                            <input type="hidden" class="form-control" name="validaCadastroOuAlterar" id="validaCadastroOuAlterar" value="0" required>
                        </div>
                    </div>
                    <!-- -->
                    <div class="row mt-3">
                        <div class="col">
                            <label>Data Nascimento</label>
                            <input type="date" class="form-control" name="dataNascimento" id="dataNascimento" required>
                        </div>
                        <div class="col">
                            <label>Data Admissão</label>
                            <input type="date" class="form-control" name="dataAdmissao" id="dataAdmissao" required>
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
                                <option value="outro">Outro</option>
                            </select>
                        </div>
                    </div>
                    <!-- -->
                    <div class="row mt-3">
                        <div class="col">
                            <label>CPF</label>
                            <input type="" class="form-control" name="cpf" id="cpf" required>
                            <p hidden id="cpfInvalido" style="position: absolute; font-size:12px"> CPF inválido! </p>
                        </div>
                        <div class="col">
                            <label>Telefone</label>
                            <input type="" class="form-control" name="telefone" id="telefone"
                                placeholder="(xx) xxxxx-xxxx" maxlength="15" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3" id="btnCadastrar" name="btnCadastrar" disabled>Cadastrar</button>
            </form>
        </div>
    </div>

</body>
