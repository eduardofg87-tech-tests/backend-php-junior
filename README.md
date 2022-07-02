# backend-php-junior
Teste programador Backend PHP Júnior (Laravel)

## Desafio Programador PHP Backend Júnior(Laravel)
As tarefas de CRUD são rotinas muito comuns no dia a dia de desenvolvedores web, o objetivo principal do desafio é fazer um CRUD de Usuários. Somente a rota API é importante, não se preocupe com o frontend. 
Todos testes de funcionamento do sistema serão realizados através do Postman.
Testes uniários com PHPUnit são um plus.
Espera-se que o candidato tenha bons conhecimentos em PHP e saiba o mínimo do framework Laravel. 
Para persistencia dos dados deve ser utilizado algum banco de dados relacional como por exemplo PostgreSQL ou MariaDB.


## Instruções:
1. Faça um fork do projeto.
1. Envie um e-mail para (contato at ensolucoes dot com) assim que o PR for submetido informando que o desafio foi finalizado.

### Objetivo
Construir uma API backend em Laravel que implementem um CRUD e os seguintes endpoints:


| Endpoint              | Method |
|-----------------------|:------:|
| /ping                 |  POST  |
| /auth                 |  POST  |
| /user                 |  POST  |
| /user                 |  PUT   |
| /user                 | DELETE |
| /user/{:id}           |  GET   |


## Endpoints

## Ping
O Ping é público, usado para saber se o server está online.

## Auth

Este endpoint irá possuir um header com Authorization e irá enviar via JSON login e senha em um método [POST].
Ele irá retornar um JSON quando der erro e um JSON quando for sucesso.

**HTTP/2 200**
```json
{  
   "status":"success",
   "message":"Usuário criado e JWT encontrado",
  "tokenjwt":"eyJhbGciOi-RkOM8Hjc5DYNJuqyEy3gvy_IMjcu2w-hl2yHilvPNP_UK0ocUxaKdsD5oS5fV-TYlfH_k",
   "expires":"2019-07-05",
   "tokenmsg":"use o token para acessar os endpoints!",
   "User":{ 
      "id":345,
      "nome":"Programador Backend PHP Júnior",
      "cpf":"12345678909",
      "email":"junior@php.net",
      "createdAt":"2019-07-03 07:09:08",
      "updatedAt":"2019-07-03 07:09:08"
   }
}
```

**HTTP/2 500**
```json
{  
   "status":"error",
   "message":"Usuário não pode ser autenticado!"
}
```

## User

Este endpoint deverá ser responsável por todo CRUD, ele deverá trazer informações do Usuário como:
``
  id
  nome 
  cpf
  email
  created_at 
  updated_at 
``
no formato JSON.


## Pontos a serem avaliados
 - Organização do código e simplicidade na lógica de programação
 - Utilização de boas práticas (PSRs)
 - Deixar sempre a regra de negócio o mais desacoplada possível.
 - Criar as migrations e seeds para validação (obrigatório)
 - JWT (não obrigatório porém será considerado diferencial)
 - Criar os mocks de teste (não obrigatório porém será considerado diferencial)
 
 
## Referências
1. [PHP](https://www.php.net/)
1. [Laravel](https://laravel.com)
1. [Postman](https://www.getpostman.com/)
1. [JWT](https://jwt.io/)
1. [Entendendo JWT](https://medium.com/tableless/entendendo-tokens-jwt-json-web-token-413c6d1397f6)
1. [PostgreSQL](https://www.postgresql.org/)
1. [MariaDB](https://mariadb.com/kb/pt-br/sobre-o-mariadb/)
1. [PHP Unit](https://phpunit.de/)
