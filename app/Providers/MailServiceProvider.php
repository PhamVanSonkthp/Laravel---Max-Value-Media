<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //

        try {
            $mail = Setting::first();

            if (!empty($mail)) {
                Config::set('mail.mailers.smtp.host', $mail->mail_host);
                Config::set('mail.mailers.smtp.port', $mail->mail_port);
                Config::set('mail.mailers.smtp.encryption', $mail->mail_encryption);
                Config::set('mail.mailers.smtp.username', $mail->mail_username);
                Config::set('mail.mailers.smtp.password', $mail->mail_password);

                Config::set('mail.from.name', $mail->mail_from_name);
                Config::set('mail.from.address', $mail->mail_from_address);
            }
        } catch (\Exception $exception) {
        }
    }
}
