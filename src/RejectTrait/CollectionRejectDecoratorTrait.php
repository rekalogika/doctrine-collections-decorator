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

use Doctrine\Common\Collections\Collection;

/**
 * @template TKey of array-key
 * @template T
 * @extends ArrayAccess<TKey, T>
 */
trait CollectionRejectDecoratorTrait
{
    /**
     * @use ReadableCollectionRejectDecoratorTrait<TKey,T>
     */
    use ReadableCollectionRejectDecoratorTrait;

    /**
     * @use ArrayAccessRejectDecoratorTrait<TKey,T>
     */
    use ArrayAccessRejectDecoratorTrait;

    /**
     * @return Collection<TKey,T>
     */
    abstract protected function getWrapped(): Collection;

    /**
     * @param T $element
     */
    public function add(mixed $element): void
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    public function clear(): void
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @param TKey $key
     * @return T|null
     */
    public function remove(string|int $key): mixed
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @param T $element
     */
    public function removeElement(mixed $element): bool
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @param TKey $key
     * @param T $value
     */
    public function set(string|int $key, mixed $value): void
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * // param \Closure(T,TKey):bool $p
     * @return Collection<TKey,T>
     */
    public function filter(\Closure $p): Collection
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @template U
     * @param \Closure(T):U $func
     * @return Collection<TKey,U>
     */
    public function map(\Closure $func): Collection
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * // param \Closure(TKey,T):bool $p
     * @return array{0:Collection<TKey,T>,1:Collection<TKey,T>}
     */
    public function partition(\Closure $p): array
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }
}
