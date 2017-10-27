<?php  namespace Ado\Formx\DataForm\Field;

use Collective\Html\FormFacade as Form;

class Checkboxgroup extends Field
{
    public $type = "checks";
    public $multiple = true;
    public $size = null;
    public $description = "";
    public $separator = "&nbsp;&nbsp;";
    public $format = "%s";
    public $css_class = "checkbox";
    public $checked_value = 1;
    public $unchecked_value = 0;
    public $clause = "wherein";

    public function separator($separator)
    {
        $this->separator = $separator;
    }

    public function getValue()
    {
        parent::getValue();

        if (is_array($this->value)) {
            $this->values = $this->value;
        }
        else {
            $this->values = explode($this->serialization_sep, $this->value);
        }

	if(is_array($this->options) && isset($this->options[0]) && count($this->options[0])>1){
            foreach ($this->options as $option) {
                $_options[$option['value']]=$option['title'];
                if ($this->value == $option['value']) {
                    $this->description = $option['title'];
                }
            }
            $this->options = $_options;
        }
	
        $description_arr = array();
        foreach ($this->options as $value => $description) {
            if (in_array($value, $this->values)) {
                $description_arr[] = $description;
            }
        }
        $this->description = implode($this->separator, $description_arr);
    }

    public function build()
    {
        $output = "";

        if (!isset($this->style)) {
            $this->style = "margin:0 2px 0 0; vertical-align: middle";
        }
        unset($this->attributes['id']);
        if (parent::build() === false) return;

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
                $this->format = '<label class="checkbox'.$inline.'">%s</label>';
                //dd($this->options, $this->values);
                foreach ($this->options as $val => $label) {

                    $this->checked = in_array($val, $this->values);

                    $output .= sprintf($this->format,Form::checkbox($this->name.'[]', $val, $this->checked) . $label) . $this->separator;
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
