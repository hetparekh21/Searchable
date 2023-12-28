# hetparekh21/Searchable

Effortlessly add search functionality to your Laravel models.

## Installation

1. Install the package via Composer:

```bash
composer require hetparekh21/searchable
```

## Usage

1. Use the `Searchable` trait in your model:

```php
use hetparekh21\searchable\Searchable;

class User extends Model
{
    use Searchable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone'
    ];

    protected $guarded = ['id'];

    protected $except = ['phone'];

    protected $useGuarded = false;

}
```

2. Perform searches using the `scopeSearch` method:

```php
$users = User::search('John Doe')->get();
```

3. Search Paginated, As easy as laravel default queries

```php
$users = User::search('John Doe')->paginate(10);
```

## Configuration

- **`except` property:** Exclude specific columns from the search (optional).
- **`useGuarded` property:** Include guarded attributes in the search (optional).

## Contributing

Anyone is welcome to contribute. Fork, make your changes, and then submit a pull request.

## License
Searchable is open-sourced software licensed under the MIT license: LICENSE.
