<?php

namespace CleaniqueCoders\LaravelHelper\Tests;

class UserHelperTest extends TestCase
{
    /** @test */
    public function it_has_user_helper()
    {
        $this->assertTrue(function_exists('user'));
    }
}
