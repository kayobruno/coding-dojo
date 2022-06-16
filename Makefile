UID := $(shell id -u)
GID := $(shell id -g)

serve:
	- docker-compose up

shell:
	- docker-compose exec dojo-php bash

test:
	- docker-compose exec -u ${UID}:${GID} dojo-php bash -c "composer test"
