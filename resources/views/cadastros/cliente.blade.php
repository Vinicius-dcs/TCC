@include('layouts.menu')

<body>
    <div class="position-relative vh-100">
        <h1 class="display-4 text-center">Cadastro de Clientes</h1>

        <div class="position-absolute top-50 start-50 translate-middle col-6">
            @include('layouts.alert')

            <form method="POST" action="../cliente/cadastrar">
                @csrf
                <div class="form-group">
                    <!-- -->
                    <div class="row">
                        <div class="col-8">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="nome" id="nome" required>
                        </div>
                        <div class="col-4">
                            <label>Data Nascimento</label>
                            <input type="date" class="form-control" name="dataNascimento" id="dataNascimento" required>
                        </div>
                    </div>
                    <!-- -->
                    <div class="row mt-3">
                        <div class="col-8">
                            <label>Endereço</label>
                            <input type="" class="form-control" name="endereco" id="endereco" required>
                        </div>
                        <div class="col-4">
                            <label>CPF</label>
                            <input type="" class="form-control" name="cpf" id="cpf" required>
                            <p hidden id="cpfInvalido" style="position: absolute; font-size:12px"> CPF inválido! </p>
                        </div>
                    </div>
                    <!-- -->
                    <div class="row mt-3">
                        <div class="col-4">
                            <label>CEP</label>
                            <input type="text" class="form-control" name="cep" id="cep" required>
                            <p hidden id="cepInvalido" style="position: absolute; font-size:12px"> CEP inválido! </p>
                        </div>
                        <div class="col-4">
                            <label>Cidade</label>
                            <input type="text" class="form-control" name="cidade" id="cidade" value="" readonly required>
                        </div>
                        <div class="col-4">
                            <label>Estado</label>
                            <input type="text" class="form-control" name="estado" id="estado" value="" readonly required>
                        </div>
                    </div>
                    <!-- -->
                </div>
                <button id="btnCadastrar" type="submit" class="btn btn-primary mt-3" disabled>Cadastrar</button>
            </form>
        </div>
    </div>
</body>
