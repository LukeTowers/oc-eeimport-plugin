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
        $value = null;
        $fieldId = EntryField::getIdForName($field);
        if (!empty($fieldId)) {
            $key = 'field_id_' . $fieldId;
            $value = $this->data->{$key};
        }

        return $value;
    }
}
