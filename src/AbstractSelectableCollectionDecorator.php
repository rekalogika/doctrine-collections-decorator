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

namespace Rekalogika\Collections\Decorator;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Rekalogika\Collections\Decorator\Trait\SelectableDecoratorTrait;

/**
 * @template TKey of array-key
 * @template T
 * @extends AbstractCollectionDecorator<TKey, T>
 * @implements Selectable<TKey, T>
 */
abstract class AbstractSelectableCollectionDecorator extends AbstractCollectionDecorator implements Selectable
{
    /**
     * @use SelectableDecoratorTrait<TKey,T>
     */
    use SelectableDecoratorTrait;

    /**
     * @return Collection<TKey,T>&Selectable<TKey,T>
     */
    abstract protected function getWrapped(): Collection&Selectable;
}
