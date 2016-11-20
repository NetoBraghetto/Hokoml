Hokoml
===================
Package to simplify the communication between the Mercado livre API and your app.

----------

# Table of Contents

- [Installation](#installation)
- [Configurations](#configs)
- [Authentication](#authentication)
	- [Get auth url](#get-auth-url)
	- [Authorize](#authorize)
- [Product](#product)
	- [Create](#create)
	- [Find](#find)
	- [Update](#update)
	- [Pause](#pause)
	- [Unpause](#unpause)
	- [Finalize](#finalize)
	- [Relist](#relist)
	- [Delete](#delete)
- [Category](#category)
	- [List](#list)
	- [Predict](#predict)
- [Questions](#fakerprovideruuid)
	- [Ask](#ask)
	- [Find](#find)
	- [Answer](#answer)
	- [Questions from product](#questions-from-product)
	- [Unanswered from product](#unanswered-from-product)
	- [Block user](#block-user)
	- [Unblock user](#unblock-user)
	- [Blocked users](#blocked-users)
	- [Received questions](#received-questions)
- [License](#license)

## Installation

```sh
composer require braghetto/hokoml
```

## Usage

### Configs
```php
<?php
$config = [
    /**
    * Get app_id, secret_key and redirect_uri in te ML application manager (http://applications.mercadolibre.com/)
    */
    'app_id' => 'YOUR_APP_ID',

    'secret_key' => 'YOUR_SECRET_KEY',

    'redirect_uri' => 'YOUR_REDIRECT_URI',

    'production' => false,

    /**
    * The ML code for your country
    *
    * MLA => Argentina
    * MBO => Bolivia
    * MLB => Brazil
    * MLC => Chile
    * MCO => Colombia
    * MCR => Costa Rica
    * MCU => Cuba
    * MRD => Dominican Republic
    * MEC => Ecuador
    * MGT => Guatemala
    * MHN => Honduras
    * MLM => Mexico
    * MNI => Nicaragua
    * MPA => Panama
    * MPY => Paraguay
    * MPE => Peru
    * MPT => Portugal
    * MSV => Salvador
    * MLU => Uruguay
    * MLV => Venezuela
    */
    'country' => 'YOUR_COUNTRY_CODE'
]
```

### Authentication
#### Get auth url
Retrive the auth to authorize your app.
```php
<?php
use Braghetto\Hokoml\Hokoml;

$hokoml = new Hokoml($config);
$url = $hokoml->getAuthUrl();
```

#### Authorize
Once you have the code retrive the access token, user id, expiration and a refresh token.
```php
<?php
use Braghetto\Hokoml\Hokoml;

$hokoml = new Hokoml($config);
$response = $hokoml->authorize($_GET['code']);
// Persist the data for future usage...
```

### Product

#### Create

```php
<?php
use Braghetto\Hokoml\Hokoml;

$hokoml = new Hokoml($config, $_SESSION['access_token'], $_SESSION['user_id']);
$response = $hokoml->product()->create([
    'title' => 'TESTE RAY BAN',
    'category_id' => 'MLB1227',
    'price' => 900000,
    'currency_id' => 'BRL',
    'available_quantity' => 1,
    'buying_mode' => 'buy_it_now',
    'listing_type_id' => 'free',
    'automatic_relist' => false,
    'condition' => 'new',
    'description' => 'Item:, <strong> Ray-Ban WAYFARER Gloss Black RB2140 901 </strong> Model: RB2140. Size: 50mm. Name: WAYFARER. Color: Gloss Black. Includes Ray-Ban Carrying Case and Cleaning Cloth. New in Box',
    'warranty' => '12 month by Ray Ban',
    'pictures' => [
        ['source' => 'https://upload.wikimedia.org/wikipedia/commons/f/fd/Ray_Ban_Original_Wayfarer.jpg'],
        ['source' => 'https://upload.wikimedia.org/wikipedia/commons/a/ab/Teashades.gif']
    ]
]);
```

#### Find
```php
<?php
use Braghetto\Hokoml\Hokoml;

$hokoml = new Hokoml($config, $_SESSION['access_token'], $_SESSION['user_id']);
$response = $hokoml->product()->find($product_id);
```

#### Update
```php
<?php
// [...]
$response = $hokoml->product()->update($product_id, [
    'title' => 'Milibin',
    'price' => 800000,
    // [...]
]);
```

#### Pause
```php
<?php
// [...]
$response = $hokoml->product()->pause($product_id);
```

#### Unpause
```php
<?php
// [...]
$response = $hokoml->product()->unpause($product_id);
```

#### Finalize
```php
<?php
// [...]
$response = $hokoml->product()->finalize($product_id);
```

#### Relist
```php
<?php
// [...]
$response = $hokoml->product()->relist($product_id, $price);
// $response = $hokoml->product()->relist($product_id, $price, $quantity = 1, $listing_type = 'free');
```

#### Delete
```php
<?php
// [...]
$response = $hokoml->product()->delete($product_id);
```

### Category

#### List
```php
<?php
use Braghetto\Hokoml\Hokoml;

$hokoml = new Hokoml($config);
// List all root categories
$response = $hokoml->category()->list();

// List children categories for a given id.
$response = $hokoml->category()->list($parent_category_id);
```

#### Predict
Predict a category for a given title.
```php
<?php
// [...]
$response = $hokoml->category()->predict('Rayban Gloss Black');
```

### Questions

#### Ask
```php
<?php
use Braghetto\Hokoml\Hokoml;

$hokoml = new Hokoml($config);
$response = $hokoml->question()->ask($question_id, 'The questions.');
```

#### Find
```php
<?php
// [...]
$response = $hokoml->question()->find($question_id);
```

#### Answer
```php
<?php
// [...]
$response = $hokoml->question()->answer($question_id, 'The answer.');
```

#### Questions from product
List all questions from a product.
```php
<?php
// [...]
$response = $hokoml->question()->fromProduct($product_id);

// with filters
$response = $hokoml->question()->fromProduct($product_id, [
	'status' => 'unanswered',
	[...]
]);

// with filters and sorting
$response = $hokoml->question()->fromProduct($product_id, ['status' => 'unanswered'], 'date_desc');
```

#### Unanswered from product
List all unanswered questions from a product.
```php
<?php
// [...]
$response = $hokoml->question()->unansweredFromProduct($product_id);
```

#### Block user
```php
<?php
// [...]
$response = $hokoml->question()->blockUser($user_id);
```

#### Unblock user
```php
<?php
// [...]
$response = $hokoml->question()->unblockUser($user_id);
```

#### Blocked users
List blocked users.
```php
<?php
// [...]
$response = $hokoml->question()->blockedUsers();
```

#### Received questions
```php
<?php
// [...]
$response = $hokoml->question()->received();

//With filters
$response = $hokoml->question()->received([
	'status' => 'unanswered'
]);

//With filters and sorting
$response = $hokoml->question()->received(['status' => 'unanswered'], 'date_desc');
```

## License

This project is licensed under the MIT License - see the [license.md](license.md) file for details
