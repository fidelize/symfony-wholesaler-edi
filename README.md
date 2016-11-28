edi-wholesaler
==============

Requirements
------------

- PHP 5.6 or above
- openssl

Install
-------

1. Create a private key and a public key using the commands: `openssl genrsa -out var/jwt/private.pem -aes256 4096` and 
`openssl rsa -pubout -in var/jwt/private.pem -out var/jwt/public.pem`;
2. Install the dependencies using the `composer install` command;
3. In the `jwt_key_pass_phrase` parameter, enter de security phrase created with the key;
4. Assigns write permission to the `var/logs` and `var/cache` directories.

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
