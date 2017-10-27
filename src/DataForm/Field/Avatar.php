<?php namespace Ado\Formx\DataForm\Field;

use Collective\Html\FormFacade as Form;
use Collective\Html\HtmlFacade as Html;
use Ado\Formx\Formx;

class Avatar extends Field
{

    public $type = "select";
    public $description = "";
    public $clause = "where";
	public $old_values = array();
    public $_webpath='';


    public function build()
    {
        $output = "";

        unset($this->attributes['type'], $this->attributes['size'],$this->attributes['class']);
        if (parent::build() === false)
            return;

        switch ($this->status) {
            case "disabled":
            case "show":
                if (!isset($this->value)) {
                    $output = $this->layout['null_label'];
                } else {
                    $output = $this->description;
                }
                $output = "<div class='help-block'>".$this->extra_output.$output."&nbsp;</div>";
                break;

            case "create":
            case "modify":
                $values = $this->getValues();
                $output = $this->extra_output.(Form::select($this->name, $this->options, $values, $this->attributes));
            Formx::script("$('#".$this->name."').change(function(){
               $('#avatar-".$this->name."').attr('src','".$this->_webpath."'+$(this).val());
            });");
                break;

            case "hidden":
                $output = Form::hidden($this->name, $this->value);
                break;

            default:
        }
        $this->output = $output;
    }

    public function setAvatar($path,$attributes){
        $this->getValue();
         $this->value = ($this->value)?:$this->old_value;
        if(empty($this->value)){
            $filename = $path.'200x200-o14.jpg';
        }else{
            $filename = $path.$this->value;
        }
        $attributes['id']='avatar-'.$this->name;
        $this->_webpath = $path;
        $this->extra_output= Html::image($filename, null, $attributes);
    }

    public function extra($extra)
    {
        $this->extra_output .= $extra;
        return $this;
    }


    public function getValues(){
        if(empty($this->old_values)){
            $this->old_values[] =$this->value;
        }
        return $this->old_values;
    }


}
