<?php namespace LukeTowers\EEImport\Models;

use LukeTowers\EEImport\Classes\BaseModel;

/**
 * Channel Model
 */
class Channel extends BaseModel
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'channels';

    /**
     * @var string The primary key column for the table
     */
    protected $primaryKey = 'channel_id';

    /**
     * @var array Relations
     */
    public $hasMany = [
        'entries'  => [Entry::class, 'key' => 'channel_id'],
        'comments' => [Comment::class, 'key' => 'channel_id'],
    ];
    public $belongsToMany = [
        'member_groups' => [MemberGroup::class, 'table' => 'channel_member_groups', 'key' => 'channel_id', 'otherKey' => 'group_id'],
        'field_groups' => [FieldGroup::class, 'table' => 'channels_channel_field_groups', 'key' => 'channel_id', 'otherKey' => 'group_id'],
    ];

    /**
     * Get the channel's fields
     *
     * @return QueryBuilder
     */
    public function fields()
    {
        $fieldIds = [];
        foreach ($this->field_groups as $group) {
            $fieldIds = array_merge($fieldIds, $group->fields->pluck('field_id')->all());
        }
        return EntryField::whereIn('field_id', $fieldIds);
    }

    /**
     * Get the channel with the provided name
     *
     * @param string $name
     * @return Channel
     */
    public static function fromName($name)
    {
        return static::name($name)->first();
    }

    /**
     * Filter the query by the provided name
     *
     * @param QueryBuilder $query
     * @param string $name
     * @return QueryBuilder
     */
    public function scopeName($query, $name)
    {
        return $query->where('channel_name', $name);
    }

    /**
     * Filter the query by the provided names
     *
     * @param QueryBuilder $query
     * @param array $names
     * @return QueryBuilder
     */
    public function scopeNames($query, $names)
    {
        return $query->whereIn('channel_name', $names);
    }
}
