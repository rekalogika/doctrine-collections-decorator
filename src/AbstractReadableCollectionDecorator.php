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

use Doctrine\Common\Collections\ReadableCollection;
use Rekalogika\Collections\Decorator\Trait\ReadableCollectionDecoratorTrait;

/**
 * @template TKey of array-key
 * @template-covariant T
 * @implements ReadableCollection<TKey, T>
 */
abstract class AbstractReadableCollectionDecorator implements ReadableCollection
{
    /**
     * @use ReadableCollectionDecoratorTrait<TKey,T>
     */
    use ReadableCollectionDecoratorTrait;

    /**
     * @return ReadableCollection<TKey,T>
     */
    abstract protected function getWrapped(): ReadableCollection;
}
