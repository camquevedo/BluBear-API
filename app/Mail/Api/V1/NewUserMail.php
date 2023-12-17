<?php

namespace App\Mail\Api\V1;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $config;
    public $city;
    public $user;

    public function __construct($config, $city, $elements)
    {
        $this->config = $config;
        $this->city = $city;
        $this->user = $elements['user'];
    }

    public function build()
    {
        $mailFromName = $this->config['mailFromName'];
        $mailFromEmail = $this->config['mailFromEmail'];

        // return $this->markdown('Api.V1.mailnewuser')
        //     ->subject('Gracias por registrarte en digimon.dev-camquevedo.uk')
        //     ->from($mailFromEmail, $mailFromName);
        return $this->markdown('welcome')
            ->subject('Gracias por registrarte en digimon.dev-camquevedo.uk')
            ->from($mailFromEmail, $mailFromName);
    }
}
