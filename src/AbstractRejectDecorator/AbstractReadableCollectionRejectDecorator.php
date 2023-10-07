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

use Doctrine\Common\Collections\ReadableCollection;
use Rekalogika\Collections\Decorator\RejectTrait\ReadableCollectionRejectDecoratorTrait;

/**
 * @template TKey of array-key
 * @template-covariant T
 * @implements ReadableCollection<TKey, T>
 */
abstract class AbstractReadableCollectionRejectDecorator implements ReadableCollection
{
    /**
     * @use ReadableCollectionRejectDecoratorTrait<TKey,T>
     */
    use ReadableCollectionRejectDecoratorTrait;

    /**
     * @return ReadableCollection<TKey,T>
     */
    abstract protected function getWrapped(): ReadableCollection;
}
