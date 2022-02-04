<?php

namespace App\Models\DAO;

use App\Models\DAO\BaseDAO;

class RelatoriosDAO extends BaseDAO
{

    public function setFiltrosSession()
    {
        session_start();
        $relatorio = $_SESSION['relatorio'];
        if (isset($_POST['dataInicio'])) {
            $_SESSION['dataInicio'] = $_POST['dataInicio'];
        }
        if (isset($_POST['dataFim'])) {
            $_SESSION['dataFim'] = $_POST['dataFim'];
        }
        if (isset($_POST['situacao'])) {
            $_SESSION['situacao'] = $_POST['situacao'];
        }

        header('Location: ../relatorios/' . $relatorio);
        exit;
    }

    public function limparSessaoFiltros()
    {
        if (isset($_SESSION['dataInicio'])) {
            unset($_SESSION['dataInicio']);
        }
        if (isset($_SESSION['dataFim'])) {
            unset($_SESSION['dataFim']);
        }
    }

    public function getRelatorio1()
    {
        try {
            $dataInicio = !empty($_SESSION['dataInicio']) ? $_SESSION['dataInicio'] : '1999-01-01';
            $dataFim = !empty($_SESSION['dataFim']) ? $_SESSION['dataFim'] : '2099-01-01';
            
            $sql = "select td.idVeiculo as 'ID Veículo', v.descricao as 'Veículo', m.nome as 'Marca',count(td.idVeiculo) as 'Quantidade de Testes Drives' from testedrives td
            inner join veiculos v on v.id = td.idVeiculo
            left join marcas m on m.id = v.idMarca
            where data between '$dataInicio' and '$dataFim'
            group by td.idVeiculo
            order by count(td.idVeiculo) desc";

            return $this->select($sql);
        } catch (\Exception $erro) {
            echo "(RelatoriosDAO) Erro ao gerar relatório 1 -> " . $erro;
        }
    }

    public function getRelatorio2()
    {
        try {
            $dataInicio = !empty($_SESSION['dataInicio']) ? $_SESSION['dataInicio'] : '1999-01-01';
            $dataFim = !empty($_SESSION['dataFim']) ? $_SESSION['dataFim'] : '2099-01-01';
            $situacao = !empty($_SESSION['situacao']) ? $_SESSION['situacao'] : '%%';

            $sql =
                "SELECT 
                    date_format(data, '%d/%m/%Y') AS 'Data', 
                    concat('R$', format(sum(valor), 2, 'de_DE' ))  AS 'Receita'
                FROM 
                    manutencoes 
                WHERE 
                    data BETWEEN '$dataInicio' AND '$dataFim' 
                    AND situacao LIKE '$situacao'
                GROUP BY data";

            return $this->select($sql);
        } catch (\Exception $erro) {
            echo "(RelatoriosDAO) Erro ao gerar relatório 2 -> " . $erro;
        }
    }

    public function getRelatorio3()
    {
        try {
            $dataInicio = !empty($_SESSION['dataInicio']) ? $_SESSION['dataInicio'] : '1999-01-01';
            $dataFim = !empty($_SESSION['dataFim']) ? $_SESSION['dataFim'] : '2099-01-01';
            
            $sql = "WITH
                    qtdManutencao as (
                        select
                            idFuncionario,
                            count(id) as qtd,
                            data
                        from
                            manutencoes
                        where
                            situacao = 'concluida'
                        group by
                            idFuncionario   
                    ),
                    qtdTesteDrives as (
                        select
                            idFuncionario,
                            count(id) as qtd,
                            data
                        from
                            testedrives
                        where
                            situacao = 'concluido'
                        group by
                            idFuncionario
                    )
                select
                    f.id as 'ID Funcionário',
                    f.nome as 'Nome',
                    m.qtd as 'Quantidade de Manutenções',
                    t.qtd as 'Quantidade de Testes Drives'
                from
                    funcionarios f
                    left join qtdManutencao m on m.idFuncionario = f.id
                    left join qtdTesteDrives t on t.idFuncionario = f.id
                    where m.data between '$dataInicio' and '$dataFim' or m.data is null
                    and t.data between '$dataInicio' and '$dataFim' or t.data is null";

            return $this->select($sql);
        } catch (\Exception $erro) {
            echo "(RelatoriosDAO) Erro ao gerar relatório 3 -> " . $erro;
        }
    }

