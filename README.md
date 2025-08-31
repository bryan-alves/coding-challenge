# 📋 Desafio Técnico: Desenvolvedor Pleno Full Stack (Laravel/Vue)

## 🎯 Como subir o projeto

### Obs.: Necessário ter o docker instalado;

1. ✅ Acesse o terminal para rodar os comandos seguintes;
2. ✅ git clone git@github.com:bryan-alves/coding-challenge.git && cd coding-challenge;
3. ✅ git fetch origin bryan-alves && git checkout bryan-alves;
4. ✅ Duplicar o arquivo .env.example, colocando o nome de .env, exemplo linux: cp .env.example .env;
5. ✅ docker compose up (Subir o projeto com mysql e a aplicação, rodando os comando necessários);
6. ✅ docker exec -it pipelead-app bash (Entrar no container da aplicação);
7. ✅ php artisan contacts:generate (Comando para gerar os contatos);
8. ✅ php artisan messages:generate (Comando para gerar as mensagens);
