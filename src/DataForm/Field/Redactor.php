<?php namespace Ado\Formx\DataForm\Field;

use Collective\Html\FormFacade as Form;
use Ado\Formx\Formx;
class Redactor extends Field
{
  public $type = "text";
  protected $plugins = [];
  protected $params = [];
  protected $exsit_plugins = ['fontfamily','fontcolor','fontsize','textdirection','textexpander','imagemanager', 'video','table','definedlinks','counter','limiter','clips','fullscreen'];
  protected $use_textarea = false;
  protected $imageSize = '';
  protected $editor = 'redactor';

  public function build()
  {
    $output = "";
    if (parent::build() === false) return;

    switch ($this->status) {
      case "disabled":
      case "show":

        if ($this->type =='hidden' || $this->value == "") {
          $output = "";
        } elseif ( (!isset($this->value)) ) {
          $output = $this->layout['null_label'];
        } else {
          $output = nl2br(htmlspecialchars($this->value));
        }
        $output = "<div class='help-block'>".$output."&nbsp;</div>";
        break;

      case "create":
      case "modify":
        $output  = Form::textarea($this->name, $this->value, $this->attributes);
	
	if($this->isTinymce()){
	Formx::js('tinymce/tinymce.min.js');
        Formx::js('tinymce/tinymce_editor.js');
	Formx::script("function elFinderBrowser (field_name, url, type, win) {" .
		      "tinymce.activeEditor.windowManager.open({" .
		      "file: '" . route('elfinder.tinymce4') . "'," .
		      "title: 'elFinder 2.0'," .
		      "width: 900," .
		      "height: 450," .
		      "resizable: 'yes'" .
		      "}, {" .
		      "setUrl: function (url) {" .
		      "win.document.getElementById(field_name).value = url;" .
		      "}" .
		      "});" .
		      "return false;" .
		      "}");
      Formx::script("tinymce.init({selector: '#".$this->name."', file_browser_callback : elFinderBrowser, plugins: 'image, link', convert_urls: false});");
	}else{
        if(!$this->use_textarea){
         Formx::js('js/redactor.js',true);
         $plugins = $this->getPlugins();
         $plugins_str="";
       if(!empty($plugins)){
         //  foreach($plugins as $plugin){
         //      Formx::js("js/redactor/plugins/${plugin}/${plugin}.js",true);
         //  }
           $plugins_str=",plugins:['".implode("','",$plugins)."']";
       }
       if(!empty($this->params)){
           foreach($this->params as $name=>$val){
               if(is_array($val)){
                   $_val="['".implode("','",$val)."']";
               }elseif(is_bool($val)){
                   $_val=$val?'true':'false';
               }else{
                   $_val="'$val'";
               }
               $plugins_str.=",$name:$_val";
           }
       }



        Formx::css('css/redactor.css',true);

        $sizeParam = !empty($this->imageSize)?'&size='.$this->imageSize:'';

        Formx::script("$('#".$this->name."').redactor({
          focus: false,
          imageUpload: '/upload?_token=".csrf_token().$sizeParam."',
          fileUpload: '/upload?_token=".csrf_token()."'". $plugins_str." });");
        }
}
        break;

      case "hidden":
        $output = Form::hidden($this->name, $this->value);
        break;

      default:;
    }
    $this->output = "\n".$output."\n". $this->extra_output."\n";
  }

  public function getPlugins(){
      foreach($this->plugins as $k=> $plugin){
          if(!in_array($plugin,$this->exsit_plugins)){
              unset($this->plugins[$k]);
          }
      }
      return array_unique($this->plugins);
  }

  public function addPlugins($plugins){
      $this->plugins[]=$plugins;
      return $this;
  }

  public function fullmode(){
      foreach($this->exsit_plugins as $plugin){
          $this->addPlugins($plugin);
      }
      return $this;
  }

    public function setParam($name,$value=true){
        $this->params[$name]=$value;
        return $this;
    }

    public function enableDiv(){
        $this->params['replaceDivs']=false;
        return $this;
    }

    public function enableScript(){
        $this->setParam('deniedTags',['style']);
        return $this;
    }

    public function setImageSize($size='x360240'){
        $this->imageSize = $size;
    }
    
    public function setTinymce(){
        $this->editor='tinymce';
        return $this;
    }
    
    public function isTinymce(){
	return  $this->editor=='tinymce';
    }
    
}
