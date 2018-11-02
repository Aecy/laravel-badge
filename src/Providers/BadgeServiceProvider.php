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
	}

	public function register ()
	{

	}
}