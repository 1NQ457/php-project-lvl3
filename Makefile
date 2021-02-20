start:
	php artisan serve --host 0.0.0.0

setup:
	composer install

deploy:
	git push heroku

lint:
	composer run-script phpcs -- --standard=PSR12 app