# Bis2Bis

## Sobre o projeto

Blog criado em PHP no padrão MVC utilizando docker, nginx e mysql

É necessário possuir o [composer](https://getcomposer.org) e [docker](https://www.docker.com) instalado para poder utilizar o projeto.

Para a primeira configuração é necessário rodar os seguintes comandos no terminal:\
`composer install` para fazer a instalação das dependências do projeto\
`docker compose up -d(opcional para liberar o terminal)` esse comando vai iniciar o projeto

O dump da base de dados pode ser encontrada em public/base_bkp/

Nesse dump já possui um usuário "admin" cadastrado\
email: admin@email.com\
senha: 1234

Tive um problema com permissionamento da pasta public dentro do docker no momento de criar as imagens e o dump, caso o erro continue, é necessário da permissão de acesso à pasta.
