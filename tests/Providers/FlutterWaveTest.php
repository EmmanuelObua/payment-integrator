<?php

namespace BlackJew\Payments\Tests\Providers;

require_once __DIR__.'/../../vendor/autoload.php';

use BlackJew\Payments\Providers\BaseProvider;
use BlackJew\Payments\Gateway;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class FlutterWaveTest extends TestCase
{

	public function testItGetsFlutterWaveProviderIfTheClassIsInstantiated()
	{

		$gateway = Gateway::create('FlutterWave');

		$gateway->loadClient()->setProvider()->setToken(env('FLUTTERWAVE_SECRET_KEY'));

		$provider = $gateway->getProvider('FLUTTERWAVE');

		Assert::assertEquals('FLUTTERWAVE', $provider);

	}

	public function testHeadersReturnsAnArray()
	{

		$gateway = Gateway::create('FlutterWave');

		$gateway->loadClient()->setProvider()->setToken(env('FLUTTERWAVE_SECRET_KEY'));

		$headers = $gateway->headers();

		Assert::assertIsArray($headers);

	}

	public function testHeadersReturnsTheCorrectFormat()
	{

		$gateway = Gateway::create('FlutterWave');

		$gateway->loadClient()->setProvider()->setToken(env('FLUTTERWAVE_SECRET_KEY'));

		$headers = $gateway->headers();

		Assert::assertArrayHasKey('Content-Type', $headers);
		Assert::assertArrayHasKey('Accept', $headers);
		Assert::assertArrayHasKey('Authorization', $headers);

	}

	public function testFormatRequestReturnsAnArray()
	{

		$gateway = Gateway::create('FlutterWave');

		$gateway->loadClient()->setProvider()->setToken(env('FLUTTERWAVE_SECRET_KEY'));

		$request = $gateway->formatRequest();

		Assert::assertIsArray($request);

	}

	public function testFormatRequestReturnsTheCorrectFormat()
	{

		$gateway = Gateway::create('FlutterWave');

		$gateway->loadClient()->setProvider()->setToken(env('FLUTTERWAVE_SECRET_KEY'));

		$request = $gateway->formatRequest();

		Assert::assertArrayHasKey('headers', $request);
		Assert::assertArrayHasKey('json', $request);

	}

	public function testCheckIfCollectMethodIsCalledAndItReturnsALink()
	{

		$request = [
			"tx_ref" 			=> "hooli-tx-1920bbtytty",
			"amount" 			=> "100",
			"currency" 			=> "UGX",
			"redirect_url" 		=> "https://webhook.site/9d0b00ba-9a69-44fa-a43d-a82c33c36fdc",
			"payment_options" 	=> "mobilemoneyuganda",
			"meta" => [
				"consumer_id" 	=> 23,
				"consumer_mac" 	=> "92a3-912ba-1192a"
			],
			"customer" => [
				"email" 		=> "user@gmail.com",
				"phonenumber" 	=> "080****4528",
				"name" 			=> "Yemi Desola"
			],
			"customizations" => [
				"title" 		=> "Your company's Payments",
				"description" 	=> "Middleout isn't free. Pay the price",
				"logo" 			=> "https://assets.piedpiper.com/logo.png"
			]
		];

		$gateway = Gateway::create('FlutterWave');

		$gateway->loadClient()->setProvider()->setToken(env('FLUTTERWAVE_SECRET_KEY'));

		$response = $gateway->collect($request);

		Assert::assertObjectHasAttribute('link', $response);
		Assert::assertObjectHasAttribute('status', $response);

	}

	public function testCheckIfTransferMethodIsCalledAndItReturnsAResponse()
	{

		$request = [
			"account_bank" 		=> "MPS",
			"account_number" 	=> "256777156882",
			"amount" 			=> 5500,
			"narration" 		=> "UG MOMO",
			"currency" 			=> "UGX",
			"reference" 		=> "ugx-momo-transfer",
			"beneficiary_name" 	=> "Emmanuel Obua"
		];

		$gateway = Gateway::create('FlutterWave');

		$gateway->loadClient()->setProvider()->setToken(env('FLUTTERWAVE_SECRET_KEY'));

		$response = $gateway->transfer($request);

		Assert::assertObjectHasAttribute('status', $response);
		Assert::assertObjectHasAttribute('data', $response);

	}

	public function testItReturnsFlutterWave()
	{

		$gateway = Gateway::create('FlutterWave');

		$gateway->loadClient()->setProvider()->setToken(env('FLUTTERWAVE_SECRET_KEY'));

		Assert::assertInstanceOf(BaseProvider::class, $gateway);

	}
	
}