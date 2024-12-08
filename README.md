<div align="center">

# Laravel Tayar - لارافل تيار

</div>

## Introduction - المقدمة

Laravel Tayar is Laravel Jetstream on [Fesikh](https://en.wikipedia.org/wiki/Fesikh). It is a fork that adds some important enhancements that are not supported out of the box and can take time when setting projects up. This should help you avoid wasting several hours implementing these needed features for every new project you create. 

Please note that this mainly focuses on the Inertia (Vue.js) stack at the moment with some but not full attention given to the Livewire side, though it can arguably be a better starting point than Jetstream for Livewire projects if you still need the features listed.

## Features - الخصائص

- Localisation support using `laravel-vue-i18n`, with English and Arabic translations included out of the box.
- Supports right-to-left (RTL) layouts for specified languages.
- "All or Essential only" cookies consent modal.
- Language switcher in the top navigation bar, persisted in a cookie and user database.
- Dark mode support and toggle in top bar, persisted in a cookie and user database.
- Admin boolean for users, and dashboard / control panel only accessible to them.
- Admin layout with a fixed top navigation bar and a fixed sidebar. Unified navigation items variable.
- Frontend layout template.
- Adjustments to make Arabic text look better in the UI, and to make the frontend default layout more suitable for the added features, such as dark mode toggle and language switcher.

## Installation - التثبيت

Start with creating a new Laravel project:

```bash
composer create-project laravel/laravel tayar-app

cd tayar-app

composer require helwy/tayar:5.x-dev
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

- **Available Locales** - The available locales are defined in the `config/jetstream.php` file using the the `available_locales` key in the Tayar configurations section. You can add or remove locales from there. When you add an unsupported locale (doesn't have a translation file yet), you will have to create the translation files for it in the `resources/lang` directory. The default locales are English and Arabic.
- **RTL Layout Support** - In order to use the RTL layout for certain langauges, go to the `config/jetstream.php` and look for the `rtl_locales` key in the Tayar configurations section. Add or removes the locales you want to support RTL for in this array. The default is only Arabic.

## Versioning - الإصدارات

Laravel Tayar will be matching and updating with the latest Laravel Jetstream version, with the added features and enhancements. The versioning will be following the Laravel Jetstream versioning, with one extra number for the Tayar versioning. For example, Laravel Jetstream v5.3.3 will be Laravel Tayar v5.3.3.0.

## Important Links - الروابط المهمة

- [Laravel Documentation](https://laravel.com/)
- [Laravel Jetstream Documentation](https://jetstream.laravel.com)
- [Laravel GitHub Repository](https://github.com/laravel/laravel)
- [Laravel Jetstream GitHub Repository](https://github.com/laravel/jetstream)

## FAQ - الأسئلة الشائعة

1. **What to do if I don't want to have multiple locales?**
- By keeping only one locale in the `available_locales` array in configuration, the language switcher will not be displayed in the UI, and you won't have to worry too much about localisation, though I would advise to keep using the localisation files for any static text in your application to make it easier to localise in the future if needed.

2. **What if I don't need RTL languages?**
- Keeping the `rtl_locales` in the configuration file as an empty array will not use RTL layout for any language. You may also remove the `rtl` class check in the `app.blade.php` body element classes, but that is optional.

3. **How can I make the cookie modal only appear for users in countries that require me to ask for consent?**
- You are what is wrong with this world.

## Roadmap - التخطيط

In no particular order, the following are some of the planned features and enhancements for Laravel Tayar:

- Improvements to the Arabic localisation file.
- More localisation files for other languages to be included.
- Look into general user experience improvements.
- Users list in the admin dashboard.
- Option to change user full name field to first name and last name.
- Notifications for users.
- Tests for the added features.

## Contact - التواصل

If you have any questions or need help with anything, feel free to contact me at [hassanelwy@gmail.com](mailto:hassanelwy@gmail.com). If you have any issues or suggestions, please open an issue on the GitHub repository.

## Contributing - المساهمة

If you would like to contribute to Laravel Tayar, please fork the repository and submit a pull request. Your contributions would be highly appreciated. You can also open an issue if you have any suggestions or issues.

## License - الترخيص

Laravel Tayar is open-sourced software licensed under the [MIT license](LICENSE.md).

Laravel Tayar uses icons from [Hero Icons](https://heroicons.com/) which are licensed under the MIT license.
