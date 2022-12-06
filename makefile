CONTAINER_NAME='openAidGpt'
UID:=`id -u`
GID:=`id -g`

build:
	cp .env.example .env
	DOCKER_UID=$(UID):$(GID) docker-compose build
run:
	DOCKER_UID=$(UID):$(GID) docker-compose build
	DOCKER_UID=$(UID):$(GID) docker-compose up -d
	DOCKER_UID=$(UID):$(GID) docker exec -it ${CONTAINER_NAME} composer install

start:
	DOCKER_UID=$(UID):$(GID) docker exec -it ${CONTAINER_NAME} php app.php ${TOPIC}
