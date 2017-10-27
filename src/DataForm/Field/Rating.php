<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/20
 * Time: 16:41
 */

namespace Ado\Formx\DataForm\Field;
use Collective\Html\FormFacade as Form;
use Ado\Formx\Formx;

class Rating extends Field
{
    public $type = "number";
    public $clause = "where";
    public $rule = ['Numeric'];

    public function build()
    {
        $output = "";

        if (parent::build() === false) {
            return;
        }

        switch ($this->status) {
            case "disabled":
            case "show":

                if ($this->type == 'hidden' || $this->value == "") {
                    $output = "";
                } elseif ((!isset($this->value))) {
                    $output = $this->layout['null_label'];
                } else {
                    $output = $this->value;
                }
                $output = "<div class='help-block'>" . $output . "&nbsp;</div>";
                break;

            case "create":
            case "modify":
         //   Formx::js('js/star-rating.min.js',true);
        //    Formx::css('css/star-rating.min.css',true);
                $output = Form::number($this->name, $this->value, $this->attributes);
                Formx::script("$('#".$this->name."').rating()");
                break;

            case "hidden":
                $output = Form::hidden($this->name, $this->value);
                break;

            default:
        }
        $this->output = "\n" . $output . "\n" . $this->extra_output . "\n";
    }

}