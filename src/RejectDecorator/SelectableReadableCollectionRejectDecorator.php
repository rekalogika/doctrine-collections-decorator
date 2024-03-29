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
use Doctrine\Common\Collections\Selectable;
use Rekalogika\Collections\Decorator\AbstractRejectDecorator\AbstractSelectableReadableCollectionRejectDecorator;

/**
 * @template TKey of array-key
 * @template T
 * @extends AbstractSelectableReadableCollectionRejectDecorator<TKey,T>
 */
class SelectableReadableCollectionRejectDecorator extends AbstractSelectableReadableCollectionRejectDecorator
{
    /**
     * @param ReadableCollection<TKey,T>&Selectable<TKey,T> $wrapped
     */
    public function __construct(private ReadableCollection&Selectable $wrapped)
    {
    }

    /**
     * @return ReadableCollection<TKey,T>&Selectable<TKey,T>
     */
    protected function getWrapped(): ReadableCollection&Selectable
    {
        return $this->wrapped;
    }
}
