<?php namespace Ado\Formx;


/**
 * Class DataEmbed
 * @package Ado\Formx
 */
class DataEmbed
{
    public $output = "";
    public $url;
    public $id;
    
    public static function source($url, $id)
    {
        $ins = new static();
        $ins->url = $url;
        $ins->id = $id;
        return $ins;
    }

    public function build($view = 'formx::dataembed')
    {
        $url = $this->url;
        $id  = $this->id;
        \Formx::tag('tags/dataembed.html');
        $this->output = view($view, compact('url','id'))->render();
        
        return $this->output;
    }
    
    public function __toString()
    {
        if ($this->output == "") {
            $this->build();
        }

        return $this->output;
    }
}
