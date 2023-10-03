# rekalogika/doctrine-collections-decorator

Lets you easily create decorator classes to dynamically modify the behaviors of
Doctrine Collection objects, including the collection objects used by Doctrine
ORM in your entities.

## Synopsis

The decorator class extending one of our abstract classes:

```php
use Doctrine\Common\Collections\Collection;
use Rekalogika\Collections\Decorator\AbstractCollectionDecorator;

/**
 * @extends AbstractCollectionDecorator<array-key,Book>
 */
class BookCollection extends AbstractCollectionDecorator
{
    /**
     * @param Collection<array-key,Book> $collection
     */
    public function __construct(private Collection $collection)
    {
    }

    protected function getWrapped(): Collection
    {
        return $this->collection;
    }

    // add and override methods here:
    // ...
}
```

The usage in an entity:

```php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class BookShelf
{
    /**
     * @var Collection<array-key,Book>
     */
    #[ORM\OneToMany(targetEntity: Book::class)]
    private Collection $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getBooks(): BookCollection
    {
        return new BookCollection($this->bookskkk);
    }
}
```

## Documentation

[rekalogika.dev/doctrine-collections-decorator](https://rekalogika.dev/doctrine-collections-decorator)

## License

MIT

## Contributing

Issues and pull requests should be filed in the GitHub repository
[rekalogika/doctrine-collections-decorator](https://github.com/rekalogika/doctrine-collections-decorator).