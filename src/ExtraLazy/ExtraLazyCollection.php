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
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ReadableCollection;
use Doctrine\Common\Collections\Selectable;
use Rekalogika\Collections\Decorator\AbstractRejectDecorator\AbstractSelectableCollectionRejectDecorator;

/**
 * @template TKey of array-key
 * @template T
 * @extends AbstractSelectableCollectionRejectDecorator<TKey,T>
 */
class ExtraLazyCollection extends AbstractSelectableCollectionRejectDecorator
{
    /**
     * @var Collection<TKey,T>&Selectable<TKey,T>
     */
    private Collection $wrapped;

    /**
     * @param Collection<TKey,T> $wrapped
     */
    public function __construct(Collection $wrapped)
    {
        if (!$wrapped instanceof Selectable) {
            throw new \InvalidArgumentException('The wrapped collection must implement Selectable');
        }

        $this->wrapped = $wrapped;
    }

    protected function getWrapped(): Collection&Selectable
    {
        return $this->wrapped;
    }

    public function contains(mixed $element): bool
    {
        return $this->getWrapped()->contains($element);
    }

    public function containsKey(string|int $key): bool
    {
        return $this->getWrapped()->containsKey($key);
    }

    public function count(): int
    {
        return $this->getWrapped()->count();
    }

    public function get(string|int $key): mixed
    {
        return $this->getWrapped()->get($key);
    }

    public function slice(int $offset, ?int $length = null): array
    {
        return $this->getWrapped()->slice($offset, $length);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($offset !== null) {
            throw new \BadMethodCallException('ExtraLazyCollection does not support offsetSet with non-null offset');
        }

        $this->getWrapped()->offsetSet(null, $value);
    }

    public function add(mixed $element): void
    {
        $this->getWrapped()->add($element);
    }

    public function matching(Criteria $criteria): ReadableCollection&Selectable
    {
        return $this->getWrapped()->matching($criteria);
    }
}
