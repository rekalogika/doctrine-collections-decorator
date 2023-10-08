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

use function DeepCopy\deep_copy;

/**
 * @template TKey of array-key
 * @template T
 * @extends SelectableReadableCollectionDecorator<TKey,T>
 */
class LazyMatchingReadableCollection extends SelectableReadableCollectionDecorator
{
    /**
     * @var null|(ReadableCollection<TKey,T>&Selectable<TKey,T>)
     */
    private $resultCache = null;

    /**
     * @param ReadableCollection<TKey,T> $collection
     */
    public function __construct(
        ReadableCollection $collection,
        private ?Criteria $criteria = null
    ) {
        if (!$collection instanceof Selectable) {
            throw new \InvalidArgumentException('Collection must be selectable');
        }

        parent::__construct($collection);
    }

    public function __clone()
    {
        /** @var ?Criteria */
        $copy = deep_copy($this->criteria);

        $this->criteria = $copy;
        $this->resultCache = null;
    }

    /**
     * @return ReadableCollection<TKey,T>&Selectable<TKey,T>
     */
    protected function getWrapped(): ReadableCollection&Selectable
    {
        if ($this->criteria === null) {
            return parent::getWrapped();
        } elseif ($this->resultCache !== null) {
            return $this->resultCache;
        } else {
            return $this->resultCache = parent::getWrapped()->matching($this->criteria);
        }
    }

    public function matching(Criteria $criteria): ReadableCollection&Selectable
    {
        $clone = clone $this;

        if ($clone->criteria === null) {
            $clone->criteria = $criteria;
        } else {
            $clone->criteria = CriteriaUtil::mergeCriteria($clone->criteria, $criteria);
        }

        return $clone;
    }
}
