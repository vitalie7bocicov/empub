<?php

class emailSettings extends Controller
{
    public function index($mailId = '')
    {
        setcookie('mailID', $mailId);
        $this->view('settingsPage');
    }
}