<?php

    require __DIR__.'/vendor/autoload.php';
    
    use \App\Entidades\Ficha;
    use \App\Entidades\Especialidade;
    use \App\Entidades\PlanoDeSaude;

    define('TITLE','Editar Vaga');

    ///VALIDAÇÃO DO ID
    if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
        header('location: index.php?status=error');
        exit;
    }

    //CONSULTA A FICHA
    $obFicha = Ficha::getFicha($_GET['id']);
    $obFichaAlterado = new Ficha;
    
    //VALIDAÇÃO DA FICHA
    if(!$obFicha instanceof Ficha){
        header('location: index.php?status=error');
        exit;
    }

    //VALIDAÇÃO DO POST
    if(isset($_POST['nome'],$_POST['ncarteira'],$_POST['especialidade'],$_POST['planodesaude'])){


        $obFichaAlterado->Id = $obFicha->Id; 
        $obFichaAlterado->NomePaciente = $_POST['nome'];
        $obFichaAlterado->NumeroCarteiraPlano = $_POST['ncarteira'];
        $obFichaAlterado->IdEspecialidade = $_POST['especialidade'];
        $obFichaAlterado->IdPlanoDeSaude = $_POST['planodesaude'];

        $ficha= $obFichaAlterado->verificaDuplicidade(); //VERIFICA SE HÁ DUPLICIDADE
    
        if( $ficha == NULL){  //CASO O USUÁRIO ALTERE TUDO
            $obFichaAlterado->atualizar();
            header('location: index.php?status=success');
            
        }else if($ficha[0]->NumeroCarteiraPlano == $obFicha->NumeroCarteiraPlano && //CASO O USUÁRIO ALTERE APENAS O NOME OU O NÚMERO DA CARTEIRA
                 $ficha[0]->IdEspecialidade == $obFicha->IdEspecialidade && 
                 $ficha[0]->IdPlanoDeSaude == $obFicha->IdPlanoDeSaude){
            $obFichaAlterado->atualizar();
            header('location: index.php?status=success');
        }else{ //OCORREU DUPLICIDADE

            //PEGA O NOME DA ESPECIALIDADE E DO PLANO DE SAÚDE DO OBJETO QUE JÁ EXISTE 
            $ficha[0]->NomeEspecialidade = Especialidade::getEspecialidadeNome($ficha[0]->IdEspecialidade); 
            $ficha[0]->NomePlanoDesaude = PlanoDeSaude::getPlanosDeSaudeNome($ficha[0]->IdPlanoDeSaude);
            
            header('location: index.php?status=duplicidade&planodesaude='.$ficha[0]->NomePlanoDesaude.'&especialidade='.$ficha[0]->NomeEspecialidade);
         
        }
        exit;
        
    }
    
    //PEGA OS DADOS DE ESPECIALIDADES E PLANOS DE SAÚDE PARA FAZER AS TABELAS
    $especialidades = Especialidade::getEspecialidades();
    $planosdesaude =  PlanoDeSaude::getPlanosDeSaude();

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/formulario.php';
    include __DIR__.'/includes/footer.php';
