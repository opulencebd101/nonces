WordPress Object Oriented Nonces
================================

Composer package that replicates WordPress nonces in a object oriented way.

[![Build Status](https://travis-ci.org/rhurling/wp-oo-nonces.svg?branch=master)](https://travis-ci.org/rhurling/wp-oo-nonces)
[![Coverage Status](https://coveralls.io/repos/github/rhurling/wp-oo-nonces/badge.svg?branch=master)](https://coveralls.io/github/rhurling/wp-oo-nonces?branch=master)

Usage
-----

### Create Nonce

``` php
use RouvenHurling\Nonces\Nonce;

$nonce = new Nonce('readme-action');
$nonce->setSalt(NONCE_SALT);
 
$nonce->generate();
```

### Verify Nonce

``` php
use RouvenHurling\Nonces\Nonce;

$nonce = new Nonce('readme-action');
$nonce->setSalt(NONCE_SALT);

$nonce->verify($_nonce);
```

### Other Nonce specific Options

``` php
$nonce->setSalt(NONCE_SALT);
$nonce->setUserId($userId);
$nonce->setSessionToken($sessionToken);
```

Todo
----

 * Allow setting global defaults (for Salt, User ID and Session Token)
 * Split Verification into its own class?