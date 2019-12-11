<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use profile;


class ProfileTest extends TestCase
{
    private $calc;

    public function __construct()
    {
        $this->calc = new profile(5);
        parent::__construct();
    }


    public function testGetPosts()
    {
        $value = $this->calc->getPosts();
        $this->assertEquals($value, true);
    }
}
