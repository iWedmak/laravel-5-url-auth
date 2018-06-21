# laravel-5-url-auth
Mostly for use in emails, so user can click url and get redirected with authentication.
Url in email have lifetime, in hours.
Monitors url visits reads, have event UrlVisit.
* install
```bash
composer require iwedmak/url-auth
```
* Or
```bash
php composer.phar require iwedmak/url-auth
```
* Or add to composer.json
```bash
"iwedmak/url-auth": "*"
```

Register provider, add this to config/app.php in providers array:
```php
iWedmak\UrlAuth\UrlAuthServiceProvider::class,
```
After that u will need to publish config
```bash
php artisan vendor:publish
```
and publish migrations and migrate
``` bash
php artisan urlauth:migration
php artisan migrate
```

Now you can user `urlauth($user_id, $url)` function in your blade template(or anywhere), like this:
``` bash
{{urlauth($user['id'], route('some.route'))}}
```
You can listen for `\iWedmak\UrlAuth\Events\UrlVisit` event.
in `EventServiceProvider.php` 
``` bash
protected $listen = [
    '\iWedmak\UrlAuth\Events\UrlVisit' => [
        'App\Listeners\SomeListener',
    ],
];
```

