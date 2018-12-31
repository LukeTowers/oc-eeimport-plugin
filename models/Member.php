<?php namespace LukeTowers\EEImport\Models;

use LukeTowers\EEImport\Classes\BaseModel;

/**
 * Member Model
 */
class Member extends BaseModel
{
    use \October\Rain\Database\Traits\Purgeable;
    use \LukeTowers\EEImport\Traits\DecodesEEDates;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'members';

    /**
     * @var string The primary key column for the table
     */
    protected $primaryKey = 'member_id';

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
    protected $eeDates = ['join_date', 'last_visit', 'last_activity', 'last_entry_date', 'last_comment_date'];

    /**
     * @var array Relations
     */
    public $hasOne = [
        'data' => [MemberData::class, 'key' => 'member_id', 'otherKey' => 'member_id'],
    ];
    public $hasMany = [
        'comments' => [Comment::class, 'key' => 'author_id'],
        'entries'  => [Entry::class, 'key' => 'author_id'],
    ];
    public $belongsTo = [
        'group' => [MemberGroup::class, 'key' => 'group_id'],
    ];

    /**
     * Ensure that the channel field data is appended to the array form of this entry
     */
    public function afterFetch()
    {
        // Get the related data fields for this member
        $fields = MemberField::getFieldNames();

        // Load all field data into the attributes array
        foreach ($fields as $field) {
            $this->attributes = array_merge($this->attributes, [$field => $this->getFieldValue($field)]);
        }

        // Ensure that the additional fields from $this->data are not considered part of the original table
        $this->addPurgeable($fields);
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
        $fieldId = MemberField::getIdForName($field);
        if (!empty($fieldId)) {
            $key = 'm_field_id_' . $fieldId;
            $value = $this->data->{$key};
        }

        return $value;
    }
}
