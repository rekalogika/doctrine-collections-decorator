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
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ReadableCollection;
use Doctrine\Common\Collections\Selectable;
use PHPUnit\Framework\TestCase;
use Rekalogika\Collections\Decorator\Tests\Model\MySelectableCollectionDecorator;

class CollectionDecoratorTest extends TestCase
{
    public function testCollectionDecorator(): void
    {
        $collection = new MySelectableCollectionDecorator(new ArrayCollection());
        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertInstanceOf(Selectable::class, $collection);
        $this->assertInstanceOf(ReadableCollection::class, $collection);
        $this->assertInstanceOf(\ArrayAccess::class, $collection);
        $this->assertInstanceOf(\Traversable::class, $collection);
        $this->assertInstanceOf(\Countable::class, $collection);

        $this->assertCount(0, $collection);
        $this->assertFalse(isset($collection[0]));
        $this->assertFalse(isset($collection['foo']));

        $collection['bar'] = 'baz';

        $this->assertCount(1, $collection);
        $this->assertTrue(isset($collection['bar']));
        $this->assertEquals('baz', $collection['bar']);

        unset($collection['bar']);

        $this->assertCount(0, $collection);
        $this->assertFalse(isset($collection['bar']));

        $collection->add('foo');

        $this->assertCount(1, $collection);
        $this->assertTrue(isset($collection[0]));
        $this->assertEquals('foo', $collection[0]);

        $collection->removeElement('foo');

        $this->assertCount(0, $collection);
        $this->assertFalse(isset($collection[0]));
    }
}
