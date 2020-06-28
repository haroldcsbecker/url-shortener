install:
	composer update
	docker build ./

start:
	docker-compose up -d
	containerId=$(docker ps --format "{{.ID}} {{.Names}}" | grep "webserver" | cut -d ' ' -f1)
	docker exec -it "$containerId" bash -c "cd /var/www/html/url-shortener && vendor/bin/phinx migrate"
