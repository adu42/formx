<?php

namespace Ado\Formx\DataForm\Field;

use Collective\Html\FormFacade as Form;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File as sfile;

class File extends Field
{

    public $type = "file";
    protected $file = null;
    protected $file_callable;
    protected $path = 'uploads/';
    protected $web_path = '';
    protected $filename = '';
    protected $saved = '';
    protected $unlink_file = true;
    protected $upload_deferred = false;
    protected $recursion = false;

    public function __construct($name, $label, &$model = null, &$model_relations = null)
    {
        parent::__construct($name, $label, $model, $model_relations);

        \Event::listen('formx.uploaded.'.$this->name, function () {
            $this->fileProcess();
        });
    }

    /**
     * postprocess file if needed
     */
    protected function fileProcess()
    {
        if ($this->saved) {
//            if (!$this->file)  $this->file = Input::file($this->name);
            if ($this->file_callable) {
                $callable = $this->file_callable;
                $callable($this);
            }
        }
    }
    
    
    public function rule($rule)
    {
        //we should consider rules only on upload
        if (Input::hasFile($this->name)) {
            parent::rule($rule);
        }

        return $this;
    }

    /**
     * store a closure to make something with file post process
     * @param  callable $callable
     * @return $this
     */
    public function file(\Closure $callable)
    {
        $this->file_callable = $callable;

        return $this;
    }
    
    public function autoUpdate($save = false)
    {

        $this->getValue();

        if ((($this->action == "update") || ($this->action == "insert"))) {

            if (Input::hasFile($this->name)) {
                $this->path = $this->parseString($this->path);

		// unlink old file if remove checkbox is checked
                if (Input::get($this->name . "_remove")) {
                    if ($this->unlink_file) {
                        @unlink(public_path() . '/' . $this->path . $this->old_value);
                    }
		}
                $this->file = Input::file($this->name);

                $filename = ($this->filename!='') ?  $this->filename : $this->file->getClientOriginalName();

                $this->path =  $this->parseString($this->path);
                $filename = $this->parseString($filename);
                $filename = $this->sanitizeFilename($filename);
                $this->new_value = $_value = $this->getWebPath().$filename;

                //deferred upload
                if ($this->upload_deferred) {
                    if (isset($this->model) and isset($this->db_name)) {
                        $this->model->saved(function () use ($filename,$_value) {
                            if ($this->recursion) return;
                            $this->recursion = true;

                          //  $this->path =  $this->parseString($this->path);
                         //   $filename = $this->parseString($filename);
                         //   $filename = $this->sanitizeFilename($filename);
                         //   $this->new_value = $filename;
                            if ($this->uploadFile($filename)) {
                                if (is_a($this->relation, 'Illuminate\Database\Eloquent\Relations\Relation'))
                                    $this->updateRelations();
                                else
                                    $this->updateName(true);
                            }

                        });
                        $this->model->save();
                    }

                //direct upload
                } else {

                    if ($this->uploadFile($filename)) {
                        if (is_object($this->model) and isset($this->db_name)) {
                            if (is_a($this->relation, 'Illuminate\Database\Eloquent\Relations\Relation')) {
                                $this->model->saved(function () {
                                        $this->updateRelations();
                                });
                            } else {
                                $this->updateName($save);
                            }
                        }
                    }
                }

            } else {

                //unlink
                if (Input::get($this->name . "_remove")) {
                    $this->path =  $this->parseString($this->path);
                    if ($this->unlink_file) {
                        @unlink(public_path().'/'.$this->path.$this->old_value);
                    }
                    if (is_a($this->relation, 'Illuminate\Database\Eloquent\Relations\Relation')) {
                        $this->new_value = null;
                        $this->value = null;
                        $this->updateRelations();

                    }
                    if (isset($this->model) && $this->model->offsetExists($this->db_name)) {
                        $this->model->setAttribute($this->db_name, null);
                    }

                    if ($save) {
                        return $this->model->save();
                    }
                }

            }
        }

        return true;
    }

    protected function sanitizeFilename($filename)
    {
        $filename = preg_replace('/\s+/', '_', $filename);
        $filename = preg_replace('/[^a-zA-Z0-9\._-]/', '', $filename);
        $filename = $this->preventOverwrite($filename);

        return $filename;
    }

    protected function preventOverwrite($filename)
    {
        $ext = strtolower(substr(strrchr($filename, '.'), 1));
        $name = substr($filename,0,strlen($filename)-strlen(strrchr($filename, '.')));
        $i = 0;
        $finalname = $name;
        while (file_exists(public_path().'/'.$this->path . $finalname. '.'.$ext)) {
            $i++;
            $finalname = $name . (string) $i;
        }

        return $finalname. '.'.$ext;
    }

    /**
     * move uploaded file to the destination path, optionally raname it
     * name param can be passed also as blade syntax
     * unlinkable  is a bool, tell to the field to unlink or not if "remove" is checked
     * @param $path
     * @param  string $name
     * @param  bool   $unlinkable
     * @return $this
     */
    public function move($path, $name = '', $unlinkable = true, $deferred = false)
    {
        $this->path = rtrim($path,"/")."/";
        $this->filename = $name;
        $this->unlink_file = $unlinkable;
        $this->upload_deferred = $deferred;
        if (!$this->web_path) $this->web_path = $this->path;
        return $this;
    }

    /**
     * as move but deferred after model->save()
     * this way you can use ->move('upload/folder/{{ $id }}/'); using blade and pk reference
     *
     * @param $path
     * @param  string $name
     * @param  bool   $unlinkable
     * @return $this
     */
    public function moveDeferred($path, $name = '', $unlinkable = true)
    {
        return $this->move($path, $name, $unlinkable, true);
    }

    public function getWebPath(){
        return $this->web_path =  str_replace(public_path(),'', $this->web_path);
    }
    public function webPath($path)
    {
        $this->web_path = rtrim($path,"/")."/";

        $this->web_path =  str_replace(public_path(),'', $this->web_path);
        return $this;
    }

    /**
     * @return update field name
     */
    protected function uploadFile($filename, $safe = false)
    {
        if(!sfile::isDirectory($this->path)){
            sfile::makeDirectory($this->path,0744,true,true);
        }
        if ($safe) {
            try {
                $this->file->move($this->path, $filename);
                $this->saved = $this->path. $filename;
            } catch (Exception $e) {
            }
        } else {
            $this->file->move($this->path, $filename);
            $this->saved = $this->path. $filename;
        }
        \Event::fire('formx.uploaded.'.$this->name);

        return true;
    }

    /**
     * @return update field name
     */
    protected function updateName($save)
    {
        if (!(\Schema::connection($this->model->getConnectionName())->hasColumn($this->model->getTable(), $this->db_name)
            || $this->model->hasSetMutator($this->db_name)))
        {
            return true;
        }
        if (isset($this->new_value)) {
            $this->model->setAttribute($this->db_name, $this->new_value);
        } else {
            $this->model->setAttribute($this->db_name, $this->value);
        }

        if ($save) {
            return $this->model->save();
        }
    }

    public function build()
    {
        $this->path =  $this->parseString($this->path);
        $web_path = $this->getWebPath();
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
                    $output = nl2br(htmlspecialchars($this->value));
                }
                $output = "<div class='help-block'>" . $output . "&nbsp;</div>";
                break;

            case "create":
            case "modify":

                if ($this->old_value) {
                    $output .= '<div class="clearfix">';
                    $output .= link_to($this->web_path.$this->value, $this->value). "&nbsp;";
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
