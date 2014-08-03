<?php

namespace VTalbot\Mailgun\Facades;

use Illuminate\Support\Facades\Facade;

class Mailgun extends Facade
{
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'mailgun'; }
}
