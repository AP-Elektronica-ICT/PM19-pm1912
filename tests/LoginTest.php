<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use loginclass;


class LoginTest extends TestCase
{
    private $calc;

    public function __construct()
    {
        $this->calc = new loginclass("sha1","123");
        /*
        $this->calc = new registrationclass("BuildTest","BuildTest","BuildTest","BuildTest","BuildTest",0,"BuildTest","BuildTest",0,0);
        */
        parent::__construct();
    }

    public function testLogin()
    {
        $value = $this->calc->LoginUser();
        $this->assertEquals($value, true);
    }
        
    /*

    public function testAdd()
    {
        $value = $this->calc->add();
        $this->assertEquals($value, true);
    }
    
    
    public function testDelete()
	{
		$value = $this->calc->remove();
        $this->assertEquals($value, true);
	}
    */
}
