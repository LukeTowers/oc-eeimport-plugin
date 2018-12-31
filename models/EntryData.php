<?php namespace LukeTowers\EEImport\Models;

use LukeTowers\EEImport\Classes\BaseModel;

/**
 * EntryData Model
 */
class EntryData extends BaseModel
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'channel_data';

    /**
     * @var string The primary key column for the table
     */
    protected $primaryKey = 'entry_id';

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'entry' => [Entry::class, 'key' => 'entry_id'],
    ];
}
