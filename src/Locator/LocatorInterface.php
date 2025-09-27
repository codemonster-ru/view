<?php
namespace Codemonster\View\Locator;

interface LocatorInterface
{
    public function resolve(string $name, string|array $extensions): string;
}
