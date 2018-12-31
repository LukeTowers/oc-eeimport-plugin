<?php namespace LukeTowers\EEImport\Models;

use LukeTowers\EEImport\Classes\BaseModel;

/**
 * MemberData Model
 */
class MemberData extends BaseModel
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'member_data';

    /**
     * @var string The primary key column for the table
     */
    protected $primaryKey = 'member_id';

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'member' => [Member::class, 'key' => 'member_id'],
    ];
}
