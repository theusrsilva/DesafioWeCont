# Desafio Wecont

Api de gerenciamento de faturas feita para o desafio da empre WeCont.

A aplicação foi feita toda utilizando laravel, Jwt e mysql.

# Características do sistema

* Autenticação de Usuário
* Só usuários logados na api podem alterar e ver suas faturas
* Paginação de faturas em 5 por página
* Data de validade da fatura para 3 dias depois de sua criação]
* O sistema possui seeds para alimentar o banco e facilitar os testes
* Validation de campos recebidos
* CRUD de faturas
* Tradução
* Rotas protegidas por autenticação
* MVC
* Só retorna apenas nome e e-mail dos usuários quando acessado a rota /api/info
* Todo retorno em JSON

## Instalação Unix
    
    git clone https://github.com/theusrsilva/DesafioWeCont.git
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan jwt:secret
    
## Instalação Windows
    
    git clone https://github.com/theusrsilva/DesafioWeCont.git
    composer install
    será necessário copiar e colar o .env.example no mesmo lugar com o nome de .env
    php artisan key:generate
    php artisan jwt:secret
    

## Rodando o APP

    Recomendo o uso de programas com o Xampp para iniciar seu banco de dados local
    Após isso crie uma base de dados com o nome que desejar e informe ela e as demais informações para coexão com seu banco de dados
    php artisan migrate (--seed) caso queira o banco alimentado com dados ficticios utilize o "--seed"
    php artisan serve

## Utilização

    Para poder testar a API recomendo o uso do aplicativo Postman para poder acessar todas as rotas

# Lista de rotas

## Bem-Vindo

### Request

`GET /api/`

### Response

   {
    "message": "Bem vindo a Api do Desafio WeCont!"
    }

## Cadastro

### Request

`POST /api/cadastro`

### Response

    {
    "success": true,
    "user": {
        "name": "matheus",
        "email": "emai333l@email.com"
    }
    }

## Login

### Request

`GET /api/login`

### Response

    {
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYwMTE1MTk5NSwiZXhwIjoxNjAxMTU1NTk1LCJuYmYiOjE2MDExNTE5OTUsImp0aSI6InpDZG9qY2JBWmxpUWNzcm0iLCJzdWIiOjksInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.jAKubrBderoHB7ArPUba2spEepOMYr6ZySaXuCokUno",
    "token_type": "bearer",
    "expires_in": 3600
    }

## Informações do Usuário Logado (AUTH)

### Request

`POST /api/info`


### Response

    {
    "name": "teste api",
    "email": "teste2@teste.com"
    }

## Troca Senha(AUTH)

### Request

`POST /api/senha`

### Response

    {
    "success": true,
    "message": "Senha alterada com sucesso"
    }


### Criar fatura(AUTH)

### Request

`POST /api/fatura`


### Response

    {
    "success": true,
    "invoice": {
        "value": "1234.56",
        "status": "aberta",
        "expiration": "2020-09-29 17:36:12",
        "url": "www.desafiowecont.com/fatura/51",
        "user_id": 9,
        "updated_at": "2020-09-26 17:36:12",
        "created_at": "2020-09-26 17:36:12",
        "id": 51
    }
    }


## Lista de faturas do usuário autenticado (AUTH)

### Request

`GET /api/fatura`

### Response

    {
    "current_page": 1,
    "data": [
        {
            "id": 7,
            "user_id": 9,
            "status": "pag",
            "url": "www.desafiowecont.com/fatura/7",
            "created_at": "2020-09-26 01:49:23",
            "updated_at": "2020-09-26 15:30:12",
            "expiration": "2020-09-29 01:49:23",
            "value": "9273.66"
        },
        {
            "id": 10,
            "user_id": 9,
            "status": "atrasada",
            "url": "www.desafiowecont.com/fatura/10",
            "created_at": "2020-09-26 01:49:23",
            "updated_at": "2020-09-26 01:49:23",
            "expiration": "2020-09-29 01:49:23",
            "value": "450.95"
        },
        {
            "id": 13,
            "user_id": 9,
            "status": "paga",
            "url": "www.desafiowecont.com/fatura/13",
            "created_at": "2020-09-26 01:49:23",
            "updated_at": "2020-09-26 01:49:23",
            "expiration": "2020-09-29 01:49:23",
            "value": "9790.26"
        },
        {
            "id": 21,
            "user_id": 9,
            "status": "aberta",
            "url": "www.desafiowecont.com/fatura/21",
            "created_at": "2020-09-26 01:49:23",
            "updated_at": "2020-09-26 01:49:23",
            "expiration": "2020-09-29 01:49:23",
            "value": "9454.93"
        },
        {
            "id": 22,
            "user_id": 9,
            "status": "aberta",
            "url": "www.desafiowecont.com/fatura/22",
            "created_at": "2020-09-26 01:49:23",
            "updated_at": "2020-09-26 01:49:23",
            "expiration": "2020-09-29 01:49:23",
            "value": "8863.72"
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/fatura?page=1",
    "from": 1,
    "last_page": 3,
    "last_page_url": "http://127.0.0.1:8000/api/fatura?page=3",
    "next_page_url": "http://127.0.0.1:8000/api/fatura?page=2",
    "path": "http://127.0.0.1:8000/api/fatura",
    "per_page": 5,
    "prev_page_url": null,
    "to": 5,
    "total": 14
    }

## Mostrar uma fatura específica(AUTH)

### Request

`GET /api/fatura/{id}`

### Response

    {
    "id": 21,
    "user_id": 9,
    "status": "aberta",
    "url": "www.desafiowecont.com/fatura/21",
    "created_at": "2020-09-26 01:49:23",
    "updated_at": "2020-09-26 01:49:23",
    "expiration": "2020-09-29 01:49:23",
    "value": "9454.93"
    }

## Atualizar uma fatura(AUTH)

### Request

`PUT /api/fatura/{id}`

### Response

    {
    "success": true,
    "invoice": {
        "id": 7,
        "user_id": 9,
        "status": "paga",
        "url": "www.desafiowecont.com/fatura/7",
        "created_at": "2020-09-26 01:49:23",
        "updated_at": "2020-09-26 15:30:12",
        "expiration": "2020-09-29 01:49:23",
        "value": "9999.99"
    }
    }

## Apagar uma fatura(AUTH)

### Request

`DELETE /api/fatura/{id}`

### Response

    {
    "success": true,
    "message": "O produto foi deletado!"
    }

## Logout(AUTH)

### Request

`POST /api/logout`

### Response

    {
    "message": "Você foi desconectado com sucesso!"
    }
