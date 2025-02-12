# TaskSun
![tasksun](img/tasksun.png)

**[README BACKEND](backend/README.md)**

**TaskSun** é um gerenciador de tarefas (task manager) que tem como objetivo ser simples e eficiente. Este projeto é dividido em duas partes: o backend e o frontend, que são desenvolvidos de forma desacoplada.

## 📂 Estrutura do Projeto
O repositório está organizado da seguinte forma:

```
tasksun/

└── README.md # Esta documentação
│

├── backend/ # Código do backend

│ └── README.md # Documentação específica do backend

│

└── frontend/ # Código do frontend

└── README.md  # Documentação específica do frontend

```

## 🖥️ Tecnologias Utilizadas
### Backend
- **Linguagem:** PHP
- **Framework:** Laravel
- **Banco de Dados:** PostgreSQL

### Frontend
- **Linguagem:** JavaScript
- **Runtime:** Node.js
- **Framework:** Vue.js

## ⚙️ Como executar o projeto
Siga os passos para executar o projeto completo em sua máquina.

### Pré-requisitos
- É necessário ter o **Docker** instalado.

### Instruções de Instalação
Primeiramente, faça o clone do repositório **'tasksun'** localmente em sua máquina:

```
git https://github.com/wellfernandes/tasksun.git
```
Abra a pasta do projeto utilizando a sua IDE.

### Backend
Vamos iniciar pelo backend, pois precisamos dele em execução para subir sem erros o frontend.
    
1. Entre na pasta backend executando o comando:
    
    ```
    cd backend/
    ```
2. Em seguida, execute o comando para iniciar os containers Docker:

    ```
    docker compose up -d
    ```
    **OBSERVAÇÃO:** Em caso de erro, execute o comando para fazer o build sem utilizar o cache:
    
    ```
    docker compose build --no-cache
    ```
    Aguarde a finalização do build e em seguida execute o comando:
    
    ```
    docker compose up -d
    ```
Excelente! Agora você já tem o backend em execução.

### Frontend
Com o backend em execução, vamos agora iniciar o frontend.

1. Vá para a pasta frontend. Se estiver na raiz do projeto, execute o comando:
    ```
    cd frontend/
    ```
2. Em seguida, execute o comando para iniciar o container Docker:
    ```
    docker compose up -d
    ```
    **OBSERVAÇÃO:** Em caso de erro, execute o comando para fazer o build sem utilizar o cache:
        
    ```
    docker compose build --no-cache
    ```
    Aguarde a finalização do build e em seguida execute o comando:
        
    ```
    docker compose up -d
    ```
Excelente! Agora você o frontend está em execução e você já pode acessar o **TaskSun - Gerenciador de Tarefas**.

## Dados de Login
- Por padrão a url de acesso é: http://localhost:3000

    - Email: admin@tasksun.com.br
    - Senha: @Tasksun123
    
- Para cadastrar um novo usuário acesse: http://localhost:3000/register

## 📄 Documentação 
### Usando Swagger Docs
Para acessar o swagger, que permite testar todas as rotas da aplicação, acesse:

Swagger - http://localhost/api/v1/docs

1. Após acessar faça o login, para que seja gerado o token de autenticação.

2. Com o token copiado, faça a autenticação clicando no botão superior direito **Authorize**. Basta inserir o token (sem a necessidade de inserir a palavra Bearer antes) e clicar em **Authorize** e **Close**.

3. Neste momento você deve já estar autenticado, o que possibilita testar qualquer rota da aplicação.
- **Auth:** Operações relacionadas à autenticação.
- **Tasks:** Operações relacionados a tarefas.
- **Users:** Operações relacionadas a usuários.

Ao selecionar uma das opções serão exibidas todas as rotas da categoria.


## 🌐 Contato
- [Linkedin](https://www.linkedin.com/in/wellitonfernandes/)