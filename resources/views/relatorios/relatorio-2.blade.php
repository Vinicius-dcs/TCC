@include('layouts.menu')

<?php

use App\Models\DAO\RelatoriosDAO;

$_SESSION['relatorio'] = "relatorio-2";

?>

<body>

    <div class="container">

        <div class="mt-5">
            <p class="text-center fs-1">Receita com Manutenções</p>
        </div>

        <form action="../relatorios/filtrar" method="POST">
            @csrf
            <div class="mt-5">
                <div class="row">
                    <div class="col-1 mt-2">
                        <label class="form-label">Data Inicio</label>
                    </div>
                    <div class="col-2">
                        <input type="date" class="form-control" name="dataInicio" value="<?php echo isset($_SESSION['dataInicio']) ? $_SESSION['dataInicio'] : ""; ?>">
                    </div>
                    <div class="col-1 mt-2">
                        <label class="form-label">Data Fim</label>
                    </div>
                    <div class="col-2" name="dataFim">
                        <input type="date" class="form-control" name="dataFim" value="<?php echo isset($_SESSION['dataFim']) ? $_SESSION['dataFim'] : ""; ?>">
                    </div>
                    <div class="col-1 mt-2">
                        <label class="form-label">Situação</label>
                    </div>
                    <div class="col-3" name="situacaoManutencao">
                        <select name="situacao" class="form-select">
                            <option value="" selected>Selecionar..</option>
                            <option value="">Todas</option>
                            <option value="concluida">Concluída</option>
                            <option value="pendente">Pendente</option>
                        </select>
                    </div>
                    <div class="col">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="mt-4">
            <table class="table table-hover mt-4" style="font-size: 85%;">
                <thead>
                    <tr>
                        <th scope="col">Data</th>
                        <th scope="col">Receita</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_SESSION['dataInicio']) && isset($_SESSION['dataFim'])) {
                        $relatoriosDAO = new RelatoriosDAO();
                        $request = $relatoriosDAO->getRelatorio2();

                        foreach ($request as $item) { ?>

                            <tr>
                                <td><?php echo $item['Data']; ?></td>
                                <td><?php echo $item['Receita']; ?></td>
                            </tr>

                    <?php
                        }
                        $relatoriosDAO = new RelatoriosDAO();
                        $relatoriosDAO->limparSessaoFiltros();
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>