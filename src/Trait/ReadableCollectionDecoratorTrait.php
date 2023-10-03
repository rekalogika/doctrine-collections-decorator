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

namespace Rekalogika\Collections\Decorator\Trait;

use Doctrine\Common\Collections\ReadableCollection;

/**
 * @template TKey of array-key
 * @template-covariant T
 */
trait ReadableCollectionDecoratorTrait
{
    /**
     * @use IteratorAggregateDecoratorTrait<TKey,T>
     */
    use CountableDecoratorTrait, IteratorAggregateDecoratorTrait;

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
        return $this->getWrapped()->contains($element);
    }

    public function isEmpty(): bool
    {
        return $this->getWrapped()->isEmpty();
    }

    /**
     * @param TKey $key
     */
    public function containsKey(string|int $key): bool
    {
        /** @var ReadableCollection<TKey,T> */
        $wrapped = $this->getWrapped();

        return $wrapped->containsKey($key);
    }

    /**
     * @param TKey $key
     * @return T|null
     */
    public function get(string|int $key): mixed
    {
        /** @var ReadableCollection<TKey,T> */
        $wrapped = $this->getWrapped();

        return $wrapped->get($key);
    }

    /**
     * @return list<TKey>
     */
    public function getKeys(): array
    {
        return $this->getWrapped()->getKeys();
    }

    /**
     * @return list<T>
     */
    public function getValues(): array
    {
        return $this->getWrapped()->getValues();
    }

    /**
     * @return array<TKey,T>
     */
    public function toArray(): array
    {
        return $this->getWrapped()->toArray();
    }

    /**
     * @return T|false
     */
    public function first(): mixed
    {
        return $this->getWrapped()->first();
    }

    /**
     * @return T|false
     */
    public function last(): mixed
    {
        return $this->getWrapped()->last();
    }

    /**
     * @return TKey|null
     */
    public function key(): int|string|null
    {
        return $this->getWrapped()->key();
    }

    /**
     * @return T|false
     */
    public function current(): mixed
    {
        return $this->getWrapped()->current();
    }

    /**
     * @return T|false
     */
    public function next(): mixed
    {
        return $this->getWrapped()->next();
    }

    /**
     * @return array<TKey,T>
     */
    public function slice(int $offset, ?int $length = null): array
    {
        return $this->getWrapped()->slice($offset, $length);
    }

    /**
     * @param \Closure(TKey,T):bool $p
     */
    public function exists(\Closure $p): bool
    {
        return $this->getWrapped()->exists($p);
    }

    /**
     * @param \Closure(T,TKey):bool $p
     * @return ReadableCollection<TKey,T>
     */
    public function filter(\Closure $p): ReadableCollection
    {
        return $this->getWrapped()->filter($p);
    }

    /**
     * @template U
     * @param \Closure(T):U $func
     * @return ReadableCollection<TKey,U>
     */
    public function map(\Closure $func): ReadableCollection
    {
        return $this->getWrapped()->map($func);
    }

    /**
     * @param \Closure(TKey,T):bool $p
     * @return array{0:ReadableCollection<TKey,T>,1:ReadableCollection<TKey,T>}
     */
    public function partition(\Closure $p): array
    {
        return $this->getWrapped()->partition($p);
    }

    /**
     * @param \Closure(TKey,T):bool $p
     */
    public function forAll(\Closure $p): bool
    {
        return $this->getWrapped()->forAll($p);
    }

    /**
     * @template TMaybeContained
     * @param TMaybeContained $element
     * @return  (TMaybeContained is T ? TKey|false : false)
     */
    public function indexOf(mixed $element): int|string|bool
    {
        return $this->getWrapped()->indexOf($element);
    }

    /**
     * @param \Closure(TKey,T):bool $p
     * @return T|null
     */
    public function findFirst(\Closure $p): mixed
    {
        return $this->getWrapped()->findFirst($p);
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
        return $this->getWrapped()->reduce($func, $initial);
    }
}
