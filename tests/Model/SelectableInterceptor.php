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

namespace Rekalogika\Collections\Decorator\Tests\Model;

use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ReadableCollection;
use Doctrine\Common\Collections\Selectable;
use Rekalogika\Collections\Decorator\Decorator\SelectableCollectionDecorator;

/**
 * @extends SelectableCollectionDecorator<int|string,Book>
 */
class SelectableInterceptor extends SelectableCollectionDecorator
{
    private int $matchingCount = 0;

    public function matching(Criteria $criteria): ReadableCollection&Selectable
    {
        $this->matchingCount++;
        return $this->getWrapped()->matching($criteria);
    }

    public function getMatchingCount(): int
    {
        return $this->matchingCount;
    }
}
