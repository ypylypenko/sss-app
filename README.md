### Requirements

- Docker
- PHP 8.2
- Composer 2.7
- MySQL 8.0
- Node 18.20
- NPM 10.8.2

### Running locally

To build and run the application you can use the following command

```bash
make build-dev
```

or you can run step by step

```bash
make build
make up
make composer-install
make copy-env
make key-generate
make db-migrate
make db-seed
```

Also, you can run `make help` to see all available commands

### Running the tests

```bash
make test
```

or

```bash
docker-compose exec php-fpm vendor/bin/pest --coverage --min=80
```
