<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use loginclass;


class LoginTest extends TestCase
{
    private $calc;

    public function __construct()
    {
        $this->calc = new loginclass("sha1",sha1("123"));
        parent::__construct();
    }


    public function testLogin()
    {
        $value = $this->calc->LoginUser();
        $this->assertEquals($value, true);
    }
}
