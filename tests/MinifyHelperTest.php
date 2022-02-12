<?php

namespace CleaniqueCoders\LaravelHelper\Tests;

class MinifyHelperTest extends TestCase
{
    /** @test */
    public function it_has_minify_helper()
    {
        $this->assertTrue(function_exists('minify'));
    }

    /** @test */
    public function it_can_minify_html()
    {
        $content = '<html>
	<head>
		<title>Laravel Helper</title>
	</head>
	<body>
		<h1>Laravel Helper</h1>
	</body>
</html>';
        $expected = '<html><head><title>Laravel Helper</title></head><body><h1>Laravel Helper</h1></body></html>';
        $actual = minify($content);
        $this->assertEquals($expected, $actual);
    }
}
