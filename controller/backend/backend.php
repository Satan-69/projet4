<?php
require_once 'lib/form.php';

class Backend
{
    public $url;

    public function __construct()
    {
        $this->getUrl();
    }

    public function getUrl()
    {
        $request = $_SERVER['REQUEST_URI'];
        if (isset($request) && !empty($request))
        {
            $this->url = $request;
        }
        else
        {
            throw new Exception('invalid URL');
        }
    }

    public function auth()
    {
        if (isset($this->url))
        require 'view/backend/auth.php';
    }

    public function logout()
    {
        if (isset($this->url))
        require 'view/backend/logout.php';
    }

    public function dashboard()
    {
        if (isset($this->url))
        {
            require 'view/backend/dashboard.php';
        }
    }

    public function createArticle()
    {
        if (isset($this->url))
        {
            require "view/backend/create.php";
        }
    }
}