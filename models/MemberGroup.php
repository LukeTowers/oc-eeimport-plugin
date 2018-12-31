<?php namespace LukeTowers\EEImport\Models;

use LukeTowers\EEImport\Classes\BaseModel;

/**
 * MemberGroup Model
 */
class MemberGroup extends BaseModel
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'member_groups';

    /**
     * @var string The primary key column for the table
     */
    protected $primaryKey = 'group_id';

    /**
     * @var array Relations
     */
    public $hasMany = [
        'members' => [Member::class, 'key' => 'group_id'],
    ];
    public $belongsToMany = [
        'channels' => [Channel::class, 'table' => 'channel_member_groups', 'key' => 'group_id', 'otherKey' => 'channel_id'],
    ];
}
