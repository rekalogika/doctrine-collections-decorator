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

use Doctrine\Common\Collections\ReadableCollection;
use Rekalogika\Collections\Decorator\AbstractRejectDecorator\AbstractReadableCollectionRejectDecorator;

/**
 * @template TKey of array-key
 * @template T
 * @extends AbstractReadableCollectionRejectDecorator<TKey,T>
 */
class ReadableCollectionRejectDecorator extends AbstractReadableCollectionRejectDecorator
{
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
}
