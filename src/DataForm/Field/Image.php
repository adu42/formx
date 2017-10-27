<?php

namespace Ado\Formx\DataForm\Field;

use Collective\Html\FormFacade as Form;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as ImageManager;
use File as sfile;

class Image extends File
{
    public $type = "image";
    public $rule = ["mimes:jpeg,png"];
    public $css_class = "";
    protected $image;
    protected $image_callable;
    protected $resize = array();
    protected $fit = array();
    protected $preview = array(120, 80);

    public function __construct($name, $label, &$model = null, &$model_relations = null)
    {
        parent::__construct($name, $label, $model, $model_relations);

        \Event::listen('formx.uploaded.'.$this->name, function () {
            $this->imageProcess();
        });
    }

    /**
     * store a closure to make something with ImageManager post process
     * @param  callable $callable
     * @return $this
     */
    public function image(\Closure $callable)
    {
        $this->image_callable = $callable;

        return $this;
    }

    /**
     * shortcut to ImageManager resize
     * @param $width
     * @param $height
     * @param $filename
     * @return $this
     */
    public function resize($width, $height=0, $filename = null)
    {
        if(is_array($width)){
            $width['filename']=isset($width['filename'])?$width['filename']:null;
            $this->resize[] = $width;
        }else{
            $this->resize[] = array('width'=>$width, 'height'=>$height,  'filename'=>$filename);
        }
        $this->setWebPath($this->resize[0]);
        return $this;
    }

    /**
     * shortcut to ImageManager fit
     * @param $width
     * @param $height
     * @param $filename
     * @return $this
     */
    public function fit($width, $height=0, $filename = null)
    {
        if(is_array($width)){
            $width['filename']=isset($width['filename'])?$width['filename']:null;
            $this->fit[] = $width;
        }else {
            $this->fit[] = array('width' => $width, 'height' => $height, 'filename' => $filename);
        }
        $this->setWebPath($this->fit[0]);
        return $this;
    }

    /**
     * change the preview thumb size
     * @param $width
     * @param $height
     * @return $this
     */
    public function preview($width, $height=0)
    {
        if(is_array($width)){
            $width[0]=isset($width[0])? $width[0]:$width['width'];
            $width[1]=isset($width[1])? $width[1]:$width['height'];
            $this->preview = $width;
        }else {
            $this->preview = array($width, $height);
        }

        return $this;
    }

    /**
     * postprocess image if needed
     */
    protected function imageProcess()
    {
        if ($this->saved) {
            if (!$this->image)  $this->image = ImageManager::make($this->saved);

            if ($this->image_callable) {
                $callable = $this->image_callable;
                $callable($this->image);
            }

            if (count($this->resize)) {
                foreach ($this->resize as $resize) {
                    $path = $_path.'/'.$resize["width"].'x'.$resize["height"].'/';
                    if(!$resize["filename"] && $_path)$resize["filename"]=$path.$name;
                    if(!sfile::isDirectory($path)){
                      sfile::makeDirectory($path,  $mode = 0744,true,true);
                    }
                    $this->image->resize($resize["width"], $resize["height"]);
                    $this->image->save($this->parseString($resize["filename"]));
                }
            }

           if (count($this->fit)) {
                foreach ($this->fit as $fit) {
                    $path = $_path.'/'.$fit["width"].'x'.$fit["height"].'/';
                    if(!$fit["filename"] && $_path)$fit["filename"]=$path.$name;
                    if(!sfile::isDirectory($path)){
                        sfile::makeDirectory($path,  $mode = 0744,true,true);
                    }
                    $this->image->fit($fit["width"], $fit["height"],function ($constraint) {
                        $constraint->upsize();
                    },'top');
                    $this->image->save($fit["filename"]);
                }
            }
            
	    
	     if($path)$this->path = $path;

        }
    }

    public function getWebPath(){
        if(empty($this->web_path)){
            $this->web_path =  str_replace(public_path(),'',$this->path);
        }
         return $this->web_path;
    }
    
    public function thumb()
    {
        if (!\File::exists(public_path().$this->old_value)) return '';
        return '<img src="'.ImageManager::make(public_path().$this->old_value)->fit($this->preview[0], $this->preview[1])->encode('data-url').'" class="pull-left" style="margin:0 10px 10px 0">';
    }

    public function build()
    {
        $output = "";
        if (parent::build() === false)
            return;

        switch ($this->status) {
            case "disabled":
            case "show":

                if ($this->type == 'hidden' || $this->value == "") {
                    $output = "";
                } elseif ((!isset($this->value))) {
                    $output = $this->layout['null_label'];
                } else {
                    $output =  $this->thumb();
                }
                $output = "<div class='help-block'>" . $output . "&nbsp;</div>";
                break;

            case "create":
            case "modify":
                if ($this->old_value != "") {
                    $output .= '<div class="clearfix">';
                    $output .= $this->thumb()." &nbsp;".link_to($this->value, $this->value, array('target'=>'_blank'))."<br />\n";
                    $output .= Form::checkbox($this->name.'_remove', 1, (bool) Input::get($this->name.'_remove'))." ".trans('formx::formx.delete')." <br/>\n";
                    $output .= '</div>';
                }
                $output .= Form::file($this->name, $this->attributes);
                break;

            case "hidden":
                $output = Form::hidden($this->name, $this->value);
                break;

            default:;
        }
        $this->output = "\n" . $output . "\n" . $this->extra_output . "\n";
    }

}
