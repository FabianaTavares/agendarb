# Agenda Rodrigo Branas - Backend Laravel
Agenda Rodrigo Branas é apenas um treinamento de muitos anos atras seguindo
as video aulas dele no youtube, o foco era AngularJS decidi extender para o backend
Laravel.

Requisitos:
----------------------
- PHP 7.1.* ou 7.2.*
- MySQL DBMARIA >= 10.2
- Apache >= 2.4
- Npm

Tecnologias:
----------------------
- Laravel >= 5.5
- [Laravel Admin](https://github.com/z-song/laravel-admin)


Documentação via Swagger
-------

Seguir o padrão do swagger mapeando suas decorations nas rotas em seguida rodar os comandos:
````
  vendor/bin/swagger app -o public/swagger.json
  composer dump-autoload
````

- Acessar o Swagger para Testes de API
- Colocar na url do navegador o caminho correspondente ao projeto a index do swagger
````
  Ex: http://localhost:8000/docs/index.html
````

- Em seguida na url do swagger colocar o caminho do swagger.json:
````
  http://localhost:8000/swagger.json
````

- Se for realizar testes pelo swagger após entrar com o usuario e senha será gerado um token.
- Ao ir no botão "Authorize" e inserir o token no campo value é necessário escrever a palavra Bearer na frente.
- Ex: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE1NTU4NzE3MjQsImV4cCI6MTU1NTg3NTMyNCwibmJmIjoxNTU1ODcxNzI0LCJqdGkiOiJxcnlGMHcxSVpSbnkydjNwIiwic3ViIjoxLCJwcnYiOiIyYTczMDhmNDUwNzQ2NmQwYmEwZGVkYTkwYjg2MWY4NzMwYzQ4MTYwIn0.R-eqmkRxo9JDUrwTxCOwhjsHXgI7azT06HQAR1MD5-I

## Especificações de Banco de Dados
-------

## Instalação
----------

Atualize as dependências de backend execuntando o comando:
````
 composer install
````

Execute os comandos abaixo para instalar as dependencias do front-end:
````
npm install
npm run dev
````

Faça um cópia do arquivo `.env.example` com o nome `.env`

Nesse novo arquivo faça as configurações da aplicação, banco de dados e servidores de email.

Para configurar a aplicação é necessário gerar a chave da aplicação, para isso execute o comando:
````
php artisan key:generate
````
O comando acima te retornará uma chave que deve ser colada em `APP_KEY=` do arquivo `.env`.

#####No terminal, na pasta da aplicação:

Logo após crie e inicialize o banco de dados com o seguinte comando:
````
php artisan migrate
````

O Comando acima pode retornar alguns erros:
Altere o arquivo config/database.php, afert 'engine':
````
'modes'  => [
    'ONLY_FULL_GROUP_BY',
    'STRICT_TRANS_TABLES',
    'NO_ZERO_IN_DATE',
    'NO_ZERO_DATE',
    'ERROR_FOR_DIVISION_BY_ZERO',
    'NO_ENGINE_SUBSTITUTION',
],
````

Se ainda ocorrer erros de password no mysql:
````
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';
````

rode também o comando que gera as seeds:
````
php artisan migrate
````

#####No terminal, na pasta da aplicação:
Crie um link para o diretório de arquivos executando o comando abaixo:
````
php artisan storage:link
````

#####Configuração de E-mail
No arquivo .env é necessário parametrizar a configuração de SSL
````
MAIL_SSL=true
````

###Para desenvolvedores

Utilizamos o plugin [Clockwork](https://github.com/itsgoingd/clockwork) para facilitar o DEBUG do sistema no próprio navegador.

Para instala-lo, em seu terminal, execute o comando:
````
composer require --dev itsgoingd/clockwork
````
Siga esse [link](https://gist.github.com/scrubmx/25567df9e402c92f4cb9ed919d2fe760) para configurar o plugin apenas no ambiente de desenvolvimento.

Para que consiga debugar da maneira correta é necessário instalar uma extenção do seu navegador para esse plugin, selecione abaixo o navegador que utiliza para desenvolvimento.
- [Chrome](https://chrome.google.com/webstore/detail/clockwork/dmggabnehkmmfmdffgajcflpdjlnoemp)
- [Firefox](https://addons.mozilla.org/en-US/firefox/addon/clockwork-dev-tools/)

Instalação da CRON
------------------
Para instalar a CRON consulte o arquivo ``readme.md`` no diretório abaixo:
````
public/cron_jobs
````

## ATUALIZAÇÕES
----------

Para atualizar o sistema é necessário seguir os passos:
-
- Atualizar o repositório
````
git pull
````
- Atualizar o banco de dados
````
php artisan migrate
````
- Atualizar as dependências BackEND
````
composer install
````
- Atualizar as dependências FrontEND
````
npm install
````
- "Compilar" o FrontEND
````
npm run dev
````
