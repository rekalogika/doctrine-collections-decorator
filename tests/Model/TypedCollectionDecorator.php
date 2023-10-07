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
use Rekalogika\Collections\Decorator\AbstractDecorator\AbstractCollectionDecorator;

/**
 * @extends AbstractCollectionDecorator<array-key,Book>
 */
class TypedCollectionDecorator extends AbstractCollectionDecorator
{
    /**
     * @param Collection<array-key,Book> $wrapped
     */
    public function __construct(private Collection $wrapped)
    {
    }

    protected function getWrapped(): Collection
    {
        return $this->wrapped;
    }

    private static function ensure(mixed $book): Book
    {
        if (!$book instanceof Book) {
            throw new \InvalidArgumentException('Invalid input');
        }

        return $book;
    }

    public function add(mixed $element): void
    {
        $this->getWrapped()->add(self::ensure($element));
    }

    public function set(string|int $key, mixed $value): void
    {
        $this->getWrapped()->set($key, self::ensure($value));
    }
}
