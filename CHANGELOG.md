# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.2.0] - 2024-05-17
### Changed
- `HasError` trait was rejigged to be more flexible.
  - Supports a suffix (in addition to the prefix it already did.)
  - Supports using colours.
- `ParamsApp` includes new `HasMessages` trait.
### Added
- A new `HasMessages` trait offering different types of status messages.
  - Supports the same kinds of formatting options as `HasError`.
  - Has a generic `msg()` method for adding additional message types.
- A new `Themes/Standard` trait to colourize status messages and errors.

## [1.1.0] - 2024-01-11
### Added
- New `Util` static class with some helper functions.
- A `examples/get_args.php` testing `Util::parse_get_args()` function.
### Changed
- `ParamsApp` now extends `Util` so will have the utility functions available.

## [1.0.1] - 2022-07-22
### Added
- First release (replaced initially broken `1.0.0`).
- Pulls all `Lum\CLI` libraries out of `lum-framework`.
- Also pulls `Fakeserver` library out of `lum-core`.

[Unreleased]: https://github.com/supernovus/lum.cli.php/compare/v1.2.0...HEAD
[1.2.0]: https://github.com/supernovus/lum.cli.php/compare/v1.1.0...v1.2.0
[1.1.0]: https://github.com/supernovus/lum.cli.php/compare/v1.0.1...v1.1.0
[1.0.1]: https://github.com/supernovus/lum.cli.php/releases/tag/v1.0.1

