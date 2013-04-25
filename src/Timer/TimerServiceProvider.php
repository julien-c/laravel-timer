<?php
namespace Timer;

use Illuminate\Support\ServiceProvider;

class TimerServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('julien-c/timer');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('timer', function()
		{
			// Let's use the Laravel start time if it is defined.
			$startTime = defined('LARAVEL_START') ? LARAVEL_START : null;
			
			return new Timer($startTime);
		});
	}
}
