# Changelog

## 2.2.0

* feat: add `LazyMatchingSelectable` for decorating non-collection `Selectable`
  objects, like Doctrine repositories.

## 2.1.4

* fix: fix error with `deep_copy()`, use `clone` instead

## 2.1.3

* Improve lazy-matching test.
* refactor: remove criteria from __construct

## 2.1.2

* Fix nullable intersection type problem with PHP 8.1
* Only keep `ExtraLazyCollection`
* Fix all `matching()` signature to return `ReadableCollection&Selectable`
* Add `matching()` as a safe method to `ExtraLazyCollection`
* Remove unnecessary PHPDoc from `ExtraLazyCollection`

## 2.1.1

* Fix `SelectableReadableCollectionRejectDecorator`

## 2.1.0

* Selectable decorators now accept collection without Selectable typehint, for
  convenience. The checking is now done in the constructors, instead of the
  caller.
* Add `LazyMatchingCollection`

## 2.0.0

* Add `AbstractSelectableReadableCollectionDecorator`
* Add "reject" decorators and traits
* Add concrete noop decorators
* Reorganize namespaces
* Add extra-lazy decorators

## 1.0.0

* Initial commit