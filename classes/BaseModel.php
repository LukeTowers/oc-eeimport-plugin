<?php namespace LukeTowers\EEImport\Classes;

use Db;
use Model;
use Config;

abstract class BaseModel extends Model
{
    public function __construct()
    {
        $this->connection = Config::get('luketowers.eeimport::default_ee_connection');

        return parent::__construct(...func_get_args());
    }

    public static function getEETable($table)
    {
        return Db::connection(Config::get('luketowers.eeimport::default_ee_connection'))->table($table);
    }
}