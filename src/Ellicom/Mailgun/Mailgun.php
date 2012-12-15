<?php

namespace Ellicom\Mailgun;

use Closure;
use Illuminate\Container;
use Illuminate\Log\Writer;
use Illuminate\View\Environment;

class Mailgun {

  /**
   * The view environment instance.
   *
   * @var Illuminate\View\Environment
   */
  protected $views;

  /**
   * The global from address and name
   *
   * @var array
   */
  protected $from;

  /**
   * The log writer instance.
   *
   * @var Illuminate\Log\Writer
   */
  protected $logger;

  /**
   * The IoC container instance.
   *
   * @var Illuminate\Container
   */
  protected $container;

  /**
   * Create a new Mailgun instance.
   *
   * @param  Illuminate\View\Environment  $views
   * @return void
   */
  public function __construct(Environment $views)
  {
    $this->views = $views;
  }

  /**
   * Set the global from address and name.
   *
   * @param  string  $address
   * @param  string  $name
   * @return void
   */
  public function alwaysFrom($address, $name = null)
  {
    $this->from = compact('address', 'name');
  }

}