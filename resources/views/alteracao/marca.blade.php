@include('layouts.menu')

<body>
    <div class="position-relative vh-100">

        <h1 class="display-4 text-center">Alteração de Marcas</h1>

        <div class="position-absolute top-50 start-50 translate-middle col-5">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td> <button type="button" class="btn btn-primary">Left</button> </td>
                        <td> <button type="button" class="btn btn-primary">Left</button> </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
