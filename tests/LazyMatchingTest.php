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
use Doctrine\Common\Collections\Order;
use PHPUnit\Framework\TestCase;
use Rekalogika\Collections\Decorator\LazyMatching\LazyMatchingCollection;
use Rekalogika\Collections\Decorator\LazyMatching\LazyMatchingReadableCollection;
use Rekalogika\Collections\Decorator\Tests\Model\Book;
use Rekalogika\Collections\Decorator\Tests\Model\BookShelf;
use Rekalogika\Collections\Decorator\Tests\Model\SelectableInterceptor;
use Rekalogika\Collections\Decorator\Tests\Model\SliceInterceptor;

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

    public function testCriteria(): void
    {
        $bookshelf = new BookShelf();
        $bookshelf->set('a', new Book('A', 100, 'Author A'));
        $bookshelf->set('b', new Book('B', 200, 'Author B'));
        $bookshelf->set('c', new Book('C', 300, 'Author C'));
        $bookshelf->set('d', new Book('D', 50, 'Author C'));
        $bookshelf->set('e', new Book('E', 20, 'Author C'));
        $bookshelf->set('f', new Book('F', 500, 'Author C'));

        $bookshelf = new LazyMatchingCollection($bookshelf);

        $criteria1 = Criteria::create()
            ->where(Criteria::expr()->eq('author', 'Author C'));

        $result = $bookshelf->matching($criteria1);
        $this->assertEquals(
            [
                'c' => new Book('C', 300, 'Author C'),
                'd' => new Book('D', 50, 'Author C'),
                'e' => new Book('E', 20, 'Author C'),
                'f' => new Book('F', 500, 'Author C')
            ],
            $result->toArray()
        );

        $criteria2 = Criteria::create()
            ->where(Criteria::expr()->gt('numOfPages', 60));

        $result = $result->matching($criteria2);
        $this->assertEquals(
            [
                'c' => new Book('C', 300, 'Author C'),
                'f' => new Book('F', 500, 'Author C')
            ],
            $result->toArray()
        );

        $criteria3 = Criteria::create()
            ->where(Criteria::expr()->contains('title', 'C'));

        $result = $result->matching($criteria3);
        $this->assertEquals(
            [
                'c' => new Book('C', 300, 'Author C')
            ],
            $result->toArray()
        );
    }

    public function testSlice(): void
    {
        $bookshelf = new BookShelf();
        $bookshelf->set('a', new Book('A', 100, 'Author A'));
        $bookshelf->set('b', new Book('B', 200, 'Author B'));
        $bookshelf->set('c', new Book('C', 300, 'Author C'));
        $bookshelf->set('d', new Book('D', 50, 'Author C'));
        $bookshelf->set('e', new Book('E', 20, 'Author C'));
        $bookshelf->set('f', new Book('F', 500, 'Author C'));

        $bookshelf = new SliceInterceptor($bookshelf);
        $realBookShelf = $bookshelf;

        $bookshelf = new LazyMatchingCollection($bookshelf);
        $criteria = Criteria::create()
            ->where(Criteria::expr()->gt('numOfPages', 60));

        $filtered = $bookshelf->matching($criteria);
        $count = $filtered->count();
        $this->assertSame(4, $count);

        $sliced = $filtered->slice(1, 2);
        $this->assertEquals(
            [
                'b' => new Book('B', 200, 'Author B'),
                'c' => new Book('C', 300, 'Author C'),
            ],
            $sliced
        );

        $this->assertEquals(0, $realBookShelf->getSliceCount());
    }
}
