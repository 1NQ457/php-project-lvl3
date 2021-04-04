start:
	php artisan serve

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	php artisan migrate
	php artisan db:seed
	npm install

setup-gh:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	npm install

watch:
	npm run watch

migrate:
	php artisan migrate

tinker:
	php artisan tinker

test:
	php artisan test

lint:
	composer run-script phpcs -- --standard=PSR2 app/ tests/
