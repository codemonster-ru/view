<?php

namespace Codemonster\View\Tests;

use Codemonster\View\View;
use Codemonster\View\EngineInterface;
use PHPUnit\Framework\TestCase;

class DummyEngine implements EngineInterface
{
    public function render(string $view, array $data = []): string
    {
        return strtoupper($view) . ':' . json_encode($data);
    }
}

class ViewTest extends TestCase
{
    public function testRenderWithDummyEngine()
    {
        $view = new View(['dummy' => new DummyEngine()], 'dummy');

        $output = $view->render('hello', ['name' => 'World']);

        $this->assertEquals('HELLO:{"name":"World"}', $output);
    }

    public function testThrowsWhenEngineNotFound()
    {
        $this->expectException(\RuntimeException::class);

        $view = new View([], 'php');
        $view->render('home');
    }
}
