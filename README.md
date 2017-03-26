# Tasklist APp
Simple Tastklist app - Silex / Doctrine / Bootstrap

### Instalação ###
* Clone este repo
* Instale as dependências via Composer

`composer install`


### Testando ###
Levante a aplicação em um webserver, ex:

`php -S 0.0.0.0:8080`


Execute a aplicação em um navegador
http://localhost:8080


##### Para listar #####
GET > http://tasklist-api.gebender.com.br/tasks


##### Para ver um #####
GET > http://tasklist-api.gebender.com.br/tasks/1


##### Para inserir #####
POST > http://tasklist-api.gebender.com.br/tasks

`Body raw:
{
	"ordem":"2",
	"titulo":"Nova task",
	"task":"Testar API",
	"prazo":"2017-03-27"
}`


##### Para editar #####
PUT > http://tasklist-api.gebender.com.br/tasks/1
`Body raw:
{
	"ordem":"50",
	"titulo":"task editada, nova ordem"
}`


##### Para deletar #####
DELETE > http://tasklist-api.gebender.com.br/tasks/1



:)
