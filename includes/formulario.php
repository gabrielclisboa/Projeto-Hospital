<?php


$resultadoEspecialidade = '';
$resultadoPlanoDeSaude = '';
$mensagem = '';


//GERA A TABELA ESPECIALIDADES
foreach ($especialidades as $especialidade) {
  $resultadoEspecialidade .=
    '<tr>
                            <td>' . $especialidade->Nome . '</td>
                          </tr>';
}

//GERA A TABELA PLANOS DE SAÚDE
foreach ($planosdesaude as $plano) {
  $resultadoPlanoDeSaude .=
    '<tr>
                          <td>' . $plano->Nome . '</td>
                        </tr>';
}

$selectEspecialidade = '';
$selectPlanoDeSaude = '';

//GERA O SELECT DE ESPECIALIDADES
foreach ($especialidades as $especialidade) {
  if($especialidade->Id == $obFicha->IdEspecialidade){ //CASO SEJA A ESPECIALIDADE ESCOLHIDA PELO O PACIENTE
    $selectEspecialidade .=
    '<option selected value ="'.$especialidade->Id.'">' .$especialidade->Nome. '</option>';  //PRÉ SELECIONADO

  }else{
    $selectEspecialidade .=
    '<option value ="'.$especialidade->Id.'">' .$especialidade->Nome. '</option>';
  }

}

//GERA O SELECT DE PLANOS DE SAÚDE
foreach ($planosdesaude  as  $plano) {
  if($plano->Id == $obFicha->IdPlanoDeSaude ){  //CASO SEJA O PLANO DE SAÚDE UTILIZADO PELO O PACIENTE
    $selectPlanoDeSaude .=
    '<option selected value ="'.$plano->Id.'">' . $plano->Nome . '</option>'; //PRÉ SELECIONADO

  }else{
    $selectPlanoDeSaude .=
    '<option value ="'.$plano->Id.'">' . $plano->Nome . '</option>';

  }
}
?>

<div class="text-light">
  <h2><?= TITLE ?></h2>

  <?=$mensagem?>
  <div class="row">

    <div class="col-6">
      <form method="post">
        <div class="form-group">
          <label>Nome</label>
          <input type="text" class="form-control" name="nome" value = "<?=$obFicha->NomePaciente?>">
        </div>
        <div class="form-group">
          <label>Número da Carteira</label>
          <input type="number" class="form-control" name="ncarteira" value = "<?=$obFicha->NumeroCarteiraPlano?>">
        </div>
        <div class="form-group">
          <label>Especialidade</label>

          <select class="form-control" name="especialidade">
            <?= $selectEspecialidade ?>
          </select>

        </div>
        <div class="form-group">
          <label>Plano de Saude</label>
          <select class="form-control" name="planodesaude">
            <?= $selectPlanoDeSaude ?>
          </select>
        </div>
        <button type="submit" class="btn btn-warning">Enviar</button>
      </form>
    </div>

    <div class="col-3">
      <h3>Especialidades</h3>
      <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">Nome</th>
          </tr>
        </thead>
        <tbody>
          <?= $resultadoEspecialidade ?>
        </tbody>
      </table>
    </div>

    <div class="col-3">
      <h3>Planos de Saúde</h3>
      <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">Nome</th>
          </tr>
        </thead>
        <tbody>
          <?= $resultadoPlanoDeSaude ?>
        </tbody>
      </table>
    </div>

  </div>

</div>