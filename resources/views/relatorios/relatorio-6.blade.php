@include('layouts.menu')

<?php

use App\Models\DAO\RelatoriosDAO;

$_SESSION['relatorio'] = "relatorio-6";

?>

<body>

    <div class="container">

        <div class="mt-5">
            <p class="text-center fs-1">Relatório de Serviços - Hoje</p>
        </div>

        <div class="mt-4">
            <table class="table table-hover mt-4" style="font-size: 85%;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Data</th>
                        <th scope="col">Horário</th>
                        <th scope="col">Funcionário</th>
                        <th scope="col">Situação</th>
                        <th scope="col">Observação</th>
                        <th scope="col">Serviço</th>
                </thead>
                <tbody>
                    <?php
                    $relatoriosDAO = new RelatoriosDAO();
                    $request = $relatoriosDAO->getRelatorio6();

                    foreach ($request as $item) { ?>

                        <tr>
                            <td><?php echo $item['ID Serviço']; ?></td>
                            <td><?php echo $item['Data']; ?></td>
                            <td><?php echo $item['Horário']; ?></td>
                            <td><?php echo ucfirst($item['Funcionário']); ?></td>
                            <td><?php echo ucfirst($item['Situação']); ?></td>
                            <td><?php echo ucfirst($item['Observação']); ?></td>
                            <td><?php echo ucfirst($item['Serviço']); ?></td>
                        </tr>

                    <?php
                    }
                    $relatoriosDAO = new RelatoriosDAO();
                    $relatoriosDAO->limparSessaoFiltros();

                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>