# 📋 Desafio Técnico: Desenvolvedor Pleno Full Stack (Laravel/Vue)

## 🎯 Como subir o projeto

### Obs.: Necessário ter o docker instalado;

1. ✅ **Acesse o terminal para rodar os comandos seguintes;**
2. ✅ **Clonar projeto e acessar diretório:** git clone git@github.com:bryan-alves/coding-challenge.git && cd coding-challenge;
3. ✅ **Baixar e acessar branch do desafio:** git fetch origin bryan-alves && git checkout bryan-alves;
4. ✅ **Configurar .env:** Linux / Mac: cp .env.example .env; Windows: copy .env.example .env;
5. ✅ **Subir o projeto:** docker compose up (Sobe o mysql, a aplicação e rodar alguns comandos necessários, inclusive db:seed para preencher Usuário e Canais);
6. ✅ **Entrar no container da aplicação:** docker exec -it pipelead-app bash;
7. ✅ **Comando para gerar os contatos:** php artisan contacts:generate (Irá gerar 20 contatos);
8. ✅ **Comando para gerar os mensagens:** php artisan messages:generate (Irá gerar 50 mensagens para diversos contatos);
