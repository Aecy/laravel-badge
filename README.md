<h1 align="center">Laravel - Badge System</h1>

<p align="center">This package helps you for create a badge, you can add a badge to an user and more...</p>

<p align="center">
<a href="https://github.com/aecy/laravel-badge/issues"><img src="https://img.shields.io/github/issues/aecy/laravel-badge.svg" alt=""></a>
<a href="https://github.com/aecy/laravel-badge/stargazers"><img src="https://img.shields.io/github/stars/aecy/laravel-badge.svg" alt=""></a>
<a href="https://github.com/aecy/laravel-badge/network"><img src="https://img.shields.io/github/forks/aecy/laravel-badge.svg" alt=""></a>
</p>

## Features

You can reward your users when they post comments on your application, you can add new badge for comments and create your badges, for example create the premium badge, ...

## Installation

### Required

- PHP 7.0 +
- Laravel 5.5 +
- Simple Comment system with column `user_id`

You can install the package using `composer` and run `vendor:publish`

```sh
$ composer require aecy/badge
```

```sh
$ php artisan vendor:publish --provider='Aecy\Badge\BadgeServiceProvider' --tag="migrations"
```

## Create Badge

Create your own badge, in `App\Events\` create `Premium.php`
if the folder `Events` doenst exist in `App` folder, create him. 
 
In the `Premium.php` copy and paste :
```php
<?php

namespace App\Events;

use App\User;

class Premium
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
```

Why i've using the `User` model in this events class, its because my Premium System its apply to an User.

Extends a class of `BadgeSubcriber.php` and add an Events Listener like this :
```php
public function subscribe ($events)
{
    parent::boot();
    $events->listen('App\Events\Premium', [$this, 'onPremium']);
}
```

and now add this function in your class which extends of `BadgeSubcriber`
```php
public function onPremium ($event)
{
    $badge = $this->badge->unlockActionFor($event->user, 'premium');
    $this->notifyBadge($event->user, $badge);
}
```

You're done !

## License

MIT
