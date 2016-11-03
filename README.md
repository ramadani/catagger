# Catagger

Simple way to creating types for item on your Laravel App, such as category and tag for article or product, genre for movie, skill for user, etc.

## Installation

In order to install Catagger, just enter on your terminal

```bash
$ composer require redustudio/catagger
```

In `config/app.php` file, add

```php
Redustudio\Catagger\ServiceProvider::class,
```

in the `providers` array and

```php
'Catagger' => Redustudio\Catagger\Facade::class,
```

to the `aliases` array.

If you are not using Laravel 5.3, run this command for publishing migration.

```bash
$ php artisan vendor:publish --provider="Redustudio\Catagger\ServiceProvider" --tag="migrations"
```

then

```bash
$ php artisan migrate
```

for migration catagger tables.

## Usage

#### Attaching to Item

```php
// Post
use Redustudio\Catagger\CataggerTrait;

class Post extends Model
{
    use CataggerTrait;

    public function categories()
    {
        return $this->cataggers('category');
    }

    public function tags()
    {
        return $this->cataggers('tag');
    }
}

$category = 'Programming';
Catagger::sync($post->categories(), $category);

$tags = ['PHP', 'Laravel', 'Package'];
Catagger::sync($post->tags(), $tags);

```

```php
// Movie
use Redustudio\Catagger\CataggerTrait;

class Movie extends Model
{
    use CataggerTrait;

    public function genres()
    {
        return $this->cataggers('genre');
    }
}

$genres = ['Action', 'Adventure', 'Sci-Fi'];
Catagger::sync($movie->genres(), $genres);
```

#### Detaching from Item

```php
$genres = ['Action', 'Adventure', 'Sci-Fi'];
Catagger::sync($movie->genres(), $genres);

$genres = ['Action', 'Sci-Fi'];
Catagger::detach($movie->genres(), $genres); // detaching 'Action' and `Sci-Fi`

// detaching all genres
Catagger::detach($movie->genres());
```

## Todo

- [ ] Unit Test

## About ReduStudio

[ReduStudio][homepage] is web development freelancers based in Yogyakarta and East Borneo, Indonesia. We specialise in developing websites and web apps with Laravel, the most popular PHP Framework.

### Let's Start Project With Us

Just Contact Us At:
- Email: [redustudio@gmail.com][mailto]
- Facebook: [ReduStudio's FB Page][fbpage]

## License
The [MIT][mitlink] License (MIT). Please see [License File](LICENSE.md) for more information.


[screenshot]: admin.png
[homepage]: http://redustudio.com/
[mailto]: mailto:redustudio@gmail.com
[fbpage]: https://www.facebook.com/Redustudio/
[mitlink]: http://opensource.org/licenses/MIT
