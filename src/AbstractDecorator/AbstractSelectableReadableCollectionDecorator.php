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

namespace Rekalogika\Collections\Decorator\AbstractDecorator;

use Doctrine\Common\Collections\ReadableCollection;
use Doctrine\Common\Collections\Selectable;
use Rekalogika\Collections\Decorator\Trait\SelectableDecoratorTrait;

/**
 * @template TKey of array-key
 * @template T
 * @extends AbstractReadableCollectionDecorator<TKey, T>
 * @implements Selectable<TKey, T>
 */
abstract class AbstractSelectableReadableCollectionDecorator extends AbstractReadableCollectionDecorator implements Selectable
{
    /**
     * @use SelectableDecoratorTrait<TKey,T>
     */
    use SelectableDecoratorTrait;

    /**
     * @return ReadableCollection<TKey,T>&Selectable<TKey,T>
     */
    abstract protected function getWrapped(): ReadableCollection&Selectable;
}
