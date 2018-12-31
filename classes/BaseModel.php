<?php namespace LukeTowers\EEImport\Classes;

use Model;
use Config;

abstract class BaseModel extends Model
{
    public function __construct()
    {
        $this->connection = Config::get('luketowers.eeimport::default_ee_connection');

        return parent::__construct(...func_get_args());
    }
}