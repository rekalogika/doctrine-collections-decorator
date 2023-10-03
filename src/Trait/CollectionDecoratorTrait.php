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

use Doctrine\Common\Collections\Collection;

/**
 * @template TKey of array-key
 * @template T
 * @extends ArrayAccess<TKey, T>
 */
trait CollectionDecoratorTrait
{
    /**
     * @use ReadableCollectionDecoratorTrait<TKey,T>
     * @use ArrayAccessDecoratorTrait<TKey,T>
     */
    use ReadableCollectionDecoratorTrait, ArrayAccessDecoratorTrait;

    /**
     * @return Collection<TKey,T>
     */
    abstract protected function getWrapped(): Collection;

    /**
     * @param T $element
     */
    public function add(mixed $element): void
    {
        $this->getWrapped()->add($element);
    }

    public function clear(): void
    {
        $this->getWrapped()->clear();
    }

    /**
     * @param TKey $key
     */
    public function remove(string|int $key): mixed
    {
        /** @var Collection<TKey,T> */
        $wrapped = $this->getWrapped();

        return $wrapped->remove($key);
    }

    /**
     * @param T $element
     */
    public function removeElement(mixed $element): bool
    {
        return $this->getWrapped()->removeElement($element);
    }

    /**
     * @param TKey $key
     * @param T $value
     */
    public function set(string|int $key, mixed $value): void
    {
        /** @var Collection<TKey,T> */
        $wrapped = $this->getWrapped();

        $wrapped->set($key, $value);
    }
}
