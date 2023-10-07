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

/**
 * @template TKey of array-key
 * @template T
 */
trait ArrayAccessRejectDecoratorTrait
{
    /**
     * @return \ArrayAccess<TKey,T>
     */
    abstract protected function getWrapped(): \ArrayAccess;

    /**
     * @param TKey $offset
     */
    public function offsetExists(mixed $offset): bool
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @param TKey $offset
     * @return T|null
     */
    public function offsetGet(mixed $offset): mixed
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @param TKey|null $offset
     * @param T $value
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }

    /**
     * @param TKey $offset
     */
    public function offsetUnset(mixed $offset): void
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }
}
