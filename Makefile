.PHONY: up start stop down log artisan migrate migrate\:fresh migrate\:rollback scrap phone import composer composer\:update supervisor-update permissions\:fix fpm-reload ide-helper tests deploy yarn nginx-check nginx-reload pm2\:start pm2\:stop postgres\:fix

include .env

%::
	@true

# Takes the first target as command
Command := $(firstword $(MAKECMDGOALS))
# Skips the first word
args := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))

# Set dir of Makefile to a variable to use later
MAKEPATH := $(abspath $(lastword $(MAKEFILE_LIST)))
PWD := $(dir $(MAKEPATH))
CONTAINER_FPM  := $(shell docker ps --format 'table {{.Names}}' | grep -m 1 $(APP_NAME)_fpm)
CONTAINER_WEB  := $(shell docker ps --format 'table {{.Names}}' | grep -m 1 $(APP_NAME)_web)
CONTAINER_NODE := $(shell docker ps --format 'table {{.Names}}' | grep -m 1 $(APP_NAME)_nodejs)
UID := 1000
COMPOSE_PROJECT_NAME := $(APP_NAME)

up:
	docker-compose -p $(COMPOSE_PROJECT_NAME) up -d

start:
	docker-compose -p $(COMPOSE_PROJECT_NAME) start

stop:
	docker-compose -p $(COMPOSE_PROJECT_NAME) stop

down:
	docker-compose -p $(COMPOSE_PROJECT_NAME) down

reboot:
	docker-compose -p $(COMPOSE_PROJECT_NAME) down && docker-compose -p $(COMPOSE_PROJECT_NAME) up -d

artisan:
	docker exec -it \
		-u $(UID) \
		-e XDEBUG_MODE=off \
		$(CONTAINER_FPM) \
		php artisan $(args) \
		2>/dev/null || true

host?="127.0.0.1"
artisan\:debug:
	docker exec -it \
		-u $(UID) \
		-e XDEBUG_CONFIG="mode=debug client_host=$(host) client_port=9000 start_with_request=yes" \
		-e PHP_IDE_CONFIG="serverName=dockerhost" \
		$(CONTAINER_FPM) \
		php artisan $(args) -vvv \
		2>/dev/null || true

migrate:
	docker exec -it \
		-u $(UID) \
		-e XDEBUG_MODE=off \
		$(CONTAINER_FPM) \
		php artisan migrate \
		2>/dev/null || true

migrate\:fresh:
	docker exec -it \
		-u $(UID) \
		-e XDEBUG_MODE=off \
		$(CONTAINER_FPM) \
		php artisan migrate:fresh \
		2>/dev/null || true

migrate\:rollback:
	docker exec -it \
		-u $(UID) \
		-e XDEBUG_MODE=off \
		$(CONTAINER_FPM) \
		php artisan migrate:rollback \
		2>/dev/null || true

seed:
	docker exec -it \
		-u $(UID) \
		-e XDEBUG_MODE=off \
		$(CONTAINER_FPM) \
		php artisan db:seed \
		2>/dev/null || true

migrate\:fresh\:seed:
	docker exec -it \
		-u $(UID) \
		-e XDEBUG_MODE=off \
		$(CONTAINER_FPM) \
		php artisan migrate:fresh --seed \
		2>/dev/null || true

nginx\:check:
	docker exec -it $(CONTAINER_WEB) nginx -t 2>/dev/null || true

nginx\:reload:
	docker kill -s HUP $(CONTAINER_WEB) 2>/dev/null || true

composer:
	docker exec -it \
		-u $(UID) \
		$(CONTAINER_FPM) \
		composer $(args) \
		2>/dev/null || true

composer\:update:
	docker exec -it \
		-u $(UID) \
		$(CONTAINER_FPM) \
		composer update -o \
		2>/dev/null || true

ide-helper:
	docker exec -it -u $(UID) -e XDEBUG_MODE=off $(CONTAINER_FPM) php artisan ide-helper:generate stubs/IdeHelper.php 2>/dev/null || true && \
	docker exec -it -u $(UID) -e XDEBUG_MODE=off $(CONTAINER_FPM) php artisan ide-helper:models --write-mixin -F stubs/ModelHelper.php 2>/dev/null || true && \
	docker exec -it -u $(UID) -e XDEBUG_MODE=off $(CONTAINER_FPM) php artisan ide-helper:eloquent 2>/dev/null || true

cache\:clear:
	docker exec -it -u $(UID) -e XDEBUG_MODE=off $(CONTAINER_FPM) php artisan cache:clear 2>/dev/null || true && \
	docker exec -it -u $(UID) -e XDEBUG_MODE=off $(CONTAINER_FPM) php artisan view:clear   2>/dev/null || true && \
	docker exec -it -u $(UID) -e XDEBUG_MODE=off $(CONTAINER_FPM) php artisan route:clear  2>/dev/null || true && \
	docker exec -it -u $(UID) -e XDEBUG_MODE=off $(CONTAINER_FPM) php artisan config:clear 2>/dev/null || true

logs\:clear:
	docker exec -it $(CONTAINER_FPM) truncate -s 0 storage/logs/*.log 2>/dev/null || true

tests:
	docker exec -it \
		-u $(UID) \
		$(CONTAINER_FPM) \
		php ./vendor/bin/pest --do-not-cache-result --no-coverage \
		2>/dev/null || true

deploy:
	envoy run deploy

backup:
	docker exec -it -u $(UID) $(CONTAINER_FPM) php artisan backup:run 2>/dev/null || true

permissions\:fix:
	docker exec -u 0 -it $(CONTAINER_FPM) chown -R 1000:100 ./bootstrap 2>/dev/null || true && \
	docker exec -u 0 -it $(CONTAINER_FPM) chown -R 1000:100 ./storage/logs 2>/dev/null || true && \
	docker exec -u 0 -it $(CONTAINER_FPM) chown -R 1000:100 ./storage/framework 2>/dev/null || true && \
	docker exec -u 0 -i $(CONTAINER_FPM) find ./vendor -type d -exec chmod 755 {} \; 2>/dev/null || true && \
	docker exec -u 0 -i $(CONTAINER_FPM) find ./vendor -type f -exec chmod 644 {} \; 2>/dev/null || true

fpm\:reload:
	docker exec -it $(CONTAINER_FPM) kill -USR2 1

cmd=""
yarn:
	docker exec \
		$(CONTAINER_NODE) \
		yarn $(cmd) -t \
		2>/dev/null || true

debug\:enable:
	echo "xdebug.mode = develop,debug" > ./.docker/php/custom.ini && \
	docker exec -it $(CONTAINER_FPM) kill -USR2 1

debug\:disable:
	echo ";xdebug.mode = develop,debug" > ./.docker/php/custom.ini && \
	docker exec -it $(CONTAINER_FPM) kill -USR2 1

pm2\:start:
	pm2 start pm2.yml

pm2\:stop:
	pm2 stop pm2.yml

db_username?="$(DB_USERNAME)"
db_password?="$(DB_PASSWORD)"
db_name?="$(DB_DATABASE)"
db_host?="$(DB_HOST)"
table_name=""
postgres\:fix:
	docker exec -it -u $(UID) \
	-e PGPASSWORD=$(db_password) \
	$(CONTAINER_FPM) \
	psql -U $(db_username) \
	-d $(db_name) \
	-h $(db_host) \
	-c "SELECT SETVAL('$(table_name)_id_seq', COALESCE(MAX(id), 1)) FROM $(table_name);" \
	2>/dev/null || true
