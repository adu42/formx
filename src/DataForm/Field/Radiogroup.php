<?php  namespace Ado\Formx\DataForm\Field;

use Collective\Html\FormFacade as Form;

class Radiogroup extends Field
{

    public $type = "radio";
    public $size = null;
    public $description = "";
    public $separator = "&nbsp;&nbsp;";
    public $clause = "where";

    public function separator($separator)
    {
        $this->separator = $separator;
    }

    public function getValue()
    {
        parent::getValue();
        foreach ($this->options as $value => $description) {
            if ($this->value == $value) {
                $this->description = $description;
            }
        }
    }

    public function build()
    {
        $output = "";
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
                $output = "<div class='help-block'>".$output."&nbsp;</div>";
                break;

            case "create":
            case "modify":
                $inline =  ($this->orientation == 'inline')?'-inline':'';
                foreach ($this->options as $val => $label) {
                    $this->checked = (!is_null($this->value) and ($this->value == $val));
                    $output .='<div class="radio'.$inline.'"><label for="'.$this->name.$val.'">' .Form::radio($this->name, $val, $this->checked,['id'=>$this->name.$val]).' '. $label.'</label></div>'. $this->separator;
                }
                $output .= $this->extra_output;
                break;

            case "hidden":
                $output = Form::hidden($this->name, $this->value);
                break;

            default:
        }
        $this->output = $output;
    }

}
