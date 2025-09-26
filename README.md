# codemonster-ru/view

[![Latest Version on Packagist](https://img.shields.io/packagist/v/codemonster-ru/view.svg?style=flat-square)](https://packagist.org/packages/codemonster-ru/view)
[![Total Downloads](https://img.shields.io/packagist/dt/codemonster-ru/view.svg?style=flat-square)](https://packagist.org/packages/codemonster-ru/view)
[![License](https://img.shields.io/packagist/l/codemonster-ru/view.svg?style=flat-square)](https://packagist.org/packages/codemonster-ru/view)
[![Tests](https://github.com/codemonster-ru/view/actions/workflows/tests.yml/badge.svg)](https://github.com/codemonster-ru/view/actions/workflows/tests.yml)

A core for rendering views in PHP applications.

The package itself doesn't contain any engines; they are included in separate packages:

-   [`codemonster-ru/view-php`](https://github.com/codemonster-ru/view-php) — PHP templates
-   [`codemonster-ru/view-ssr`](https://github.com/codemonster-ru/view-ssr) — SSR for Vue/React
-   (future) Twig, Blade, and others

## 📦 Installation

```bash
composer require codemonster-ru/view
```

## 🚀 Usage

```php
use Codemonster\View\View;
use Codemonster\View\EngineInterface;

class DummyEngine implements EngineInterface {
    public function render(string $view, array $data = []): string {
        return strtoupper($view);
    }
}

$view = new View(['dummy' => new DummyEngine()], 'dummy');

echo $view->render('home'); // => HOME
```

## ✨ Features

-   Engine-agnostic core
-   Support for multiple engines (`PhpEngine`, `SsrEngine`, `TwigEngine`, etc.)
-   Unified `EngineInterface` interface
-   Easy integration with frameworks (e.g., Annabel)

## 🧪 Testing

You can run tests with the command:

```bash
composer test
```

## 👨‍💻 Author

[**Kirill Kolesnikov**](https://github.com/KolesnikovKirill)

## 📜 License

[MIT](https://github.com/codemonster-ru/view/blob/main/LICENSE)
