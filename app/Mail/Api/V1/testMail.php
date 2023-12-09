<?php

namespace App\Mail\Api\V1;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class testMail extends Mailable
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
        return $this->markdown('Api.v1.mailauction')
            ->subject('¡Gracias por participar en nuestra subasta!.')
            ->from($mailFromEmail, $mailFromName);
    }
}
