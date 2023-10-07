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

namespace Rekalogika\Collections\Decorator\Decorator;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Rekalogika\Collections\Decorator\AbstractDecorator\AbstractSelectableCollectionDecorator;

/**
 * @template TKey of array-key
 * @template T
 * @extends AbstractSelectableCollectionDecorator<TKey,T>
 */
class SelectableCollectionDecorator extends AbstractSelectableCollectionDecorator
{
    /**
     * @var Collection<TKey,T>&Selectable<TKey,T>
     */
    private Collection&Selectable $wrapped;

    /**
     * @param Collection<TKey,T> $wrapped
     */
    public function __construct(Collection $wrapped)
    {
        if (!$wrapped instanceof Selectable) {
            throw new \InvalidArgumentException('Wrapped collection must be instance of Selectable');
        }

        $this->wrapped = $wrapped;
    }
    
    /**
     * @return Collection<TKey,T>&Selectable<TKey,T>
     */
    protected function getWrapped(): Collection&Selectable
    {
        return $this->wrapped;
    }
}
