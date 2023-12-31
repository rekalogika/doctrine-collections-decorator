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

use Doctrine\Common\Collections\ReadableCollection;
use Doctrine\Common\Collections\Selectable;
use Rekalogika\Collections\Decorator\AbstractDecorator\AbstractSelectableReadableCollectionDecorator;

/**
 * @template TKey of array-key
 * @template T
 * @extends AbstractSelectableReadableCollectionDecorator<TKey,T>
 */
class SelectableReadableCollectionDecorator extends AbstractSelectableReadableCollectionDecorator
{
    /**
     * @var ReadableCollection<TKey,T>&Selectable<TKey,T>
     */
    private ReadableCollection&Selectable $wrapped;

    /**
     * @param ReadableCollection<TKey,T> $wrapped
     */
    public function __construct(ReadableCollection $wrapped)
    {
        if (!$wrapped instanceof Selectable) {
            throw new \InvalidArgumentException('Wrapped collection must be instance of Selectable');
        }

        $this->wrapped = $wrapped;
    }

    /**
     * @return ReadableCollection<TKey,T>&Selectable<TKey,T>
     */
    protected function getWrapped(): ReadableCollection&Selectable
    {
        return $this->wrapped;
    }
}
