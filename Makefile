install:
	composer install
	cp .env.example .env
	php artisan key:generate
	touch ./database/database.sqlite
	php artisan migrate
	npm install
	php artisan env:set PUSHER_APP_ID 1584765
	php artisan env:set PUSHER_APP_KEY b1195d09e6275dd5a5b1
	php artisan env:set PUSHER_APP_SECRET 0e6bee8e326a8e6eee8f
	php artisan env:set PUSHER_APP_CLUSTER ap2

run:
	npm run dev
	php artisan serve

