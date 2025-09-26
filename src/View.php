<?php

namespace Codemonster\View;

class View
{
    protected array $engines;

    protected string $default;

    public function __construct(array $engines = [], string $default = 'php')
    {
        $this->engines = $engines;
        $this->default = $default;
    }

    public function addEngine(string $name, EngineInterface $engine): void
    {
        $this->engines[$name] = $engine;
    }

    public function render(string $view, array $data = [], ?string $engine = null): string
    {
        $engine = $engine ?? $this->default;

        if (!isset($this->engines[$engine])) {
            throw new \InvalidArgumentException("Engine [$engine] not registered.");
        }

        return $this->engines[$engine]->render($view, $data);
    }
}
