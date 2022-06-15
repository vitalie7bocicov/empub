<?php

class Statistics extends Controller
{
    public function index($mailId = '')
    {
        setcookie('mailID', $mailId);
        $this->view('statisticsPage');
    }

}