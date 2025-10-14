<?php

namespace Codemonster\View;

use Codemonster\View\Contracts\SupportsInspectionInterface;

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
        if ($engine !== null) {
            return $this->renderWith($engine, $view, $data);
        }

        $detected = $this->detectEngineByExtension($view);

        if ($detected !== null) {
            return $this->renderWith($detected, $view, $data);
        }

        return $this->renderWith($this->default, $view, $data);
    }

    protected function detectEngineByExtension(string $view): ?string
    {
        foreach ($this->engines as $name => $engine) {
            if (!$engine instanceof SupportsInspectionInterface) {
                continue;
            }

            $locator = $engine->getLocator();

            foreach ($engine->getExtensions() as $ext) {
                $path = $this->tryResolve($locator, $view, $ext);

                if ($path !== null) {
                    return $name;
                }
            }
        }

        return null;
    }

    protected function tryResolve($locator, string $view, string $extension): ?string
    {
        if (method_exists($locator, 'resolveSilently')) {
            return $locator->resolveSilently($view, $extension);
        }

        try {
            $path = $locator->resolve($view, $extension);

            return file_exists($path) ? $path : null;
        } catch (\Throwable) {
            return null;
        }
    }

    protected function renderWith(string $engine, string $view, array $data): string
    {
        if (!isset($this->engines[$engine])) {
            throw new \RuntimeException("View engine [{$engine}] not registered.");
        }

        return $this->engines[$engine]->render($view, $data);
    }
}
