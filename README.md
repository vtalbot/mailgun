# Mailgun  for Laravel 4 (Illuminate)

[![Build Status](https://travis-ci.org/Ellicom/mailgun.png)](https://travis-ci.org/Ellicom/mailgun)

### Installation

Run `php artisan config:publish ellicom/mailgun`

Add `'Ellicom\Mailgun\MailgunServiceProvider',` to `providers` in `app/config/app.php`
and `'Mailgun' => 'Ellicom\Mailgun\Facades\Mailgun',` to `aliases` in `app/config/app.php`

### Todo

Add tests.