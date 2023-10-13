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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use PHPUnit\Framework\TestCase;
use Rekalogika\Collections\Decorator\LazyMatching\LazyMatchingCollection;
use Rekalogika\Collections\Decorator\LazyMatching\LazyMatchingReadableCollection;
use Rekalogika\Collections\Decorator\Tests\Model\Book;
use Rekalogika\Collections\Decorator\Tests\Model\BookShelf;
use Rekalogika\Collections\Decorator\Tests\Model\SelectableInterceptor;

class LazyMatchingTest extends TestCase
{
    public function testLazyMatching(): void
    {
        $bookShelf = new BookShelf();
        $firstBook = new Book('A');
        $bookShelf->set('a', $firstBook);
        $bookShelf->set('b', new Book('B'));
        $bookShelf->set('c', new Book('C'));

        $bookShelf = new SelectableInterceptor($bookShelf);

        $matchingResult1 = $bookShelf->matching(new Criteria());
        $this->assertInstanceOf(ArrayCollection::class, $matchingResult1);
        $this->assertSame(1, $bookShelf->getMatchingCount());

        $matchingResult2 = $bookShelf->matching(new Criteria());
        $this->assertInstanceOf(ArrayCollection::class, $matchingResult2);
        $this->assertSame(2, $bookShelf->getMatchingCount());

        $matchingResult3 = $bookShelf->matching(new Criteria());
        $this->assertInstanceOf(ArrayCollection::class, $matchingResult3);
        $this->assertSame(3, $bookShelf->getMatchingCount());

        $first = $matchingResult3->first();
        $this->assertSame(3, $bookShelf->getMatchingCount());
        $this->assertSame($firstBook, $first);

        // wrap

        $originalBookshelf = $bookShelf;
        $bookShelf = new LazyMatchingCollection($bookShelf);

        $matchingResult1 = $bookShelf->matching(new Criteria());
        $this->assertInstanceOf(LazyMatchingReadableCollection::class, $matchingResult1);
        $this->assertSame(3, $originalBookshelf->getMatchingCount());
        

        $matchingResult2 = $bookShelf->matching(new Criteria());
        $this->assertInstanceOf(LazyMatchingReadableCollection::class, $matchingResult2);
        $this->assertSame(3, $originalBookshelf->getMatchingCount());

        $matchingResult3 = $bookShelf->matching(new Criteria());
        $this->assertInstanceOf(LazyMatchingReadableCollection::class, $matchingResult3);
        $this->assertSame(3, $originalBookshelf->getMatchingCount());

        $first = $matchingResult3->first();
        $this->assertSame(4, $originalBookshelf->getMatchingCount());
        $this->assertSame($firstBook, $first);
    }
}
