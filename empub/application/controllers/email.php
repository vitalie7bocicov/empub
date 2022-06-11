<?php

class Email extends Controller
{
    public function index($mailId = '')
    {
        setcookie('mailID', $mailId);
        $this->view('mailPage');
    }

}