<?php

namespace Ado\Formx\DataForm\Field;

use Collective\Html\FormFacade as Form;
use Ado\Formx\Formx;

class Colorpicker extends Field
{
    public $type = "colorpicker";
    public $rule = ['regex:/^#[A-Fa-f0-9]{6}$/'];

    public function build()
    {
        $output = "";

        if (parent::build() === false) return;

        switch ($this->status) {

            case "show":
                $output = $this->value;
                $output = "<div class='help-block' style='background-color:".$output."'>&nbsp;</div>";
                break;

            case "create":
            case "modify":
                Formx::css('colorpicker/css/bootstrap-colorpicker.min.css');
                Formx::js('colorpicker/js/bootstrap-colorpicker.min.js');
                $output  = Form::text($this->name, $this->value,  $this->attributes);
                $output .= Formx::script("
                        $('#".$this->name."').colorpicker({
                            format: 'hex'
                        });");

                break;
            case "hidden":
                $output = Form::hidden($this->name, $this->value);
                break;
            default:;
        }
        $this->output = $output;
    }

}
