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

namespace Rekalogika\Collections\Decorator\RejectTrait;

use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ReadableCollection;
use Doctrine\Common\Collections\Selectable;

/**
 * @template TKey of array-key
 * @template T
 */
trait SelectableRejectDecoratorTrait
{
    /**
     * @return Selectable<TKey,T>
     */
    abstract protected function getWrapped(): Selectable;

    /**
     * @return ReadableCollection<TKey,T>&Selectable<TKey,T>
     */
    public function matching(Criteria $criteria): ReadableCollection&Selectable
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }
}
