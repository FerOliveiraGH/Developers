## Cadastro de Desenvolvedores
- Este projeto tem o objetivo de implementar uma aplicação que realizar cadastros de Desenvolvedores.

### Rotas de API implementadas:
- GET: "api/developers" - obter uma lista de desenvolvedores paginada.
- GET: "api/developers/{id}" - obter um desenvolvedor por id.
- POST: "api/developers" - cadastrar um desenvolvedor.
- PATCH: "api/developers/{id}" - atualizar o cadastro de um desenvolvedor.
- DELETE: "api/developers/{id}" - remover um desenvolvedor.


- GET: "api/levels" - obter uma lista de níveis paginada.
- GET: "api/levels/{id}" - obter um nível por id.
- POST: "api/levels" - cadastrar um nível.
- PATCH: "api/levels/{id}" - atualizar o cadastro de um nível.
- DELETE: "api/levels/{id}" - remover um nível.

### Front-end vue.js
- Foi utilizado vue.js no front-end para poder implementar uma interface SPA (Single Page Application).

### Pacotes
- PHP 7.4
- Laravel 8.0
- Composer 2
- Vue.js 3

### Instalar
    - composer run-script install
    - php artisan serve

### Estrutura de Pastas
    - app (Back-end)
        - Business
        - Http 
            - Controllers
            - Repositories
                - Developers
            - Models
                - Developers
     - tests
        - Feature
            - Developers
        - Unit
            - Controllers
    - resources (Front-end)
        - js
            - components
            - Pages
    - database (Infra)
        - migrations
        - seeders
            - Testing
   
