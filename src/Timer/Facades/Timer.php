<?php namespace Timer\Facades;

use Illuminate\Support\Facades\Facade;

class Timer extends Facade {

	/**
	 * Get the registered component.
	 *
	 * @return object
	 */
	protected static function getFacadeAccessor() { return 'timer'; }

}