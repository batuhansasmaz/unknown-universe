<?php

class MessageHandler extends AbstractHandler
{

    public function __construct()
    {
        parent::__construct();

        $this->addAction(
            'send',
            [
                'recipient',
                'content',
                'title',
            ]
        );

        $this->addAction(
            'reply',
            [
                'recipient',
                'content',
                'title',
            ]
        );
        $this->addAction('delete', ['mID']);
    }

    public function handle() : void
    {

        parent::handle();

        $function = 'exec_' . $this->action;
        $this->$function();
    }

    public function exec_send()
    {
        global $System;

        $rID = $System->getUserId($this->params['recipient']);
        if ($System->User->sendMessage($rID, $this->params['content'], $this->params['title'])) {
            Utils::dieM('Message sent!');
        } else {
            http_response_code(500);
            Utils::dieM('Failed to send message, pleas try again.');
        }
    }

    public function exec_reply()
    {
        global $System;

        if ($System->User->sendMessage($this->params['recipient'], $this->params['content'], $this->params['title'])) {
            Utils::dieM('Message sent!');
        } else {
            http_response_code(500);
            Utils::dieM('Failed to send message, pleas try again.');
        }
    }

    public function exec_delete()
    {
        global $System;
        if ($System->User->delMessage($this->params['mID'])) {
            Utils::dieM('Deleted message!');
        } else {
            http_response_code(500);
            Utils::dieM('Unknown internal error, please try again.');
        }

    }

}