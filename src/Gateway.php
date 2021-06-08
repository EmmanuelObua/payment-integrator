<?php

namespace BlackJew\Payments;

use BlackJew\Payments\Factory\GatewayFactory;

class Gateway {


	/**
     * Internal factory storage
     *
     * @var GatewayFactory
     */
	private static $factory;

    /**
     * Get the gateway factory
     *
     * Creates a new empty GatewayFactory if none has been set previously.
     *
     * @return GatewayFactory A GatewayFactory instance
     */
    public static function getFactory()
    {
    	if (is_null(self::$factory)) {
    		self::$factory = new GatewayFactory;
    	}

    	return self::$factory;
    }

    /**
     * Set the gateway factory
     *
     * @param GatewayFactory $factory A GatewayFactory instance
     */
    public static function setFactory(GatewayFactory $factory = null)
    {
    	self::$factory = $factory;
    }

    /**
     * Static function call router.
     *
     * All other function calls to the Getway class are routed to the
     * factory.  e.g. Getway::create('FlutterWave') is routed to the
     * factory's create method and passed the parameters FlutterWave.
     *
     * Example:
     *
     * <code>
     *   // Create a gateway for the FlutterWave
     *   $gateway = Getway::create('FlutterWave');
     * </code>
     *
     * @see GatewayFactory
     *
     * @param string $method     The factory method to invoke.
     * @param array  $parameters Parameters passed to the factory method.
     *
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {

    	$factory = self::getFactory();

    	return call_user_func_array(array($factory, $method), $parameters);

    }

}