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

namespace Rekalogika\Collections\Decorator\Tests;

use PHPUnit\Framework\TestCase;
use Rekalogika\Collections\Decorator\Tests\Model\Book;
use Rekalogika\Collections\Decorator\Tests\Model\BookShelf;
use Rekalogika\Collections\Decorator\ExtraLazy\ExtraLazyCollection;

class ExtraLazyTest extends TestCase
{
    public function testExtraLazy(): void
    {
        $bookShelf = new BookShelf();
        $bookShelf->set('a', new Book('A'));
        $bookShelf->set('b', new Book('B'));
        $bookShelf->set('c', new Book('C'));

        $collection = new ExtraLazyCollection($bookShelf);

        $this->expectException(\BadMethodCallException::class);

        $collection->set('d', new Book('D'));
    }
}
