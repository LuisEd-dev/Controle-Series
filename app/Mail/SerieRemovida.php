<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SebastianBergmann\Environment\Console;

class SerieRemovida extends Mailable
{
    use Queueable, SerializesModels;

    public $serie;
    public $autor;
    public $quando;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($serie, $autor)
    {
        $this->serie = $serie;
        $this->autor = $autor;
        $this->quando = now()->format('d/m/Y - H:i:s');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.serie.serie-removida');
    }
}
