<?php     

namespace BlackJew\Payments\Factory;

use BlackJew\Payments\Exceptions\RuntimeException;

class GatewayFactory 
{

	/**
    * Internal storage for all available gateways
    *
    * @var array
    */
   private $gateways = array();

   /**
    * All available gateways
    *
    * @return array An array of gateway names
    */
   public function all()
   {
       return $this->gateways;
   }

   /**
    * Replace the list of available gateways
    *
    * @param array $gateways An array of gateway names
    */
   public function replace(array $gateways)
   {
       $this->gateways = $gateways;
   }

   /**
    * Register a new gateway
    *
    * @param string $className Gateway name
    */
   public function register($className)
   {
       if (!in_array($className, $this->gateways)) {
           $this->gateways[] = $className;
       }
   }

   /**
    * Create a new gateway instance
    *
    * @param string             $class Gateway name
    * @param token|null     	$token Bearer token
    * @throws RuntimeException  If no such gateway is found
    * @return GatewayInterface  An object of class $class is created and returned
    */
   public function create($class, $token = '')
   {

       $class = get_gateway_class_name($class);

       if (!class_exists($class)) {
           throw new RuntimeException("Class '$class' not found");
       }

       return new $class();

   }

}