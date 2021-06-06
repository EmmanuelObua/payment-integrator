<?php

namespace BlackJew\Payments;

use BlackJew\Payments\Common\GatewayFactory;
use BlackJew\Payments\Common\Http\ClientInterface;

/**
 * Application class
 *
 * Provides static access to the gateway factory methods.  This is the
 * recommended route for creation and establishment of payment gateway
 * objects via the standard GatewayFactory.
 * 
 * @see \BlackJew\Payments\Common\GatewayFactory
 */
class Application
{

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
     * All other function calls to the Application class are routed to the
     * factory.  e.g. Application::getSupportedGateways(1, 2, 3, 4) is routed to the
     * factory's getSupportedGateways method and passed the parameters 1, 2, 3, 4.
     *
     * Example:
     *
     * <code>
     *   // Create a gateway for the PayPal ExpressGateway
     *   $gateway = Application::create('ExpressGateway');
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