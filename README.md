# Setup
1. Clone the repository
2. `composer install`
3. Copy `.env.example` to `.env`
4. Configure the `DB_CORE` and `DB` variables in the `.env`
5. Run the core migrations using the following command `php artisan mtb:migrate core`
6. Create a tenant in the `core.tenants` table
    1. The `slug` in this table will be this tenants Database Name
7. Associate a domain with that tenant in the `core.domains` table
    1. The `is_root` column is not used in this example
8. Run the tenant migrations using the following command `php artisan mtb:migrate tenant TENANT_DOMAIN_HERE`
9. When you browse to the domain created in 7. you should see the tenant information
10. The `Users.php` model uses the _tenant database_

## Other Info
* In this example there is no way to run migrations for a tenant instance
* Models created for tenant instances should be similar to the `User.php` model
* Models created for the core instance should be similar to the `Domain.php` or `Tenant.php` models 