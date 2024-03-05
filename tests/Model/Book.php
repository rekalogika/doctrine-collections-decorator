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

class Book
{
    public function __construct(
        private string $title,
        private int $numOfPages = 100,
        private string $author = 'Anonymous',
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getNumOfPages(): int
    {
        return $this->numOfPages;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }
}
