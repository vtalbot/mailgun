# Mailgun  for Laravel 4 (Illuminate)

[![Build Status](https://travis-ci.org/Ellicom/mailgun.png)](https://travis-ci.org/Ellicom/mailgun)

### Installation

Run `php artisan config:publish ellicom/mailgun`

Then edit `config.php` in `app/packages/ellicom/mailgun` to your needs.

Add `'Ellicom\Mailgun\MailgunServiceProvider',` to `providers` in `app/config/app.php`
and `'Mailgun' => 'Ellicom\Mailgun\Facades\Mailgun',` to `aliases` in `app/config/app.php`

### Usage

    $app['mailgun']->message(function($mail)
    {
        $mail->from = 'email@email.com';
        $mail->to = 'email@email.com';
        $mail->subject = 'test';
        $mail->text = 'content';
    })->deliver();

Simple.

#### Available methods for `$app['mailgun']`:

* **message**: [Send messages](http://documentation.mailgun.net/api-sending.html) (post)
* **unsubscribe**: [Unsubscribe an address](http://documentation.mailgun.net/api-unsubscribes.html) (post)
* **unsubscribes**: [Get unsubscribes list](http://documentation.mailgun.net/api-unsubscribes.html) (get)
* **complaint**: [Add add address to spam complaints](http://documentation.mailgun.net/api-complaints.html) (post)
* **complaints**: [Get spam complaints list](http://documentation.mailgun.net/api-complaints.html) (get)
* **bounce**: [Add a bounce](http://documentation.mailgun.net/api-bounces.html) (post)
* **bounces**: [Get bounces list](http://documentation.mailgun.net/api-bounces.html) (get)
* **stats**: [Get stats](http://documentation.mailgun.net/api-stats.html) (get)
* **log**: [Get logs](http://documentation.mailgun.net/api-logs.html) (get)
* **route**: [Add route](http://documentation.mailgun.net/api-routes.html) (post)
* **routes**: [Get routes list](http://documentation.mailgun.net/api-routes.html) (get)
* **mailbox**: [Add mailbox](http://documentation.mailgun.net/api-mailboxes.html) (post)
* **mailboxes**: [Get mailboxes](http://documentation.mailgun.net/api-mailboxes.html) (get)
* **campaign**: [Add campaign](http://documentation.mailgun.net/api-campaigns.html) (post)
* **campaigns**: [Get campaigns lists](http://documentation.mailgun.net/api-campaigns.html) (get)
* **list**: [Add mailing list](http://documentation.mailgun.net/api-mailinglists.html) (post)
* **lists**: [Get mailing lists](http://documentation.mailgun.net/api-mailinglists.html) (get)

**You can change function behavior**

    $mail->delete(); // Call DELETE
    $mail->put(); // Call PUT
    $mail->post(); // Call POST
    $mail->get(); // Call GET

And set parameters by using the parameter name in the documentation on each methods.

**Use `$mail->param('o:dkim', 'value')` when the parameter has special caracters.**

    $mail->attachment = 'image'; // create an attachment key in parameters
    $mail->attachment = 'image2'; // transform attachment parameters in array and add image2

    $mail->path('more'); // Will add 'more' after the url (eg. https://api.mailgun.net/v2/domain.com/complaints/more)

### Todo

Add tests.