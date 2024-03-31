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

use Rekalogika\Collections\Decorator\Decorator\SelectableCollectionDecorator;

/**
 * @extends SelectableCollectionDecorator<int|string,Book>
 */
class SliceInterceptor extends SelectableCollectionDecorator
{
    private int $sliceCount = 0;

    public function count(): int
    {
        $this->sliceCount++;
        return $this->getWrapped()->count();
    }

    public function getSliceCount(): int
    {
        return $this->sliceCount;
    }
}
