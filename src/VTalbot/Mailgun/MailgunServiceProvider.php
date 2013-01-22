<?php

namespace VTalbot\Mailgun;

use Illuminate\Support\ServiceProvider;

class MailgunServiceProvider extends ServiceProvider {

  /**
   * Register the service provider
   *
   * @return void
   */
  public function register()
  {
    $this->app['config']->package('vtalbot/mailgun', 'vtalbot/mailgun', 'vtalbot/mailgun');

    $this->app['mailgun'] = $this->app->share(function($app)
    {
      $mailgun = new Mailgun;

      $mailgun->setContainer($app);

      return $mailgun;
    });
  }

}