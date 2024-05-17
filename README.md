<div align="center">

# Laravel Tayar - لارافل تيار

</div>

## Introduction - المقدمة

Laravel Tayar is Laravel Jetstream on [Fesikh](https://en.wikipedia.org/wiki/Fesikh). It is a fork that adds some important enhancements that are not supported out of the box and can take time when setting projects up. This should help you avoid wasting several hours implementing these needed features for every new project you create. 

Please note that this mainly focuses on the Inertia (Vue.js) stack at the moment with some but not full attention given to the Livewire side, though it can also be a better starting point than Jetstream for Livewire projects also for some features (The localisation files can still be used with minimal effort for example).

## Features - الخصائص

- Localisation support using `laravel-vue-i18n`, with English and Arabic translations included out of the box.
- Supports right-to-left (RTL) layouts for specified languages.

## Installation - التثبيت

Start with creating a new Laravel project:

```bash
composer create-project laravel/laravel tayar-app

cd tayar-app
```

Add the following to your `composer.json` file (replace `{branch}` with any branch you want to use from the Tayar repository):

```
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/helwy/tayar"
        }
    ],
    "require": {
        "laravel/jetstream": "dev-{branch}"
    }
}
```

Then run composer update:

```bash
composer update
```

There are multiple different configurations for the default jetstream installation, you can find more about it [here](https://jetstream.laravel.com/installation.html), but for the one mainly used while developing this fork, I install with Inertia (Vue 3) and Dark mode support.

```bash
php artisan jetstream:install inertia --dark
```

Finalise the installation

```bash
npm install
npm run build
php artisan migrate
```

Then serve your application

```bash
php artisan serve
```

## Usage - الاستخدام

- **RTL Layout Support** - In order to use the RTL layout for certain langauges, go to the `config/jetstream.php` and look for the `rtl_locales` key in the Tayar configurations section. Add or removes the locales you want to support RTL for in this array. The default is only Arabic.

## Important Links - الروابط المهمة

- [Laravel Documentation](https://laravel.com/)
- [Laravel Jetstream Documentation](https://jetstream.laravel.com)
- [Laravel GitHub Repository](https://github.com/laravel/laravel)
- [Laravel Jetstream GitHub Repository](https://github.com/laravel/jetstream)

## License - الترخيص

Laravel Tayar is open-sourced software licensed under the [MIT license](LICENSE.md).
