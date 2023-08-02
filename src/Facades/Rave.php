<?php

namespace BlackJew\Rave\Facades;

use Illuminate\Support\Facades\Facade;

class Rave extends Facade
{
	/**
	 * Get the registered name of the component
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'laravelrave';
	}
}
