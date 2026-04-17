<?php

class TestController
{
    public function index()
    {
        echo "<h1>This is /test</h1>";
    }

    public function hello()
    {
        echo "<h1>Hello world!</h1>";
    }

    public function greet($name)
    {
        echo "<h1>Hello " . htmlspecialchars($name) . " 👋</h1>";
    }
}
