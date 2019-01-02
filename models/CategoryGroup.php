<?php namespace LukeTowers\EEImport\Models;

use LukeTowers\EEImport\Classes\BaseModel;

/**
 * CategoryGroup Model
 */
class CategoryGroup extends BaseModel
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'category_groups';

    /**
     * @var string The primary key column for the table
     */
    protected $primaryKey = 'group_id';

    /**
     * @var array Relations
     */
    public $hasMany = [
        'categories' => [Category::class, 'key' => 'group_id'],
    ];

    /**
     * Filter the query by the provided name
     *
     * @param QueryBuilder $query
     * @param string $name
     * @return QueryBuilder
     */
    public function scopeName($query, $name)
    {
        return $query->where('group_name', $name);
    }
}
