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

/**
 * @template TKey of array-key
 * @template T
 */
trait ArrayAccessDecoratorTrait
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
        /** @var \ArrayAccess<TKey,T> */
        $wrapped = $this->getWrapped();

        return $wrapped->offsetExists($offset);
    }

    /**
     * @param TKey $offset
     * @return T|null
     */
    public function offsetGet(mixed $offset): mixed
    {
        /** @var \ArrayAccess<TKey,T> */
        $wrapped = $this->getWrapped();

        return $wrapped->offsetGet($offset);
    }

    /**
     * @param TKey|null $offset
     * @param T $value
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        /** @var \ArrayAccess<TKey,T> */
        $wrapped = $this->getWrapped();

        $wrapped->offsetSet($offset, $value);
    }

    /**
     * @param TKey $offset
     */
    public function offsetUnset(mixed $offset): void
    {
        /** @var \ArrayAccess<TKey,T> */
        $wrapped = $this->getWrapped();

        $wrapped->offsetUnset($offset);
    }
}
