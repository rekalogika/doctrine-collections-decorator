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

namespace Rekalogika\Collections\Decorator\RejectDecorator;

use Doctrine\Common\Collections\Collection;
use Rekalogika\Collections\Decorator\AbstractRejectDecorator\AbstractCollectionRejectDecorator;

/**
 * @template TKey of array-key
 * @template T
 * @extends AbstractCollectionRejectDecorator<TKey,T>
 */
class CollectionRejectDecorator extends AbstractCollectionRejectDecorator
{
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
}
