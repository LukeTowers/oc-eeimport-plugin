<?php namespace LukeTowers\EEImport\Models;

use LukeTowers\EEImport\Classes\BaseModel;

/**
 * GridColumn Model
 */
class GridColumn extends BaseModel
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'grid_columns';

    /**
     * @var string The primary key column for the table
     */
    protected $primaryKey = 'col_id';

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'field' => [EntryField::class, 'key' => 'field_id'],
    ];
}
