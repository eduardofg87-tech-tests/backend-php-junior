# backend-php-junior - Teste Concluído
Teste programador Backend PHP Júnior (Laravel)

## Desafio Programador PHP Backend Júnior(Laravel)
As tarefas de CRUD são rotinas muito comuns no dia a dia de desenvolvedores web, o objetivo principal do desafio é fazer um CRUD de Usuários. Somente a rota API é importante, não se preocupe com o frontend. 
Todos testes de funcionamento do sistema serão realizados através do Postman.
Testes uniários com PHPUnit são um plus.
Espera-se que o candidato tenha bons conhecimentos em PHP e saiba o mínimo do framework Laravel. 
Para persistencia dos dados deve ser utilizado algum banco de dados relacional como por exemplo PostgreSQL ou MariaDB.

### O presente desafio deve ser solucionado até 12/07/2019. 

## Instruções para funcionamento:
- Clone o repositório na sua pasta de projetos. Dê as devidas permissões no diretório.
- No terminal, dentro da raiz do projeto, rode o comando: <code>composer install</code>, para fazer a instalação das depedências.
- Crie um arquivo .env a partir do modelo de exemplo que se encontra na raiz do projeto e configure os seguintes parametros:

<code>
    DB_CONNECTION=mysql <br>
    DB_HOST=127.0.0.1    <br>
    DB_PORT=3306  <br>
    DB_DATABASE=nome_do_seu_banco <br>
    DB_USERNAME=usuario_do_banco<br>
    DB_PASSWORD=senha_do_banco
</code>

- Gerar a chave do App com o comando: <code>php artisan make:key generate</code>.
- Gerar a chave secreta do JWT para realizar a autenticação via Token. O comando é, <code>php artisan jwt:secret</code>
- Rodar as migrations e seeds com o seguinte comando: <code>php artisan migrate --seed</code>


### Endpoints Criadas:

| Endpoint              | Method |
|-----------------------|:------:|
| /ping                 |  POST  |
| /auth                 |  POST  |
| /clients              |  POST  |
| /clients              |  PUT   |
| /clients              | DELETE |
| /clients/{:id}        |  GET   |
| /register             |  POST  |
| /logout               |  GET   |
| /refresh              |  GET   |
| /me                   |  GET   |


## Endpoints

## Ping
O Ping é público, usado para saber se os serviços do servidor está online.

## Auth

Este endpoint irá possuir um header com Authorization e irá enviar via JSON login e senha em um método [POST].
Ele irá retornar um JSON quando der erro e um JSON quando for sucesso.

**HTTP/2 200**
```json
{  
   "status":"success",
   "message":"Usuário criado e JWT encontrado",
   "token":"eyJhbGciOi-RkOM8Hjc5DYNJuqyEy3gvy_IMjcu2w-hl2yHilvPNP_UK0ocUxaKdsD5oS5fV-TYlfH_k",
   "expires":"2019-07-05",
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

## clients

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

## Register

Este endpoint é reponsável por fazer o cadastro de usuário na api, retornando um  json com o token para ser ultilizado ao consumir os demais recursos da API.
 
## Logout

Este endpoint é responsável por efetuar o logout da api e invalidar o token gerado.

## Refresh

Este endpoint é responsável por revalidar o token gerado.

## Me

Este endpoint é responsável por retornar o usuário que está logado no momento.
 
 
## Referências
1. [PHP](https://www.php.net/)
1. [Laravel](https://laravel.com)
1. [Postman](https://www.getpostman.com/)
1. [JWT](https://jwt.io/)
1. [Entendendo JWT](https://medium.com/tableless/entendendo-tokens-jwt-json-web-token-413c6d1397f6)
1. [PostgreSQL](https://www.postgresql.org/)
1. [MariaDB](https://mariadb.com/kb/pt-br/sobre-o-mariadb/)
1. [PHP Unit](https://phpunit.de/)
