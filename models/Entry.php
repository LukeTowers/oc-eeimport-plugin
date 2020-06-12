<?php namespace LukeTowers\EEImport\Models;

use LukeTowers\EEImport\Classes\BaseModel;

/**
 * Entry Model
 */
class Entry extends BaseModel
{
    use \October\Rain\Database\Traits\Purgeable;
    use \LukeTowers\EEImport\Traits\DecodesEEDates;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'channel_titles';

    /**
     * @var string The primary key column for the table
     */
    protected $primaryKey = 'entry_id';

    /**
     * @var array The relations to be eager loaded on every query
     */
    protected $with = ['data'];

    /**
     * @var array The attributes to be purged on save
     */
    protected $purgeable = [];

    /**
     * @var array The attributes to be hidden from the array version of the record
     */
    protected $hidden = ['data'];

    /**
     * @var array List of attribute names that are used by EE to store date information
     */
    protected $eeDates = ['edit_date', 'entry_date', 'expiration_date', 'comment_expiration_date', 'recent_comment_date'];

    /**
     * @var array Relations
     */
    public $hasOne = [
        'data' => [EntryData::class, 'key' => 'entry_id', 'otherKey' => 'entry_id'],
    ];
    public $hasMany = [
        'comments' => [Comment::class, 'key' => 'entry_id'],
    ];
    public $belongsTo = [
        'channel' => [Channel::class, 'key' => 'channel_id'],
        'member'  => [Member::class, 'key' => 'author_id'],
    ];
    public $belongsToMany = [
        'categories' => [Category::class, 'table' => 'category_posts', 'key' => 'entry_id', 'otherKey' => 'cat_id'],
    ];

    /**
     * Ensure that the channel field data is appended to the array form of this entry
     */
    public function afterFetch()
    {
        // Get the related data fields for this entry
        $channelFields = $this->channel->fields()->names();

        // Load all channel field data into the attributes array
        foreach ($channelFields as $field) {
            $this->attributes = array_merge($this->attributes, [$field => $this->getFieldValue($field)]);
        }

        // Ensure that the additional fields from $this->data are not considered part of the original table
        $this->addPurgeable($channelFields);
    }

    /**
     * Get the provided field's value from the related data object
     *
     * @param string $field The requested field
     * @return mixed $value
     */
    protected function getFieldValue($field)
    {
        $fieldObj = $this->channel->fields()->where('field_name', $field)->first();
        return $fieldObj->getValueFromEntry($this);
    }
}
