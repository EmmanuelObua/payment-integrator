<?php

namespace BlackJew\Payments\Providers;

abstract class BaseProvider 
{

	protected $token;
	protected $provider;
	protected $client;

	public function __construct()
	{
	}

	abstract function loadClient($base_url = '');

	abstract function setToken($token);
	
	abstract function setProvider($provider);

	abstract function getProvider();

	abstract function headers();

	abstract function formatRequest( array $params = [] );

	abstract function sendRequest( $request_type/*POST / GET*/, $url, $request = null);

}