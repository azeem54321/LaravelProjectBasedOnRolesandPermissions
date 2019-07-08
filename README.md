# Laravel Project Associate users with permissions and roles
This Project is based on ACL , Different Type of Guard ,Crud Generator and Passport
### Install
1. To use it just clone the repo and composer install.
2. `cp .env.example .env`
3. Update the database credentials in `.env`
4. run `php artisan key:generate`

### Database
Import Databse from public folder
### Crud Generator
#### Eg:
php artisan crud:generate Posts --fields='title#string; description#text; status#select#options={"1": "Active", "0": "Disabled"}'  --view-path=admin --controller-namespace=Admin --route-group=admin --soft-deletes=yes --validations='title#required' --form-helper=html

### Add Permission:
#### Eg:
php artisan auth:permission Post

## Remove Permission:
#### Eg:
php artisan auth:permission Post --remove


