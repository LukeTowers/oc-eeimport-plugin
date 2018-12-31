<?php namespace LukeTowers\EEImport\Models;

use Db;
use Config;
use LukeTowers\EEImport\Classes\BaseModel;

/**
 * EntryField Model
 */
class EntryField extends BaseModel
{
    use \LukeTowers\EEImport\Traits\DecodesEEData;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'channel_fields';

    /**
     * @var string The primary key column for the table
     */
    protected $primaryKey = 'field_id';

    /**
     * @var array List of attribute names which store data encoded by ExpressionEngine
     */
    protected $eeEncodedAttributes = ['field_settings'];

    /**
     * Get the field ID for the provided field name
     */
    protected static $namesToId = [];
    public static function getIdForName($name)
    {
        if (empty(static::$namesToId)) {
            static::$namesToId = Db::connection(Config::get('luketowers.eeimport::default_ee_connection'))->table('channel_fields')->pluck('field_id', 'field_name');
        }

        if (!empty(static::$namesToId[$name])) {
            return static::$namesToId[$name];
        } else {
            return null;
        }
    }

    /**
     * Get the available field names for the provided query
     *
     * @param QueryBuilder $query
     * @return array
     */
    public function scopeNames($query)
    {
        return $query->pluck('field_name')->all();
    }
}
