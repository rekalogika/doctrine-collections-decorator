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

use Doctrine\Common\Collections\ReadableCollection;
use Doctrine\Common\Collections\Selectable;
use Rekalogika\Collections\Decorator\Trait\SelectableDecoratorTrait;

/**
 * @template TKey of array-key
 * @template T
 * @extends ExtraLazyReadableCollection<TKey,T>
 * @implements Selectable<TKey,T>
 */
class ExtraLazySelectableReadableCollection extends ExtraLazyReadableCollection implements Selectable
{
    /**
     * @use SelectableDecoratorTrait<TKey,T>
     */
    use SelectableDecoratorTrait;

    /**
     * @param ReadableCollection<TKey,T>&Selectable<TKey,T> $wrapped
     */
    public function __construct(private ReadableCollection&Selectable $wrapped)
    {
    }

    /**
     * @return ReadableCollection<TKey,T>&Selectable<TKey,T>
     */
    protected function getWrapped(): ReadableCollection&Selectable
    {
        return $this->wrapped;
    }
}
