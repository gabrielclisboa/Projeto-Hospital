<?php

    require __DIR__.'/vendor/autoload.php';
    
    use \App\Entidades\Ficha;
    use \App\Entidades\Especialidade;
    use \App\Entidades\PlanoDeSaude;
    define('TITLE','Cadastrar');

    
    $obFicha = new Ficha;
    
    //VALIDAÇÃO DO POST
    if(isset($_POST['nome'],$_POST['ncarteira'],$_POST['especialidade'],$_POST['planodesaude'])){

        $obFicha->NomePaciente = $_POST['nome'];
        $obFicha->NumeroCarteiraPlano = $_POST['ncarteira'];
        $obFicha->IdEspecialidade = $_POST['especialidade'];
        $obFicha->IdPlanoDeSaude = $_POST['planodesaude'];

        //VERIFICA DUPLICIDADE
        $ficha = $obFicha->verificaDuplicidade($obFicha->NumeroCarteiraPlano);
    
        if($ficha==NULL){  //CASO NÃO EXISTA OBJETOS DUPLICADOS
            $obFicha->cadastrar();
            header('location: index.php?status=success');
            
        }else{
            $ficha[0]->NomeEspecialidade = Especialidade::getEspecialidadeNome($ficha[0]->IdEspecialidade);
            $ficha[0]->NomePlanoDesaude = PlanoDeSaude::getPlanosDeSaudeNome($ficha[0]->IdPlanoDeSaude);
            
            header('location: index.php?status=duplicidade&planodesaude='.$ficha[0]->NomePlanoDesaude.'&especialidade='.$ficha[0]->NomeEspecialidade);
        }
        exit;
    }
    
    $especialidades = Especialidade::getEspecialidades();
    $planosdesaude =  PlanoDeSaude::getPlanosDeSaude();

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/formulario.php';
    include __DIR__.'/includes/footer.php';
   
?>
