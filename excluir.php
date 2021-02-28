<?php

    require __DIR__.'/vendor/autoload.php';
    
    use \App\Entidades\Ficha;

    //VALIDAÇÃO DO ID
    if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
        header('location: index.php?status=error');
        exit;
    }

    //CONSULTA FICHA
    $obFicha = Ficha::getFicha($_GET['id']);
    
    //Validando FICHA
    if(!$obFicha instanceof Ficha){
        header('location: index.php?status=error');
        exit;
    }

    //VALIDAÇÃO DO POST
    if(isset($_POST['excluir'])){
   
         $obFicha->excluir();

         header('location: index.php?status=success');

        
    }
    
    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/confirmar-exclusao.php';
    include __DIR__.'/includes/footer.php';
   
?>
