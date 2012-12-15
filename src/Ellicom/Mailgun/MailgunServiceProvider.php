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
      $mailgun = new Mailgun;

      $mailgun->setContainer($app);

      return $mailgun;
    });
  }

}