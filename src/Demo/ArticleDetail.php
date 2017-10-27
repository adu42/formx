<?php namespace Ado\Formx\Demo;

/**
 * ArticleDetail
 */
class ArticleDetail extends \Eloquent
{

    protected $table = 'demo_article_detail';
    public $timestamps = false;

    public function article()
    {
        return $this->belongsTo('Ado\Formx\Models\Article', 'article_id');
    }

}
