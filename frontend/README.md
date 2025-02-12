# Tasksun Frontend
## ⚙️ Como executar o projeto
Siga os passos para executar o projeto tasksun frontend em sua máquina.

### Pré-requisitos
- É necessário ter o **Docker** instalado.

### Instruções de Instalação
Primeiramente, faça o clone do repositório **'tasksun'** localmente em sua máquina:

```
git https://github.com/wellfernandes/tasksun.git
```
Abra a pasta do projeto utilizando a sua IDE.

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