    public function getRelatorio4()
    {
        try {
            $dataInicio = !empty($_SESSION['dataInicio']) ? $_SESSION['dataInicio'] : '1999-01-01';
            $dataFim = !empty($_SESSION['dataFim']) ? $_SESSION['dataFim'] : '2099-01-01';
            $situacao = !empty($_SESSION['situacao']) ? $_SESSION['situacao'] : '%%';

            $sql = "SELECT 
                    m.id as 'ID', 
                    date_format(m.data, '%d/%m/%Y') as 'Data', 
                    m.horario as 'Horário', 
                    concat('R$', format(sum(m.valor), 2, 'de_DE' ))  as 'Valor',
                    m.tipomanutencao as 'Tipo Manutenção',
                    m.situacao as 'Situação',
                    v.descricao as 'Veículo',
                    f.nome as 'Funcionário'
                from manutencoes m
                inner join veiculos v on v.id = m.idveiculo
                inner join funcionarios f on f.id = m.idFuncionario
                where m.data between '$dataInicio' and '$dataFim'
                and m.situacao LIKE '$situacao'
                group by m.id";

            return $this->select($sql);
        } catch (\Exception $erro) {
            echo "(RelatoriosDAO) Erro ao gerar relatório 4 -> " . $erro;
        }
    }

    public function getRelatorio5()
    {
        try {
            $dataInicio = !empty($_SESSION['dataInicio']) ? $_SESSION['dataInicio'] : '1999-01-01';
            $dataFim = !empty($_SESSION['dataFim']) ? $_SESSION['dataFim'] : '2099-01-01';
            $situacao = !empty($_SESSION['situacao']) ? $_SESSION['situacao'] : '%%';

            $sql = "SELECT 
                        td.id as 'ID',
                        date_format(td.data, '%d/%m/%Y') as 'Data', 
                        td.horario as 'Horário', 
                        td.situacao as 'Situação',
                        c.nome as 'Nome Cliente',
                        v.descricao as 'Veículo',
                        f.nome as 'Funcionário'
                    from testedrives td
                    inner join clientes c on c.id = td.idCliente
                    inner join veiculos v on v.id = td.idVeiculo
                    inner join funcionarios f on f.id = td.idFuncionario
                    where td.data between '$dataInicio' and '$dataFim'
                    and td.situacao LIKE '$situacao'
                    group by td.id;";

            return $this->select($sql);
        } catch (\Exception $erro) {
            echo "(RelatoriosDAO) Erro ao gerar relatório 5 -> " . $erro;
        }
    }

    public function getRelatorio6() {
        try {

            $sql = "SELECT
                    m.id as 'ID Serviço',
                    date_format(m.data, '%d/%m/%Y') as 'Data', 
                    m.horario as 'Horário',
                    f.nome as 'Funcionário',
                    m.situacao as 'Situação',
                    m.descricao as 'Observação',
                    'Manutenção' as 'Serviço'
                from
                    manutencoes m
                inner join funcionarios f on f.id = m.idFuncionario    
                where m.data = curdate()
                
                union
                
                select
                    td.id as 'ID Serviço',
                    date_format(td.data, '%d/%m/%Y') as 'Data', 
                    td.horario as 'Horário', 
                    f.nome as 'Funcionário',
                    td.situacao as 'Situação',
                    td.observacao as 'Observação',
                    'Teste Drive' as 'Serviço'
                from
                    testedrives td
                inner join funcionarios f on f.id = td.idFuncionario    
                where td.data = curdate()";

            return $this->select($sql);
        } catch(\Exception $erro) {
            echo "(RelatoriosDAO) Erro ao gerar relatório 6 -> " . $erro;
        }
    }

}
