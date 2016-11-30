edi-wholesaler
==============

[![Build Status](https://travis-ci.org/merorafael/edi-wholesaler.svg?branch=master)](https://travis-ci.org/merorafael/edi-wholesaler)
[![Coverage Status](https://coveralls.io/repos/github/merorafael/edi-wholesaler/badge.svg?branch=master)](https://coveralls.io/github/merorafael/edi-wholesaler?branch=master)

Requirements
------------

- PHP 7.0 or above
- openssl

Install
-------

1. Install the dependencies using the `composer install` command;
2. Assigns write permission to the `var/logs` and `var/cache` directories.

JWT Authentication
------------------

JWT Authentication has been implemented in this API. To authenticate using a token, send a `POST` request to the 
`/user_token` route with the header `Content-Type: application/json` and the following body:

```json
{
  "_username": "teste",
  "_password": "1234"
}
```

Use the token in the other requests that will be made, including the `Authorization: Bearer <token>` header.

Clear production cache
----------------------

By default, the environment in which the API is run is a production environment. To avoid loss of performance,
Symfony caches its key features and needs to be removed whenever a configuration or source change is made.

To clear the production cache, run the command `php bin/console cache:clear --env=prod`.
