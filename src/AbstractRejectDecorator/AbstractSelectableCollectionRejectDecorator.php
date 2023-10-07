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

namespace Rekalogika\Collections\Decorator\AbstractRejectDecorator;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Rekalogika\Collections\Decorator\RejectTrait\SelectableRejectDecoratorTrait;

/**
 * @template TKey of array-key
 * @template T
 * @extends AbstractCollectionRejectDecorator<TKey, T>
 * @implements Selectable<TKey, T>
 */
abstract class AbstractSelectableCollectionRejectDecorator extends AbstractCollectionRejectDecorator implements Selectable
{
    /**
     * @use SelectableRejectDecoratorTrait<TKey,T>
     */
    use SelectableRejectDecoratorTrait;

    /**
     * @return Collection<TKey,T>&Selectable<TKey,T>
     */
    abstract protected function getWrapped(): Collection&Selectable;
}
