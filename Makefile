install:
	composer install
	cp .env.example .env
	php artisan key:generate
	touch ./database/database.sqlite
	php artisan migrate

