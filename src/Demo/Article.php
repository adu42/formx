<?php namespace Ado\Formx\Demo;

/**
 * Article
 */
class Article extends \Eloquent
{
    protected $table = 'demo_articles';

    public function author()
    {
        return $this->belongsTo('Ado\Formx\Demo\Author', 'author_id');
    }

    public function comments()
    {
        return $this->hasMany('Ado\Formx\Demo\Comment', 'article_id');
    }

    public function categories()
    {
        return $this->belongsToMany('Ado\Formx\Demo\Category', 'demo_article_category', 'article_id','category_id');
    }

    public function detail()
    {
        return $this->hasOne('Ado\Formx\Demo\ArticleDetail', 'article_id');
    }

    public function scopeFreesearch($query, $value)
    {
        return $query->where('title','like','%'.$value.'%')
            ->orWhere('body','like','%'.$value.'%')
            ->orWhereHas('author', function ($q) use ($value) {
                $q->whereRaw(" CONCAT(firstname, ' ', lastname) like ?", array("%".$value."%"));
            })->orWhereHas('categories', function ($q) use ($value) {
                $q->where('name','like','%'.$value.'%');
            });

    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($article) {
            $article->detail()->delete();
            if ($article->photo)  @unlink(public_path().'/uploads/demo/'.$article->photo);
        });
    }
}
