1. git clone
2. check composer version minimal version 2 (composer --version)
3. php version minimal 8.2 (php --version)
4. run composer install (composer install)
5. run migration for db (php artisan migrate)
6. run seeder for db badge (php artisan db:seed --class=BadgeSeeder)
7. create .htaccess (RewriteEngine on
   RewriteCond %{REQUEST_URI} !^public
   RewriteRule ^(.\*)$ public/$1 [L])
8. PHP artisan storage:link
9. add is_production=false in .env

BELOW IS FOR VITE PROBLEM IN SERVER. PUT IT IN HEAD TAG IN HTML. THEN IMPORT VITE BUILD FROM PROGRAMMER FILE

<link rel="stylesheet" href="{{ asset('build/assets/app-B5SqYNYV.css') }}">
<script src="{{ asset('build/assets/app-D0coJpzG.js') }}"></script>
