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

namespace Rekalogika\Collections\Decorator\Trait;

/**
 * @template TKey
 * @template-covariant T
 */
trait IteratorAggregateDecoratorTrait
{
    /**
     * @return \IteratorAggregate<TKey,T>
     */
    abstract protected function getWrapped(): \IteratorAggregate;

    /**
     * @return \Traversable<TKey,T>
     */
    public function getIterator(): \Traversable
    {
        return $this->getWrapped()->getIterator();
    }
}
