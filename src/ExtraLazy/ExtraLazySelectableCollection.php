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

namespace Rekalogika\Collections\Decorator\ExtraLazy;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Rekalogika\Collections\Decorator\Trait\SelectableDecoratorTrait;

/**
 * @template TKey of array-key
 * @template T
 * @extends ExtraLazyCollection<TKey,T>
 * @implements Selectable<TKey,T>
 */
class ExtraLazySelectableCollection extends ExtraLazyCollection implements Selectable
{
    /**
     * @use SelectableDecoratorTrait<TKey,T>
     */
    use SelectableDecoratorTrait;

    /**
     * @param Collection<TKey,T>&Selectable<TKey,T> $wrapped
     */
    public function __construct(private Collection&Selectable $wrapped)
    {
    }

    /**
     * @return Collection<TKey,T>&Selectable<TKey,T>
     */
    protected function getWrapped(): Collection&Selectable
    {
        return $this->wrapped;
    }
}
