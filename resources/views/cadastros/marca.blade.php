@include('layouts.menu')

<body>
    <div class="position-relative vh-100">
        <h1 class="display-4 text-center">Cadastro de Marcas</h1>

        <div class="position-absolute top-50 start-50 translate-middle col-6">
            @include('layouts.alert')

            <form method="POST" action="../marca/cadastrar">
                @csrf
                <div class="form-group">
                    <label>Digite o nome da marca</label>
                    <input type="text" class="form-control" name="nome" id="nome"
                        placeholder="Ex: BMW, Audio, Chevrolet...">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Cadastrar</button>
            </form>
        </div>
    </div>
</body>
