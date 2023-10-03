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
use Rekalogika\Collections\Decorator\DxTrait\ArrayAccessDecoratorDxTrait;
use Rekalogika\Collections\Decorator\Trait\CollectionDecoratorTrait;

/**
 * @template TKey of array-key
 * @template T
 * @extends AbstractReadableCollectionDecorator<TKey,T>
 * @implements Collection<TKey,T>
 */
abstract class AbstractCollectionDecorator extends AbstractReadableCollectionDecorator implements Collection
{
    /**
     * @use CollectionDecoratorTrait<TKey,T>
     * @use ArrayAccessDecoratorDxTrait<TKey,T>
     */
    use CollectionDecoratorTrait, ArrayAccessDecoratorDxTrait {
        ArrayAccessDecoratorDxTrait::offsetExists insteadof CollectionDecoratorTrait;
        ArrayAccessDecoratorDxTrait::offsetGet insteadof CollectionDecoratorTrait;
        ArrayAccessDecoratorDxTrait::offsetSet insteadof CollectionDecoratorTrait;
        ArrayAccessDecoratorDxTrait::offsetUnset insteadof CollectionDecoratorTrait;
    }

    /**
     * @return Collection<TKey,T>
     */
    abstract protected function getWrapped(): Collection;
}
