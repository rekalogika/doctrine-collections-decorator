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

namespace Rekalogika\Collections\Decorator\LazyMatching;

use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ReadableCollection;
use Doctrine\Common\Collections\Selectable;
use Rekalogika\Collections\Decorator\Decorator\SelectableReadableCollectionDecorator;

/**
 * @template TKey of array-key
 * @template T
 * @extends SelectableReadableCollectionDecorator<TKey,T>
 *
 * @internal
 */
class LazyMatchingReadableCollectionFromSelectable extends SelectableReadableCollectionDecorator
{
    /**
     * @var ReadableCollection<TKey,T>&Selectable<TKey,T>
     */
    private null|(ReadableCollection&Selectable) $resultCache = null;

    /**
     * @param Selectable<TKey,T> $selectable
     */
    public function __construct(
        private Selectable $selectable,
        private Criteria $criteria
    ) {
    }

    public function __clone()
    {
        $this->criteria = clone $this->criteria;
        $this->resultCache = null;
    }

    protected function getWrapped(): ReadableCollection&Selectable
    {
        if ($this->resultCache !== null) {
            return $this->resultCache;
        }

        return $this->resultCache = $this->selectable->matching($this->criteria);
    }

    public function matching(Criteria $criteria): ReadableCollection&Selectable
    {
        $clone = clone $this;
        $clone->criteria = CriteriaUtil::mergeCriteria($clone->criteria, $criteria);

        return $clone;
    }

    public function slice(int $offset, ?int $length = null): array
    {
        $criteria = (clone $this->criteria)
            ->setFirstResult($offset)
            ->setMaxResults($length);

        return $this->matching($criteria)->toArray();
    }
}
