<?php namespace LukeTowers\EEImport\Models;

use LukeTowers\EEImport\Classes\BaseModel;

/**
 * General purpose Model
 */
class General extends BaseModel
{
    use \LukeTowers\EEImport\Traits\DecodesEEData;
    use \LukeTowers\EEImport\Traits\DecodesEEDates;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'categories';

    /**
     * @var array List of attribute names which store data encoded by ExpressionEngine
     */
    protected $eeEncodedAttributes = [];

    /**
     * @var array List of attribute names that are used by EE to store date information
     */
    protected $eeDates = [];

    /**
     * Set the primary key for this table
     *
     * @param string $key
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->primaryKey = $key;
    }

    /**
     * Set the table for this model
     *
     * @param string $table
     * @return void
     */
    public function setTable($table)
    {
        $this->table = $table;
    }
}
