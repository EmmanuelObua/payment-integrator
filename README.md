# FLUTTER DOCUMENTATIONS

```php

/**
 * Request params to pass to the collect method ... 
 * It would return an object with a link property
*/

$request = [
	"tx_ref" 			=> "hooli-tx-1920bbtytty",
	"amount" 			=> "100",
	"currency" 			=> "NGN",
	"redirect_url" 		=> "https://webhook.site/9d0b00ba-9a69-44fa-a43d-a82c33c36fdc",
	"payment_options" 	=> "card",
	"meta" => [
	   "consumer_id" 	=> 23,
	   "consumer_mac" 	=> "92a3-912ba-1192a"
	],
	"customer" => [
	   "email" 			=> "user@gmail.com",
	   "phonenumber" 	=> "080****4528",
	   "name" 			=> "Yemi Desola"
	],
	"customizations" => [
	   "title" 			=> "Crowdlending Payments",
	   "description" 	=> "Middleout isn't free. Pay the price",
	   "logo" 			=> "https://assets.piedpiper.com/logo.png"
	]
]

public function collect(array $request) 
{

}

```

