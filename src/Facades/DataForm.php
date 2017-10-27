<?php namespace Ado\Formx\Facades;

use Illuminate\Support\Facades\Facade;

class DataForm extends Facade
{
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'Ado\Formx\DataForm\DataForm'; }

}
