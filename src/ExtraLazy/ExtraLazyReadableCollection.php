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

use Doctrine\Common\Collections\ReadableCollection;
use Rekalogika\Collections\Decorator\AbstractRejectDecorator\AbstractReadableCollectionRejectDecorator;
use Rekalogika\Collections\Decorator\Trait\CountableDecoratorTrait;

/**
 * @template TKey of array-key
 * @template T
 * @extends AbstractReadableCollectionRejectDecorator<TKey,T>
 */
class ExtraLazyReadableCollection extends AbstractReadableCollectionRejectDecorator
{
    use CountableDecoratorTrait;

    /**
     * @param ReadableCollection<TKey,T> $wrapped
     */
    public function __construct(private ReadableCollection $wrapped)
    {
    }

    /**
     * @return ReadableCollection<TKey,T>
     */
    protected function getWrapped(): ReadableCollection
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
}
