<?php

class MobileView extends Controller
{
    public function index($mailId = '')
    {   
        setcookie('mailID', $mailId);
        $this->view('mobileView');
    }

}