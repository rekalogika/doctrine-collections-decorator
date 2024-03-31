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

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ReadableCollection;
use Doctrine\Common\Collections\Selectable;
use PHPUnit\Framework\TestCase;
use Rekalogika\Collections\Decorator\Decorator\CollectionDecorator;
use Rekalogika\Collections\Decorator\Decorator\ReadableCollectionDecorator;
use Rekalogika\Collections\Decorator\Decorator\SelectableCollectionDecorator;
use Rekalogika\Collections\Decorator\Decorator\SelectableReadableCollectionDecorator;
use Rekalogika\Collections\Decorator\Tests\Model\Book;
use Rekalogika\Collections\Decorator\Tests\Model\BookShelf;

class CollectionDecoratorTest extends TestCase
{
    /**
     * @return iterable<array-key,array<array-key,object>>
     */
    public static function collectionProvider(): iterable
    {
        $bookShelf = new BookShelf();
        $bookShelf->set('a', new Book('A'));
        $bookShelf->set('b', new Book('B'));
        $bookShelf->set('c', new Book('C'));

        yield [$bookShelf];
        yield [new CollectionDecorator($bookShelf)];
        yield [new ReadableCollectionDecorator($bookShelf)];
        yield [new SelectableReadableCollectionDecorator($bookShelf)];
        yield [new SelectableCollectionDecorator($bookShelf)];
    }

    /**
     * @dataProvider collectionProvider
     */
    public function testObject(object $collection): void
    {
        if ($collection instanceof Selectable) {
            $this->testSelectable($collection);
        }

        if ($collection instanceof Collection) {
            $this->testCollection($collection);
        } elseif ($collection instanceof ReadableCollection) {
            $this->testReadableCollection($collection);
        } else {
            throw new \Exception('Unknown type');
        }
    }

    /**
     * @param Selectable<array-key,mixed> $selectable
     */
    private function testSelectable(Selectable $selectable): void
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('title', 'A'));

        $result = $selectable->matching($criteria);

        $this->assertInstanceOf(ReadableCollection::class, $result);

        $this->assertCount(1, $result);
        $first = $result->first();
        $this->assertInstanceOf(Book::class, $first);
        $this->assertEquals('A', $first->getTitle());
    }

    /**
     * @param Collection<array-key,mixed> $collection
     */
    private function testCollection(Collection $collection): void
    {
        $this->testArrayAccess($collection);
        $this->testReadableCollection($collection);
    }

    /**
     * @param ReadableCollection<array-key,mixed> $collection
     */
    private function testReadableCollection(ReadableCollection $collection): void
    {
        $this->testCountable($collection);
        $this->testTraversable($collection);
    }

    private function testArrayAccess(mixed $collection): void
    {
        $this->assertInstanceOf(\ArrayAccess::class, $collection);

        $newBook = new Book('Foo');
        $collection['foo'] = $newBook;

        $this->assertTrue(isset($collection['foo']));

        $book = $collection['foo'];
        $this->assertSame($newBook, $book);

        unset($collection['foo']);
        $this->assertFalse(isset($collection['foo']));
    }

    private function testCountable(mixed $collection): void
    {
        $this->assertInstanceOf(\Countable::class, $collection);

        $count1 = count($collection);
        $count2 = $collection->count();
        $this->assertEquals($count1, $count2);
        $this->assertEquals($count1, 3);
    }

    private function testTraversable(mixed $collection): void
    {
        $this->assertInstanceOf(\Traversable::class, $collection);

        $i = 0;
        foreach ($collection as $book) {
            $this->assertInstanceOf(Book::class, $book);
            $i++;
        }

        $this->assertEquals($i, 3);
    }
}
