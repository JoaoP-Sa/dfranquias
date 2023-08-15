up:
	cd laradock && docker-compose up -d nginx mysql phpmyadmin workspace

migrate:
	docker exec laradock_workspace_1 bash -c "php artisan migrate"

reset_tables:
	docker exec laradock_workspace_1 bash -c "php artisan migrate:reset"

stop:
	cd laradock && docker-compose stop

kill:
	cd laradock && docker-compose down
