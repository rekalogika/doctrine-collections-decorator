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

/**
 * @template TKey of array-key
 * @template T
 * @implements Selectable<TKey,T>
 */
class LazyMatchingSelectable implements Selectable
{
    /**
     * @param Selectable<TKey,T> $wrapped
     */
    public function __construct(private Selectable $wrapped)
    {
    }

    /**
     * @return ReadableCollection<TKey,T>&Selectable<TKey,T>
     */
    public function matching(Criteria $criteria): ReadableCollection&Selectable
    {
        return new LazyMatchingReadableCollectionFromSelectable($this->wrapped, $criteria);
    }
}
