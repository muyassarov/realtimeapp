install:
	composer install
	cp .env.example .env
	php artisan key:generate
	touch ./database/database.sqlite
	php artisan migrate
	npm install

run:
	npm run dev
	php artisan serve

