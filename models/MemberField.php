<?php namespace LukeTowers\EEImport\Models;

use Db;
use Config;
use LukeTowers\EEImport\Classes\BaseModel;

/**
 * MemberField Model
 */
class MemberField extends BaseModel
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'member_fields';

    /**
     * @var string The primary key column for the table
     */
    protected $primaryKey = 'm_field_id';

    /**
     * Get the field ID for the provided field name
     */
    protected static $namesToId = [];
    public static function getIdForName($name)
    {
        if (empty(static::$namesToId)) {
            static::$namesToId = Db::connection(Config::get('luketowers.eeimport::default_ee_connection'))->table('member_fields')->pluck('m_field_id', 'm_field_name');
        }

        if (!empty(static::$namesToId[$name])) {
            return static::$namesToId[$name];
        } else {
            return null;
        }
    }

    /**
     * Get all available field names
     *
     * @return array
     */
    public static function getFieldNames()
    {
        return Db::connection(Config::get('luketowers.eeimport::default_ee_connection'))->table('member_fields')->pluck('m_field_name');
    }
}
