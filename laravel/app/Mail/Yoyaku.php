<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Yoyaku extends Mailable
{
    use Queueable, SerializesModels;

    private $_params = [];
    protected $_mailsettings = [];
    protected $_to = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($params,$mailsettings,$to)
    {
        $this->_params = $params;
        $this->_mailsettings = $mailsettings;
        $this->_to = $to;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        if($this->_to == $this->_mailsettings['admin_email']){
            return $this->text('mail.yoyaku_to_admin')
                    ->subject($this->_mailsettings['admin_subject'])
                    ->with('params', $this->_params)->with('mailsettings', $this->_mailsettings);
        }elseif($this->_to == $this->_params['emailtoUser']){
            return $this->text('mail.yoyaku_to_user')
                    ->subject($this->_mailsettings['user_subject'])
                    ->with('params', $this->_params)->with('mailsettings', $this->_mailsettings);
        }
    }
}
