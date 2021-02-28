<?php

$mensagem = '';

//GERA AS NOTIFICAÇÕES
if (isset($_GET['status'])) {

    switch ($_GET['status']) {
        case 'success':
            $mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
            break;
        case 'error':
            $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
            break;
        case 'duplicidade':
            if (isset($_GET['especialidade'], $_GET['planodesaude'])) {
                $mensagem = '<div class="alert alert-danger">Esta especialidade ' . $_GET['especialidade'] . ' já foi utilizada para o plano ' . $_GET['planodesaude'] . '.</div>';
            }
            break;
    }
}

//GERA AS FICHAS NA TABELA
$resultados = '';

foreach ($fichas as $ficha) {
    $resultados .=      '<tr>
                            <td>' . $ficha->NomePaciente . '</td>
                            <td>' . $ficha->NumeroCarteiraPlano . '</td>
                            <td>' . $ficha->NomePlanoDesaude . '</td>
                            <td>' . $ficha->NomeEspecialidade . '</td>
                            <td>
                            <a href= "editar.php?id=' . $ficha->Id . '">
                                <button type="button" class="btn btn-outline-primary">Editar</button>
                            </a>
                            <a href= "excluir.php?id=' . $ficha->Id . '">
                                 <button type="button" class="btn btn-outline-danger">Excluir</button>
                             </a>
                            </td>
                        </tr>';
}

?>

<div class="container-fluid text-light">
    <?= $mensagem ?>
    <div class="row mb-1">
        <div class="col-md-2">
            <h2>Fichas</h2>
        </div>
        <div class="col-md-6">

            <form method="get">
                <div class="input-group">
                    <select name="opcoes">
                        <option value="NomePaciente">Nome</option>
                        <option value="IdPlanoDeSaude">Plano de Saúde</option>
                        <option value="IdEspecialidade">Especialidade</option>
                        <option value="NumeroCarteiraPlano">Número da Carteira do Plano</option>
                    </select>
                    <input type="text" class="ml-1 form-control" name="conteudo">
                    <button type="submit" class="btn btn-info">&#8981;</button>
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <a href="cadastrar.php" class="btn btn-secondary">Cadastrar Ficha</a>
        </div>
    </div> <!-- /cabeçario -->
    <div class="row">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Número da Carteira do Plano</th>
                    <th scope="col">Plano de Saúde</th>
                    <th scope="col">Especialidade</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?= $resultados ?>
            </tbody>
        </table>
    </div> <!-- /tabela -->
</div>