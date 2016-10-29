# Catagger

Creating types for Item on your Laravel App.

## Installation

This package requires [Laravel 5.3][laravel-install-link] to install.

In order to install Catagger, just enter on your terminal

```bash
$ composer require redustudio/catagger
```

After installed,  add the ServiceProvider to the providers array in `config/app.php`

```php
Redustudio\Catagger\ServiceProvider::class,
```

## Usage

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
```

```php
$category = 'Programming';
Catagger::sync($category, $post->categories());

$tags = ['PHP', 'Laravel', 'Package'];
Catagger::sync($tags, $post->tags());

$genres = ['Action', 'Adventure', 'Sci-Fi'];
Catagger::sync($genres, $movie->genres());
```

## About ReduStudio

[ReduStudio][homepage] is web development freelancers based in Yogyakarta and East Borneo, Indonesia. We specialise in developing websites and web apps with Laravel, the most popular PHP Framework.

### Let's Start Project With Us

Just Contact Us At:
- Email: [redustudio@gmail.com][mailto]
- Facebook: [ReduStudio's FB Page][fbpage]

## License
The [MIT][mitlink] License (MIT). Please see [License File](LICENSE.md) for more information.


[laravel-install-link]: https://laravel.com/docs/5.3#installation
[screenshot]: admin.png
[homepage]: http://redustudio.com/
[mailto]: mailto:redustudio@gmail.com
[fbpage]: https://www.facebook.com/Redustudio/
[mitlink]: http://opensource.org/licenses/MIT
