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

namespace Rekalogika\Collections\Decorator\LazyMatching;

use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ReadableCollection;
use Doctrine\Common\Collections\Selectable;
use Rekalogika\Collections\Decorator\Decorator\SelectableCollectionDecorator;

/**
 * @template TKey of array-key
 * @template T
 * @extends SelectableCollectionDecorator<TKey,T>
 */
class LazyMatchingCollection extends SelectableCollectionDecorator
{
    public function matching(Criteria $criteria): ReadableCollection&Selectable
    {
        return (new LazyMatchingReadableCollection($this->getWrapped()))
            ->matching($criteria);
    }
}
