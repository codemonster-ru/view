<?php

namespace Codemonster\View;

interface EngineInterface
{
    public function render(string $view, array $data = []): string;
}
