# Laravel Congruent

..... 

## Getting Started

### 1. Install

Run the following command:

```bash
composer require byancode/congruent
```

### 2. Register (for Laravel > 6.0)

Register the service provider in `config/app.php`

```php
Byancode\Congruent\Providers\Service::class,
```

### 3. Publish

Publish config file.

```bash
php artisan vendor:publish --provider="Byancode\Congruent\Providers\Service" --force
```


### 4. Configure

You can change the options of your app from `config/congruent.php` file
