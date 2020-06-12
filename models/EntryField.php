<?php namespace LukeTowers\EEImport\Models;

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
     * @var array Relations
     */
    public $belongsToMany = [
        'groups' => [FieldGroup::class, 'table' => 'channel_field_groups_fields', 'key' => 'field_id', 'otherKey' => 'group_id'],
    ];
    public $hasMany = [
        'grid_columns' => [GridColumn::class, 'key' => 'field_id'],
    ];

    /**
     * Get the field ID for the provided field name
     */
    protected static $namesToId = [];
    public static function getIdForName($name)
    {
        if (empty(static::$namesToId)) {
            static::$namesToId = static::getEETable('channel_fields')->pluck('field_id', 'field_name');
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

    /**
     * Get this field's data using the provided Entry record
     *
     * @param Entry $entry
     * @return mixed
     */
    public function getValueFromEntry($entry)
    {
        $value = null;
        switch ($this->field_type) {
            case 'grid':
                $value = [];
                $columns = [];
                foreach ($this->grid_columns as $column) {
                    $columns[$column->col_id] = $column->col_name;
                }

                foreach (static::getEETable('channel_grid_field_' . $this->field_id)->where('entry_id', $entry->entry_id)->get() as $row) {
                    $rowData = [];
                    foreach ($columns as $id => $name) {
                        $rowData[$name] = $row->{'col_id_' . $id};
                    }
                    $value[] = $rowData;
                }
                break;
            default:
                $value = $entry->data->{'field_id_' . $this->field_id};
        }
        return $value;
    }
}
