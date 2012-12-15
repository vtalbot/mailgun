<?php

namespace Ellicom\Mailgun;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ServiceProvider;

class MailgunServiceProvider extends ServiceProvider {

  /**
   * Register the service provider
   *
   * @return void
   */
  public function register()
  {
    $this->app['config']->package('ellicom/mailgun', 'ellicom/mailgun', 'ellicom/mailgun');

    $this->app['mailgun'] = $this->app->share(function($app)
    {
      $mailgun = new Mailgun($app['view']);

      $mailgun->setLogger($app['log']);

      $mailgun->setContainer($app);

      $from = $app['config']['ellicom/mailgun::from'];

      if (is_array($from) and isset($from['address']))
      {
        $mailgun->alwaysFrom($from['address'], $from['name']);
      }

      return $mailgun;
    });
  }

}