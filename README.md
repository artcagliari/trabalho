# CRM para Psicóloga (Laravel)

## Estrutura do projeto
- Projeto Laravel principal: `crm-psicologa/`
- Front-end Blade/CSS/JS integrado nesse projeto:
  - `crm-psicologa/resources/views`
  - `crm-psicologa/public/css/style.css`
  - `crm-psicologa/public/js/script.js`

## Como rodar
1. `cd crm-psicologa`
2. Configurar `.env` com SQLite ou MySQL
3. `php artisan key:generate`
4. `php artisan migrate`
5. `php artisan serve`

## Banco SQLite
- Criar arquivo `crm-psicologa/database/database.sqlite`
- No `.env`:
  - `DB_CONNECTION=sqlite`
  - `DB_DATABASE=/caminho/completo/crm-psicologa/database/database.sqlite`

## Apresentação rápida
- Abrir `/` para dashboard
- Mostrar cadastro de paciente
- Mostrar criação de sessão e anotação vinculadas ao paciente
- Mostrar edição e exclusão com confirmação
- Mostrar visual glassmorphism responsivo
