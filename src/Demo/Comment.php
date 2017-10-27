<?php namespace Ado\Formx\Demo;

/**
 * Comment
 */
class Comment extends \Eloquent
{

    protected $table = 'demo_comments';

    public function article()
    {
        return $this->belongsTo('Ado\Formx\Models\Article', 'article_id');
    }

    public function author()
    {
        return $this->belongsTo('Ado\Formx\Models\Author', 'author_id');
    }
}
