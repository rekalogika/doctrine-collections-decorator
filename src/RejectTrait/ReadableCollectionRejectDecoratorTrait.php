<?php

declare(strict_types=1);

/*
 * This file is part of rekalogika/doctrine-collections-decorator package.
 *
 * (c) Priyadi Iman Nurcahyo <https://rekalogika.dev>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Rekalogika\Collections\Decorator\RejectTrait;

use Doctrine\Common\Collections\ReadableCollection;

/**
 * @template TKey of array-key
 * @template-covariant T
 */
trait ReadableCollectionRejectDecoratorTrait
{
    use CountableRejectDecoratorTrait;

    /**
     * @use IteratorAggregateRejectDecoratorTrait<TKey,T>
     */
    use IteratorAggregateRejectDecoratorTrait;

    /**
     * @return ReadableCollection<TKey,T>
     */
    abstract protected function getWrapped(): ReadableCollection;

    /**
     * @template TMaybeContained
     * @param TMaybeContained $element
     * @return (TMaybeContained is T ? bool : false)
     */
    public function contains(mixed $element): bool
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    public function isEmpty(): bool
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @param TKey $key
     */
    public function containsKey(string|int $key): bool
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @param TKey $key
     * @return T|null
     */
    public function get(string|int $key): mixed
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @return list<TKey>
     */
    public function getKeys(): array
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @return list<T>
     */
    public function getValues(): array
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @return array<TKey,T>
     */
    public function toArray(): array
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @return T|false
     */
    public function first(): mixed
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @return T|false
     */
    public function last(): mixed
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @return TKey|null
     */
    public function key(): int|string|null
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @return T|false
     */
    public function current(): mixed
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @return T|false
     */
    public function next(): mixed
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @return array<TKey,T>
     */
    public function slice(int $offset, ?int $length = null): array
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @param \Closure(TKey,T):bool $p
     */
    public function exists(\Closure $p): bool
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @param \Closure(T,TKey):bool $p
     * @return ReadableCollection<TKey,T>
     */
    public function filter(\Closure $p): ReadableCollection
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @template U
     * @param \Closure(T):U $func
     * @return ReadableCollection<TKey,U>
     */
    public function map(\Closure $func): ReadableCollection
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @param \Closure(TKey,T):bool $p
     * @return array{0:ReadableCollection<TKey,T>,1:ReadableCollection<TKey,T>}
     */
    public function partition(\Closure $p): array
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @param \Closure(TKey,T):bool $p
     */
    public function forAll(\Closure $p): bool
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @template TMaybeContained
     * @param TMaybeContained $element
     * @return  (TMaybeContained is T ? TKey|false : false)
     */
    public function indexOf(mixed $element): int|string|bool
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @param \Closure(TKey,T):bool $p
     * @return T|null
     */
    public function findFirst(\Closure $p): mixed
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @template TReturn
     * @template TInitial
     * @param \Closure(TReturn|TInitial|null, T):(TInitial|TReturn) $func
     * @param TInitial|null $initial
     * @return TReturn|TInitial|null
     */
    public function reduce(\Closure $func, mixed $initial = null): mixed
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }
}
