<?php namespace Ado\Formx\DataForm\Field;

use Collective\Html\FormFacade as Form;

class Select extends Field
{

    public $type = "select";
    public $description = "";
    public $clause = "where";
	public $old_values = array();

    public function getValue()
    {
        parent::getValue();
        $_options = array();
		
		if(is_array($this->options) && isset($this->options[0]) && count($this->options[0])>1){
            foreach ($this->options as $option) {
                $_options[$option['value']]=$option['title'];
                if ($this->value == $option['value']) {
                    $this->description = $option['title'];
                }
            }
            $this->options = $_options;
        }else{
        foreach ($this->options as $value => $description) {
            if ($this->value == $value) {
                $this->description = $description;
                }
            }
        }
    }

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
                $output = "<div class='help-block'>".$output."&nbsp;</div>";
                break;

            case "create":
            case "modify":
				$values = $this->getValues();
                $output = Form::select($this->name, $this->options, $values, $this->attributes) . $this->extra_output;
                break;

            case "hidden":
                $output = Form::hidden($this->name, $this->value);
                break;

            default:
        }
        $this->output = $output;
    }

	public function setValues($model,$selfKey,$dstKey){
		if(empty($this->old_values)){
			if (is_object($model) && is_a($model, "\Illuminate\Database\Eloquent\Model") && $selfKey && $dstKey) {
				 $items = $model->where($selfKey,$this->model->getKey())->get();
				 foreach($items as $item){
					$this->old_values[]=$item->$dstKey;
				 }

			}
		}
		$this->old_values = array_unique($this->old_values);
		return $this;
	}

	public function getValues(){
		if(empty($this->old_values)){
			$this->old_values[] =$this->value;
		}
		return $this->old_values;
	}
}
