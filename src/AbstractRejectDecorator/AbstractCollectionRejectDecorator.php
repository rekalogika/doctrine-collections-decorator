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
use Rekalogika\Collections\Decorator\DxTrait\ArrayAccessDecoratorDxTrait;
use Rekalogika\Collections\Decorator\RejectTrait\CollectionRejectDecoratorTrait;

/**
 * @template TKey of array-key
 * @template T
 * @extends AbstractReadableCollectionRejectDecorator<TKey,T>
 * @implements Collection<TKey,T>
 */
abstract class AbstractCollectionRejectDecorator extends AbstractReadableCollectionRejectDecorator implements Collection
{
    /**
     * @use CollectionRejectDecoratorTrait<TKey,T>
     * @use ArrayAccessDecoratorDxTrait<TKey,T>
     */
    use CollectionRejectDecoratorTrait, ArrayAccessDecoratorDxTrait {
        ArrayAccessDecoratorDxTrait::offsetExists insteadof CollectionRejectDecoratorTrait;
        ArrayAccessDecoratorDxTrait::offsetGet insteadof CollectionRejectDecoratorTrait;
        ArrayAccessDecoratorDxTrait::offsetSet insteadof CollectionRejectDecoratorTrait;
        ArrayAccessDecoratorDxTrait::offsetUnset insteadof CollectionRejectDecoratorTrait;
    }

    /**
     * @return Collection<TKey,T>
     */
    abstract protected function getWrapped(): Collection;
}
