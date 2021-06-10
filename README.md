# DOCUMENTATIONS

# Available providers

| Index | Provider |
| ----------- | ----------- |
|1|FlutterWave|

---

# Usage for FlutterWave provider

> Collect payment

```php

use BlackJew\Payments\Gateway;

$gateway = Gateway::create('FlutterWave');

$gateway->loadClient()->setProvider()->setToken('passin secondary api key for flutterwave');

/*Collect payments*/

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
		"title" 			=> "Your company's Payments",
		"description" 	=> "Middleout isn't free. Pay the price",
		"logo" 			=> "https://assets.piedpiper.com/logo.png"
	]
];

// This returns a checkout link to complete payments

$response = $gateway->collect($request);

print_r($response);

if ($response->status == true) {
	header('location:'.$response->link);
} else {
	return;
}

/*After this verify transaction ...*/

```

> Transfer payment

```php

use BlackJew\Payments\Gateway;

$gateway = Gateway::create('FlutterWave');

$gateway->loadClient()->setProvider()->setToken('passin secondary api key for flutterwave');

/*Transfer payments*/

$request = [
	"account_bank" 		=> "MPS",
	"account_number" 	=> "2567XXXXXXXX",
	"amount" 			=> 5500,
	"narration" 		=> "UG MOMO",
	"currency" 			=> "UGX",
	"reference" 		=> "ugx-momo-transfer",
	"beneficiary_name" 	=> "Emmanuel Obua"
];

// This returns a checkout link to complete payments

$response = $gateway->transfer($request);

print_r($response);

/**
 * Response will look like below
 */

{
	"status": "success",
	"message": "Transfer Queued Successfully",
	"data": {
		"id": 127894,
		"account_number": "2567XXXXXXXX",
		"bank_code": "MPS",
		"full_name": "Emmanuel Obua",
		"created_at": "2020-06-25T14:39:16.000Z",
		"currency": "UGX",
		"amount": 5500,
		"fee": 500,
		"status": "NEW",
		"reference": "ugx-momo-transfer",
		"meta": null,
		"narration": "UGX momo transfer",
		"complete_message": "",
		"requires_approval": 0,
		"is_approved": 1,
		"bank_name": "FA-BANK"
	}
}

/*After this, verify transaction ...*/

```

> Transaction verification

```php

/**
 * After payment processing on the flutterwave UI, 
 * a callback is sent back to the callback uri preset in flutterwave dashboard.
 * 1. Get the tx_ref from the callback response object.
 * 2. Verify the transaction from the callback before updating your backend
 * 3. Update the affected tables with the confirmed transaction.
*/

$transactionId = $callback_response->tx_ref;

$response = $gateway->verifyTransaction($transactionId);

print_r($response);

/**
 * Transaction verification response will look like below
 */

{
	"status": "success",
	"message": "Transaction fetched successfully",
	"data": {
		"id": 1163068,
		"tx_ref": "akhlm-pstmn-blkchrge-xx6",
		"flw_ref": "FLW-M03K-02c21a8095c7e064b8b9714db834080b",
		"device_fingerprint": "N/A",
		"amount": 3000,
		"currency": "NGN",
		"charged_amount": 3000,
		"app_fee": 1000,
		"merchant_fee": 0,
		"processor_response": "Approved",
		"auth_model": "noauth",
		"ip": "pstmn",
		"narration": "Kendrick Graham",
		"status": "successful",
		"payment_type": "card",
		"created_at": "2020-03-11T19:22:07.000Z",
		"account_id": 73362,
		"amount_settled": 2000,
		"customer": {
			"id": 252759,
			"name": "Kendrick Graham",
			"phone_number": "0813XXXXXXX",
			"email": "user@example.com",
			"created_at": "2020-01-15T13:26:24.000Z"
		}
	}
}

```

