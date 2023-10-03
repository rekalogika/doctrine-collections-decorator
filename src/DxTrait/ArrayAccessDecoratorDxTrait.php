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

namespace Rekalogika\Collections\Decorator\DxTrait;

/**
 * Convenience methods so that implementor doesn't have to implement ArrayAccess
 * methods.
 *
 * @template TKey of array-key
 * @template T
 */
trait ArrayAccessDecoratorDxTrait
{
    /**
     * @param TKey $offset
     */
    public function offsetExists(mixed $offset): bool
    {
        return $this->containsKey($offset);
    }

    /**
     * @param TKey $offset
     * @return T|null
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }

    /**
     * @param TKey|null $offset
     * @param T $value
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($offset === null) {
            $this->add($value);

            return;
        }

        /** @var TKey $offset */
        $this->set($offset, $value);
    }

    /**
     * @param TKey $offset
     */
    public function offsetUnset(mixed $offset): void
    {
        $this->remove($offset);
    }
}
