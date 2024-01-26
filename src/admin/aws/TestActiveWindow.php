<?php

namespace siripravi\ecommerce\admin\aws;

class TestActiveWindow extends \luya\admin\ngrest\base\ActiveWindow
{
    public $module = 'catalogadmin';

    public function index()
    {
        return $this->render("index");
    }

    public function callbackSayHello($name)
    {

        return $postdata;
        return $this->sendSuccess("success");
        $this->sendSuccess('Hello: ' . $this->itemId);
    }

    public function callbackIndex()
    {
        $postdata = file_get_contents("php://input");

        return $this->render('index', ['postdata' => $postdata]);
    }

    public function callbackHelloWorld($name)
    {
        return $this->sendSuccess('Hello ' . $name);
    }
}
