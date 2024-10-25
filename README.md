### Portas:

- backend: 8001
- frontend: 8085
- phpmyadmin: 8002
- mailhog: 8003

### Comandos Docker:
#### Para utilizar o docker: 
- `docker compose up --build -d`
#### Para instalar algum pacote no front: 
- `docker compose run --rm npm COMANDO`

## Comandos para Criar Branches:

### Criar Branch Nova
Para criar uma nova branch e alternar para ela, use o comando:
- `git checkout -b @user/feature/nome-funcionalidade`

### Enviar a Branch para o Repositório Remoto
Para enviar a nova branch para o repositório remoto, utilize:
- `git push origin @user/feature/nome-funcionalidade`

### Fazer Alterações e Comitar
Após fazer as alterações necessárias, adicione as mudanças e faça um commit:
- `git add .`
- `git commit -m "Descrição das alterações na funcionalidade"`

### Enviar a Branch para o Repositório Remoto
Para enviar a nova branch para o repositório remoto, utilize:
- `git push origin @user/feature/nome-funcionalidade`

### Mesclar a Branch com a Branch Principal
Quando a funcionalidade estiver pronta, você pode mesclar a branch de volta à branch principal (geralmente main):
- `git checkout main`  
- `git merge @user/feature/nome-funcionalidade`

### Remover a Branch Após Mesclagem (Opcional)
Após a mesclagem, se não precisar mais da branch, você pode removê-la:
- `git branch -d @user/feature/nome-funcionalidade`
