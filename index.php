<?php
    require __DIR__.'/vendor/autoload.php';

    use \App\Entidades\Ficha;
    use \App\Entidades\Especialidade;
    use \App\Entidades\PlanoDeSaude;

    //BUSCA
    $busca = filter_input(INPUT_GET,'conteudo',FILTER_SANITIZE_STRING);

    //FILTRO
    $opcoes = filter_input(INPUT_GET,'opcoes',FILTER_SANITIZE_STRING);


    //TRANSFORMA OS NOMES EM ID'S
    if($opcoes=="IdPlanoDeSaude"){
        $busca = PlanoDeSaude::getPlanosDeSaudeId('"'.$busca.'"');

    }
    if($opcoes=="IdEspecialidade"){
        $busca = Especialidade::getEspecialidadeId('"'.$busca.'"');

    }

    //CONDIÇÕES SQL, VERIFICA SE TEM CONTEÚDO OU NÃO      
    $condicoes = [
        strlen($busca) ? $opcoes.' LIKE "%'.str_replace(' ','%',$busca).'%"' : null
    ];

    //CLAUSULA WHERE
    $where = implode(' AND ',$condicoes);


    //OBTÉM AS FICHAS
    $fichas = Ficha::getFichas($where);
    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/fichas.php';
    include __DIR__.'/includes/footer.php';
?>
  