<?php

namespace App\Entidades;

use \App\BD\BancoDeDados;
use \PDO;
use PDOException;

class PlanoDeSaude
{

    /**
     * identificador
     * @var integer
     */
    public $Id;

    /**
     * Nome do Plano de Saúde
     * @var string
     */
    public $Nome;

    /** 
     * Método responsavel por obter os Plano de Saude
     * @param  string $where
     * @param  string $order
     * @param  string $limit
     * @return array
     */
    public static function getPlanosDeSaude($where = null, $order = null, $limit = null){

        return (new BancoDeDados('planosdesaude'))->select($where, $order, $limit)
        ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsável por retornar o Nome de um Plano de Saúde a partir do Id
     * @param string $id
     */
    public static function getPlanosDeSaudeNome($id){

        return (new BancoDeDados('planosdesaude'))->select($id . '= planosdesaude.Id', null, null, ' Nome')->fetchColumn();
    }

    /**
     * Método responsável por retornar o Id de um Plano de Saude a patir do Nome
     * @param string $nome
     */
    public static function getPlanosDeSaudeId($nome){

        return (new BancoDeDados('planosdesaude'))->select($nome . '= planosdesaude.Nome', null, null, ' Id')->fetchColumn();
    }
}
