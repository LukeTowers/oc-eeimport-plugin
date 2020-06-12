<?php namespace LukeTowers\EEImport\Models;

use LukeTowers\EEImport\Classes\BaseModel;

/**
 * FieldGroup Model
 */
class FieldGroup extends BaseModel
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'field_groups';

    /**
     * @var string The primary key column for the table
     */
    protected $primaryKey = 'group_id';

    /**
     * @var array Relations
     */
    public $belongsToMany = [
        'channels' => [Channel::class, 'table' => 'channels_channel_field_groups', 'key' => 'group_id', 'otherKey' => 'channel_id'],
        'fields' => [EntryField::class, 'table' => 'channel_field_groups_fields', 'key' => 'group_id', 'otherKey' => 'field_id'],
    ];
}
