<?php namespace Ado\Formx\Demo;

/**
 * Category
 */
class Category extends \Eloquent
{

    protected $table = 'demo_categories';

    public function articles()
    {
        return $this->belongsToMany('Ado\Formx\Models\Article', 'demo_article_category', 'category_id','article_id');
    }

    public function parent()
    {
        return $this->belongsTo('Category', 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany('Category', 'parent_id');
    }
}
