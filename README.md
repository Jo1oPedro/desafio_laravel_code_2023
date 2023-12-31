<p align="center"><a href="https://codejr.com.br/" target="_blank"><img src="https://codejr.com.br/wp-content/uploads/elementor/thumbs/Da-uma-olhada-no-design-que-eu-fiz-no-Canva-e1631206678162-pcvbl6lcx3mwo97eg0q4yn4zchcokysbd7aoauowe8.png" width="750" alt="Code"></a></p>

<h1 align="center">
    Desafio Laravel 2023.2
</h1>

## Sobre o desafio

O desafio tem como intuito treinar os novos membros da Code Jr., afim de familiarizarem melhor com o framework desenvolvendo um sitema de gerenciamento interno de uma clínica veterinária, com as funcionalidades definidas no documento de requisitos disponibilizado.

## Trilha de Laravel

Link: <a href="https://drive.google.com/drive/folders/16U7EIQ58v3ZgeTE-Eh3ivZ_lKretVEFc?usp=sharing">https://drive.google.com/drive/folders/16U7EIQ58v3ZgeTE-Eh3ivZ_lKretVEFc?usp=sharing</a>

## Como executar o projeto

Para executar o projeto você deve seguir os seguintes passos:

- Copie o arquivo `.env.example` e renomeie sua cópia para `.env`
- Crie um banco 'MySql' com o nome de `desafio_laravel_code`
- execute o comando: ```composer install```
- execute o comando: ```php artisan key:generate``` 
- execute o comando: ```php artisan storage:link```
- execute o comando: ```php artisan migrate --seed```
- execute o comando: ```npm install```
- execute o comando: ```npm run build```
- Para gerar a documentação do swagger execute o comando: ```php artisan swagger```
- Para acessar a documentação gerada pelo swagger acesse a url exibida pelo comando ```php artisan serv``` e adicione ```/api-documentation```

## Links importantes da documentação para esse projeto

### Modelo lógico do banco de dados
Link: <a href="https://prnt.sc/l7l6AvaCLJB5">
    Link para o modelo lógico do banco de dados
</a>

### Postman
Link: <a href="https://www.postman.com/cascata/workspace/public-apis/collection/18990942-c9386768-8308-43c9-bfd8-220905166221?action=share&creator=18990942">
    Link para a collection de rotas da api no postman.
</a>

### Documentação sobre teste de apis
Link: <a href="https://laravel.com/docs/10.x/http-tests">
Link para a collection de rotas da api no postman.
</a>
https://laravel.com/docs/10.x/http-tests

### Resources
Link: <a href="https://laravel.com/docs/10.x/eloquent-resources">
    Resources utilizados em conjunto com a model para manipular retorno em formato json as chamadas da api.
</a>

### Authentication
Link: <a href="https://laravel.com/docs/10.x/sanctum#api-token-authentication">
    Autenticação para api utilizando token no sanctum.
</a>

Link: <a href="https://ww w.youtube.com/watch?v=_POq4dyp0WM">
    Autenticação para api utilizando token no sanctum(video).
</a>

### DTO 
Link: <a href="https://medium.com/@eloufirhatim/what-is-dto-and-how-to-use-it-in-a-laravel-application-7ca1e9045985#:~:text=DTO%20stands%20for%20Data%20Transfer,different%20parts%20of%20the%20application.">
    O que é um DTO e como começar a implementar utilizando um.
</a>

### Swagger para php
Link: <a href="https://www.youtube.com/watch?v=rJ_GR3Y8-ck">
    Como documentar uma api em php utilizando o php-swagger.
</a>
