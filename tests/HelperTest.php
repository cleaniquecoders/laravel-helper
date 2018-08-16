<?php

namespace CleaniqueCoders\LaravelHelper\Tests;

class HelperTest extends TestCase
{
    /** @test */
    public function it_has_helper_file()
    {
        $this->assertTrue(file_exists(dirname(dirname(__FILE__)) . '/src/Support/helpers.php'));
    }

    /** @test */
    public function it_has_helper_config_file()
    {
        $this->assertTrue(file_exists(dirname(dirname(__FILE__)) . '/config/helper.php'));
    }

    /** @test */
    public function it_has_all_helpers()
    {
        $helpers = ['abbrv', 'generate_sequence', 'fqcn', 'str_slug_fqcn'];

        foreach ($helpers as $helper) {
            $this->assertTrue(function_exists($helper));
        }
    }

    /** @test */
    public function abbrv_test()
    {
        $data = [
            'your word'        => 'YRWD',
            'Cleanique Coders' => 'CLNQDRS',
            'Laravel Helper'   => 'LRVHP',
        ];
        foreach ($data as $word => $expected) {
            $actual = abbrv($word);
            $this->assertSame($expected, $actual);
        }
    }
}
