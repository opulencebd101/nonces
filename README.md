Object Oriented Nonces
================================

Composer package that replicates WordPress nonces in an object oriented way.

[![Build Status](https://travis-ci.org/rhurling/nonces.svg?branch=master)](https://travis-ci.org/rhurling/nonces)
[![Coverage Status](https://coveralls.io/repos/github/rhurling/nonces/badge.svg?branch=master)](https://coveralls.io/github/rhurling/nonces?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rhurling/wp-oo-nonces/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/rhurling/wp-oo-nonces/?branch=master)

Usage
-----

### Configure Nonce Defaults
 
``` php
use RouvenHurling\Nonces\Config;

Config::setSalt($salt);
Config::setUserId($userId);
Config::setSessionToken($sessionToken);
```

### Create Nonce

``` php
use RouvenHurling\Nonces\Nonce;

$nonce = new Nonce('readme-action');
$nonce->generate();
```

### Verify Nonce

``` php
use RouvenHurling\Nonces\Verifer;

$verifier = new Verifier();
$verifier->verify($nonce, $action);
```

### Override global configuration per Nonce

``` php
$nonce = new Nonce('Action', $myConfig);
$verifier = new Verifier($myConfig);

$nonce->setLifespan(172800);
$nonce->setAlgorithm('sha256');
$nonce->setSalt($salt);
$nonce->setUserId($userId);
$nonce->setSessionToken($sessionToken);
```
