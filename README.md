-Ferramentas: PHP, MYSQL Workbeanch, XAMPP,Vscode,Postman
//install
-composer create-project laravel/laravel
-composer require laravel/sanctum

//.env
-primeiro precisamos configurar o .env com o mysql
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

/******************* SANCTUM **********************/
// app/Models/User.php
-para funcionar o sanctum precisamos adicionar o "HasApiTokens" para que toda requisição via API precise do token gerador atraves
do login do usuario

// routes/api.php
-criaremos 4 rotas para o sanctum funcionar e de "create" onde iremos criar o usuario,"login" quando eu digitar o email e a senha
corretamente ira gerar o "token" e ultimo o "me" que ele verifica se o usuario esta authenticado , se tiver retorna as informações do usuario

// app/Http/Controllers/AuthController.php
-no "register" iremos usar as validações do UserRequest mas iremos explicar melhor na parte de CRUD!! apos de validar ira retornar um json com seu "token"
-no "login" se utiliza o "Auth::attempt" para validar as credencias se tiver correto faz o login e assim que fizer login na API
ele gera todas as vezes um "token" diferente ao fazer login
- no "me" ele traz "Unauthenticated" quando não recebe o token por conta do HasApiTokens e se trazer o token correto tras as
informações do usuario

/******************* CRUD **********************/

// app/Http/Controllers/UserController.php
- Validação
Nas validações eu utilizei o "php artisan make:request UserController" deixei separado as validações para não ficar
bagunçado e evitar repetições  dentro dos Controllers, eu utilizo o "$this->method()" para verificar se é POST ou PUT e dentro da validação tenho de varios tipos: required que é obrigatorio setar o valor, string que aceita somente tipo string, max que aceita o maximo de caracteres, min aceita o minimo de caracteres, unique para não houver repetição, integer que aceitar somente valores inteiros, boolean que aceita somente true,false,0 ou 1;
- Api
Na rota de api podemos ver que usamos o "Route:resource" que cria uma estrutura de index(GET),store(POST),create(POST),show(GET),update(PUT),destroy(delete) e edit(GET) mas por hora vamos usar somente o index,store,show e update

- Create (POST)
Create faz a requisição de novos usuarios chamando o UserRequest (explicado nas validações) que set nos user o email,name,status,type e password retornando um json com a data da requisição e o success mostrando a mensagem de "Usuario cadastrado com sucesso"
- Read (GET)
No read utilizei dois o Index que traz todas as requisiçoes e o show que é necessario a chamada de um id pela rota que traz o usario especifico pelo id

- Update (PUT)
Update ele atualiza os cadastro ja feito atravez do id do usuarario

- Delete (DELETE)
delete ele delete o usuario atravez do id, retorna um json mostrando "Usuario deletado com sucesso"