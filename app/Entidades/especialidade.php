<?php

namespace App\Entidades;

use \App\BD\BancoDeDados;
use \PDO;

class Especialidade
{

    /**
     * identificador
     * @var integer
     */
    public $Id;

    /**
     * Nome da especialidade
     * @var string
     */
    public $Nome;


    /** 
     * Método responsavel por obter as Especialidades
     * @param  string $where
     * @param  string $order
     * @param  string $limit
     * @return array
     */
    public static function getEspecialidades($where = null, $order = null, $limit = null){

        $especialidades = (new BancoDeDados('especialidades'))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);

        return $especialidades;
    }

    /**
     * Método responsável por retornar o Nome de uma Especialidade a partir do Id
     * @param string $id
     */
    public static function getEspecialidadeNome($id){

        return (new BancoDeDados('especialidades'))->select($id . '= especialidades.Id', null, null, ' Nome')->fetchColumn();
    }

    /**
     * Método responsável por retornar o Id de uma Especialidade a patir do Nome
     * @param string $nome
     */
    public static function getEspecialidadeId($nome){

        return (new BancoDeDados('especialidades'))->select($nome . '= especialidades.Nome', null, null, ' Id')->fetchColumn();
    }
}
