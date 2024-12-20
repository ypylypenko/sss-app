.PHONY: help build install migrate

.DEFAULT_GOAL := help

help: ## Show this help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

build-dev: build up composer-install copy-env key-generate db-migrate db-seed

build: ## Build all containers
	@if [ ! -f docker-compose.override.yml ]; then cp docker-compose.override.yml.dist docker-compose.override.yml; fi
	docker-compose build

up: ## Start all containers (in background) for development
	docker-compose up -d

copy-env: ## Copy .env.example to .env if it does not exist
	@if [ ! -f .env ]; then cp .env.example .env; fi

down: ## Stop all started for development containers
	docker-compose down -v --remove-orphans

key-generate: ## Generate application key
	docker-compose exec php-fpm php artisan key:generate

composer-install: ## Install composer dependencies
	docker-compose exec php-fpm composer install

db-migrate: ## Run migrations
	docker-compose exec php-fpm php artisan migrate

db-seed: ## Seed database
	docker-compose exec php-fpm php artisan db:seed

npm-install: ## Install npm dependencies
	docker-compose exec frontend npm install

test: ## Execute application tests
	docker-compose exec php-fpm vendor/bin/pest --coverage --min=80
