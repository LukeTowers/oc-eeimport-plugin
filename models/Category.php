<?php namespace LukeTowers\EEImport\Models;

use LukeTowers\EEImport\Classes\BaseModel;

/**
 * Category Model
 */
class Category extends BaseModel
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'categories';

    /**
     * @var string The primary key column for the table
     */
    protected $primaryKey = 'cat_id';

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'group' => [CategoryGroup::class, 'key' => 'group_id'],
    ];

    public function scopeGroup($query, $group)
    {
        return $query->whereHas('group', function ($q) use ($group) {
            return $q->where('group_name', $group);
        });
    }
}
