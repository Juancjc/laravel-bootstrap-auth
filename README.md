# Laravel + Bootstrap (Blade) – Drop-in Kit

Este pacote contém **somente os arquivos necessários** para usar **Bootstrap 5** no lugar do Tailwind
em um projeto **Laravel (11/12) + Breeze (Blade)**.
Este prejeto está pronto para uso então se não funcionar siga os passos.
> Compatível com Laravel 11 e futuros (ex.: 12) mantendo a mesma estrutura de Vite/Blade.

---
## Primeiro uso
- Crie um novo projeto Laravel:
```bash
    composer i 
    npm i
    php artisan serve
    npm run dev
```
## Passos rápidos

1) Remova Tailwind (se existir):
```bash
npm remove tailwindcss postcss autoprefixer
```

2) Instale Bootstrap(se não existir):
```bash
npm i bootstrap @popperjs/core
```

3) Copie os arquivos deste ZIP para **o mesmo caminho** no seu projeto e **sobrescreva** quando pedir.

4) Limpe build antigo e gere de novo:
```bash
rm -rf public/build
npm install
npm run dev
```

5) Rode o app:
```bash
php artisan serve
```

6) Acesse:
- /login
- /register
- /dashboard (exemplo)

---

## O que este kit altera/cria

- `vite.config.js` → adiciona `resources/scss/app.scss` como entrada do Vite
- `resources/js/app.js` → importa `bootstrap/dist/js/bootstrap.bundle`
- `resources/scss/app.scss` → importa `bootstrap/scss/bootstrap`
- `resources/views/layouts/app.blade.php` → layout base com Navbar Bootstrap
- `resources/views/partials/flash.blade.php` → mensagens (status/erros) em Bootstrap
- `resources/views/auth/login.blade.php` → tela de login em Bootstrap
- `resources/views/auth/register.blade.php` → tela de cadastro em Bootstrap
- `resources/views/dashboard.blade.php` → dashboard simples autenticado

### Dicas
- Apague `resources/css/app.css`, `tailwind.config.js` e `postcss.config.js` se não forem mais usados.
- Se o Breeze não estiver instalado, rode:
  ```bash
  composer require laravel/breeze --dev
  php artisan breeze:install blade
  php artisan migrate
  ```
- Caso esteja usando Inertia/Vue, peça a versão Vue deste kit. 😉

