@include('layouts.menu')

<body>
    <div class="position-relative vh-100">
        <h1 class="display-4 text-center">Cadastro de Clientes</h1>

        <div class="position-absolute top-50 start-50 translate-middle col-6">
            @include('layouts.alert')

            {{-- <form method="POST" action="../veiculo/cadastrar"> --}}
            <form>
                @csrf
                <div class="form-group">
                    <!-- -->
                    <div class="row">
                        <div class="col-8">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="nome" id="nome"
                                placeholder="Ex: Vinicius...">
                        </div>
                        <div class="col-4">
                            <label>Data Nascimento</label>
                            <input type="date" class="form-control" name="dataNascimento" id="dataNascimento"
                                placeholder="Ex: Prata, branco...">
                        </div>
                    </div>
                    <!-- -->
                    <div class="row mt-3">
                        <div class="col-4">
                            <label>CEP</label>
                            <input type="text" class="form-control" name="cep" id="cep"
                                placeholder="Ex: 2000, 2010...">
                        </div>
                        <div class="col-4">
                            <label>Cidade</label>
                            <input type="text" class="form-control" name="cidade" id="cidade" disabled placeholder="">
                        </div>
                        <div class="col-4">
                            <label>Estado</label>
                            <input type="text" class="form-control" name="estado" id="estado" disabled placeholder="">
                        </div>
                    </div>
                    <!-- -->
                    <div class="row mt-3">
                        <div class="col">
                            <label>Endereco</label>
                            <input type="" class="form-control" name="endereco" id="endereco" placeholder="">
                        </div>
                    </div>
                    <!-- -->
                    <div class="row mt-3">
                        <div class="col">
                            <label>Cliente</label>
                            <input type="" class="form-control" name="cliente" id="cliente" placeholder="">
                        </div>
                    </div>
                    <!-- -->
                </div>
                <button type="button" class="btn btn-primary mt-3" onclick="consultarCEP()">Cadastrar</button>
            </form>
        </div>
    </div>
</body>
