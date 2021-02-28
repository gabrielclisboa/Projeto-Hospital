<?php

namespace App\Entidades;

use \App\BD\BancoDeDados;
use \App\Entidades\Especialidade;
use \App\Entidades\PlanoDeSaude;
use \PDO;

class Ficha{
    /**
     * identificador
     * @var integer
     */
    public $Id;

    /**
     * Nome do usuário
     * @var string
     */
    public $NomePaciente;

    /**
     * Número da carteira
     * @var string
     */
    public $NumeroCarteiraPlano;

    /**
     * Chave estrangeira da tabela Plano de Saúde
     * @var integer
     */
    public $IdPlanoDeSaude;

    /**
     * Chave estrangeira da tabela Especialidades
     * @var integer
     */
    public $IdEspecialidade;

    /**
     * Nome da especialidade
     * @var string
     */
    public $NomeEspecialidade;

    /**
     * Nome do plano de saúde
     * @var string
     */
    public $NomePlanoDesaude;

    /** 
     * Verifica se há duplicidade de registros, caso haja ele retorna a ficha reptida
     * @return array
     */
    public function verificaDuplicidade(){

        return (new BancoDeDados('fichapaciente'))->select('fichapaciente.IdPlanoDeSaude = ' . $this->IdPlanoDeSaude . '
            AND fichapaciente.IdEspecialidade = ' . $this->IdEspecialidade . ' AND fichapaciente.NumeroCarteiraPlano = ' . $this->NumeroCarteiraPlano)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsável por cadastrar uma nova vaga no banco
     * @return boolean
     */
    public function cadastrar(){
        //INSERINDO FICHA NO BD 
        $obBancoDeDados = new BancoDeDados('fichapaciente');
        $this->Id = $obBancoDeDados->insert([
            'NomePaciente' => $this->NomePaciente,
            'NumeroCarteiraPlano' => $this->NumeroCarteiraPlano,
            'IdPlanoDeSaude' => $this->IdPlanoDeSaude,
            'IdEspecialidade' =>  $this->IdEspecialidade
        ]);
    }

    /**
     * Método responsavel por obter as fichas do banco de dados e tranformar
     * @param  string $where
     * @param  string $order
     * @param  string $limit
     * @return array
     */
    public static function getFichas($where = null, $order = null, $limit = null){
        $fichas = (new BancoDeDados('fichapaciente'))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);

        //TRANSFORMA OS ID'S DAS FK EM NOMES
        foreach ($fichas as $f) {
            $f->NomeEspecialidade = Especialidade::getEspecialidadeNome($f->IdEspecialidade);
            $f->NomePlanoDesaude = PlanoDeSaude::getPlanosDeSaudeNome($f->IdPlanoDeSaude);
        }
        return $fichas;
    }

    /**
     * Método responsavel por obter as fichas do banco de dados e tranformar os id 's em nomes
     * @param  string $id
     * @return array
     */
    public static function getFicha($id){
        $fichas = (new BancoDeDados('fichapaciente'))->select('id = ' . $id)
            ->fetchObject(self::class);

        $fichas->NomeEspecialidade = Especialidade::getEspecialidadeNome($fichas->IdEspecialidade);
        $fichas->NomePlanoDesaude = PlanoDeSaude::getPlanosDeSaudeNome($fichas->IdPlanoDeSaude);

        return $fichas;
    }

    /**
     * Método respoável por atualizar uma ficha 
     * @return bool
     */
    public function atualizar(){

        return (new BancoDeDados('fichapaciente'))->update('id = ' . $this->Id, [
            'NomePaciente' => $this->NomePaciente,
            'NumeroCarteiraPlano' => $this->NumeroCarteiraPlano,
            'IdPlanoDeSaude' => $this->IdPlanoDeSaude,
            'IdEspecialidade' =>  $this->IdEspecialidade

        ]);
    }
    
    /**
     * Método respoável por excluir uma ficha 
     * @return bool
     */
    public function excluir(){

        return (new BancoDeDados('fichapaciente'))->delete('id = ' . $this->Id);
    }
}
