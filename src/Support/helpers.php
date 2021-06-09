<?php

use BlackJew\Payments\Interfaces\Collections;
use BlackJew\Payments\Interfaces\Transfers;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

if(!function_exists('env')) {

	function env($key, $val = '') {
		return $_ENV[$key];
	}

}


if(!function_exists('get_gateway_class_name')) {

	function get_gateway_class_name($class) {

		// If the class starts with \ or Gateway\, assume it's a Fully Qualified Class Name
        if (0 === strpos($class, '\\') || 0 === strpos($class, 'Gateway\\')) {
            return $class;
        }

        // Check if the class exists and implements the Collections and Transfers Interface, if so, it's a Fully Qualified Class Name
        if (
        	is_subclass_of('\\BlackJew\\Payments\\Providers\\'.$class, Collections::class, true) && is_subclass_of('\\BlackJew\\Payments\\Providers\\'.$class, Transfers::class, true) 
        ) {
            return '\\BlackJew\\Payments\\Providers\\'.$class;
        }

        // replace underscores with namespace marker, PSR-0 style
        $class = str_replace('_', '\\', $class);

        if (false === strpos($class, '\\')) {
            $class .= '\\';
        }

        return '\\BlackJew\\Payments\\Providers\\'.$class;

	}

}
