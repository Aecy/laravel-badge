# Laravel - Badge

- Add the trait `Badgeable` to your `User` model.
- Add the code below in the `EventServiceProvider` :

```php
protected $subscribe = [
	BadgeSubcriber::class
];
```
