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

namespace Rekalogika\Collections\Decorator\ExtraLazy;

use Doctrine\Common\Collections\Collection;
use Rekalogika\Collections\Decorator\AbstractRejectDecorator\AbstractCollectionRejectDecorator;
use Rekalogika\Collections\Decorator\Trait\CountableDecoratorTrait;

/**
 * @template TKey of array-key
 * @template T
 * @extends AbstractCollectionRejectDecorator<TKey,T>
 */
class ExtraLazyCollection extends AbstractCollectionRejectDecorator
{
    use CountableDecoratorTrait;

    /**
     * @param Collection<TKey,T> $wrapped
     */
    public function __construct(private Collection $wrapped)
    {
    }

    /**
     * @return Collection<TKey,T>
     */
    protected function getWrapped(): Collection
    {
        return $this->wrapped;
    }

    /**
     * @template TMaybeContained
     * @param TMaybeContained $element
     * @return (TMaybeContained is T ? bool : false)
     */
    public function contains(mixed $element): bool
    {
        return $this->getWrapped()->contains($element);
    }

    /**
     * @param TKey $key
     */
    public function containsKey(string|int $key): bool
    {
        return $this->getWrapped()->containsKey($key);
    }

    /**
     * @param TKey $key
     * @return T|null
     */
    public function get(string|int $key): mixed
    {
        return $this->getWrapped()->get($key);
    }

    /**
     * @return array<TKey,T>
     */
    public function slice(int $offset, ?int $length = null): array
    {
        return $this->getWrapped()->slice($offset, $length);
    }

    /**
     * @param TKey|null $offset
     * @param T $value
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($offset !== null) {
            throw new \BadMethodCallException('ExtraLazyCollection does not support offsetSet with non-null offset');
        }

        $this->getWrapped()->offsetSet(null, $value);
    }

    /**
     * @param T $element
     */
    public function add(mixed $element): void
    {
        $this->getWrapped()->add($element);
    }
}