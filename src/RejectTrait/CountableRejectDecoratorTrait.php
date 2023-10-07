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

trait CountableRejectDecoratorTrait
{
    abstract protected function getWrapped(): \Countable;

    public function count(): int
    {
        throw new \BadMethodCallException(sprintf('Method %s is disabled', __METHOD__));
    }
}
