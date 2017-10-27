<?php namespace Ado\Formx\Demo;

/**
 * Author
 */
class Author extends \Eloquent
{

    protected $table = 'demo_users';

    protected $appends = array('fullname');

    public function articles()
    {
        return $this->hasMany('Ado\Formx\Models\Article');
    }

    public function comments()
    {
        return $this->hasMany('Ado\Formx\Models\Comment');
    }

    public function getFullnameAttribute($value)
    {
        return $this->firstname ." ". $this->lastname;
    }

}
