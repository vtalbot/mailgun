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
   * The IoC container instance.
   *
   * @var Illuminate\Container
   */
  protected $container;

  public function message(Closure $setter = null)
  {
    $mail = new Mailgunner('messages', 'POST', array(), $setter);

    $mail->setContainer($this->container);

    return $mail;
  }

  public function unsubscribe(Closure $setter = null)
  {
    $mail = new Mailgunner('unsubscribes', 'POST', array(), $setter);

    $mail->setContainer($this->container);

    return $mail;
  }

  public function unsubscribes(Closure $setter = null)
  {
    $mail = new Mailgunner('unsubscribes', 'GET', array(), $setter);

    $mail->setContainer($this->container);

    return $mail;
  }

  public function complaint(Closure $setter = null)
  {
    $mail = new Mailgunner('complaints', 'POST', array(), $setter);

    $mail->setContainer($this->container);

    return $mail;
  }

  public function complaints(Closure $setter = null)
  {
    $mail = new Mailgunner('complaints', 'GET', array('limit' => 100, 'skip' => 0), $setter);

    $mail->setContainer($this->container);

    return $mail;
  }

  public function bounce(Closure $setter = null)
  {
    $mail = new Mailgunner('bounces', 'POST', array(), $setter);

    $mail->setContainer($this->container);

    return $mail;
  }

  public function bounces(Closure $setter = null)
  {
    $mail = new Mailgunner('bounces', 'GET', array('limit' => 100, 'skip' => 0), $setter);

    $mail->setContainer($this->container);

    return $mail;
  }

  public function stats(Closure $setter = null)
  {
    $mail = new Mailgunner('stats', 'GET', array('limit' => 100, 'skip' => 0), $setter);

    $mail->setContainer($this->container);

    return $mail;
  }

  public function log(Closure $setter = null)
  {
    $mail = new Mailgunner('log', 'GET', array('limit' => 100, 'skip' => 0), $setter);

    $mail->setContainer($this->container);

    return $mail;
  }

  public function route(Closure $setter = null)
  {
    $mail = new Mailgunner('routes', 'POST', array(), $setter);

    $mail->setContainer($this->container);

    return $mail;
  }

  public function routes(Closure $setter = null)
  {
    $mail = new Mailgunner('routes', 'GET', array('limit' => 100, 'skip' => 0), $setter);

    $mail->setContainer($this->container);

    return $mail;
  }

  public function mailbox(Closure $setter = null)
  {
    $mail = new Mailgunner('mailboxes', 'POST', array(), $setter);

    $mail->setContainer($this->container);

    return $mail;
  }

  public function mailboxes(Closure $setter = null)
  {
    $mail = new Mailgunner('mailboxes', 'GE', array('limit' => 100, 'skip' => 0), $setter);

    $mail->setContainer($this->container);

    return $mail;
  }

  public function campaign(Closure $setter = null)
  {
    $mail = new Mailgunner('campaigns', 'POST', array(), $setter);

    $mail->setContainer($this->container);

    return $mail;
  }

  public function campaigns(Closure $setter = null)
  {
    $mail = new Mailgunner('campaigns', 'GET', array('limit' => 100, 'skip' => 0), $setter);

    $mail->setContainer($this->container);

    return $mail;
  }

  public function __call($request, $arguments)
  {
    $method = 'GET';

    if (count($arguments) > 1)
    {
      $method = array_shift($arguments);
    }

    $setter = array_shift($arguments);

    $mail = new Mailgunner($request, $method, array(), $setter);

    $mail->setContainer($this->container);

    return $mail;
  }

  public function setContainer(Container $container)
  {
    $this->container = $container;
  }

}