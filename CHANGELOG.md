# Changelog

All significant changes to this project will be documented in this file.

## [1.1.0] - 2025-09-27

### Added

-   Template Locator: `Codemonster\View\Locator\LocatorInterface` and `DefaultLocator` implementation.
-   Dot notation support (`emails.welcome` → `emails/welcome.php`).
-   Namespace prefix support in view names: `blog::post.show`.
-   Multiple base paths with predictable priority (the first one containing the file is taken); non-existent paths are soft-skipping.
-   Order-sensitive search across multiple extensions (`['phtml','php']` → the first available one is selected).
-   Unit tests: `tests/Locator/DefaultLocatorTest.php` + fixtures; Basic `View` tests.

### Security

-   Path traversal protection: ensures that the found file is located within allowed directories; attempts to go beyond the base path are blocked.

### Changed

-   Recommended pattern: engines don't search for files themselves, but use the locator from the core. This reduces duplication and aligns behavior between engines (PHP/Twig/etc.). The update is backwards-compatible: existing engines can continue to work as is, but new ones should rely on the locator.

### Notes

-   Examples of using the locator and engines are reflected in the tests; for the PHP engine, see the `codemonster-ru/view-php` package.

## [1.0.0] - 2025-09-26

### Added

-   First release of the `codemonster-ru/view` package.
-   The `EngineInterface` interface.
-   The `View` class for engine dispatching.
-   The `addEngine()` method for dynamic engine registration.
-   Basic tests with `DummyEngine`.
-   Documentation (`README.md`).
