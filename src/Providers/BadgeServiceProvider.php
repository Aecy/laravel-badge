<?php

namespace Aecy\Badge\Providers;

use Illuminate\Support\ServiceProvider;

class BadgeServiceProvider extends ServiceProvider
{
    public function boot ()
	{
		$this->loadMigrationsFrom(
			__DIR__ . '/../../database/migrations'
		);
        $this->publishes([
            __DIR__.'/../../database/migrations/' => database_path('migrations')
        ], 'migrations');
	}

	public function register ()
	{

	}
}
