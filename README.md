## Library

Library system for manage authors and books also admin can manage users 

## Instalation steps
1. git clone git@github.com:programermaster/library.git .
2. composer install
3. create database "library"
4. edit .env file and change connection params for connecting to db
5. php artisan migrate:fresh --seed
6. php artisan storage:link
7. php artisan serve
8. open in browser tab http://127.0.0.1:8000
9. click on login http://127.0.0.1:8000/login
10. username : librarian@admin.com    pass: librarian123  for access whole admin
11. username : reader123@admin.com    pass: reader123  for access books area
