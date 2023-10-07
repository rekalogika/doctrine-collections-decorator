<?php

declare(strict_types=1);

/*
 * This file is part of rekalogika/doctrine-collections-Rejectdecorator package.
 *
 * (c) Priyadi Iman Nurcahyo <https://rekalogika.dev>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Rekalogika\Collections\Decorator\RejectDecorator;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Rekalogika\Collections\Decorator\AbstractRejectDecorator\AbstractSelectableCollectionRejectDecorator;

/**
 * @template TKey of array-key
 * @template T
 * @extends AbstractSelectableCollectionRejectDecorator<TKey,T>
 */
class SelectableCollectionRejectDecorator extends AbstractSelectableCollectionRejectDecorator
{
    /**
     * @param Collection<TKey,T>&Selectable<TKey,T> $wrapped
     */
    public function __construct(private Collection&Selectable $wrapped)
    {
    }
    
    /**
     * @return Collection<TKey,T>&Selectable<TKey,T>
     */
    protected function getWrapped(): Collection&Selectable
    {
        return $this->wrapped;
    }
}
