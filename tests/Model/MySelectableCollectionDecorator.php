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

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Rekalogika\Collections\Decorator\AbstractSelectableCollectionDecorator;

/**
 * @extends AbstractSelectableCollectionDecorator<array-key,string>
 */
class MySelectableCollectionDecorator extends AbstractSelectableCollectionDecorator
{
    /**
     * @param Collection<array-key,string>&Selectable<array-key,string> $wrapped
     */
    public function __construct(private Collection&Selectable $wrapped)
    {
    }

    protected function getWrapped(): Collection&Selectable
    {
        return $this->wrapped;
    }
}
