<?php namespace LukeTowers\EEImport\Models;

use LukeTowers\EEImport\Classes\BaseModel;

/**
 * Comment Model
 */
class Comment extends BaseModel
{
    use \LukeTowers\EEImport\Traits\DecodesEEDates;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'comments';

    /**
     * @var string The primary key column for the table
     */
    protected $primaryKey = 'comment_id';

    /**
     * @var array List of attribute names that are used by EE to store date information
     */
    protected $eeDates = ['comment_date', 'edit_date'];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'channel' => [Channel::class, 'key' => 'channel_id'],
        'entry'   => [Entry::class, 'key' => 'entry_id'],
        'member'  => [Member::class, 'key' => 'member_id'],
    ];
}
