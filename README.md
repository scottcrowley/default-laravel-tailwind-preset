# Laravel 5.7+ Frontend preset for Tailwind CSS

A Laravel front-end scaffolding preset for [Tailwind CSS](https://tailwindcss.com) - a Utility-First CSS Framework for Rapid UI Development.

*Current version:* **Tailwind CSS 0.7.4**

## What it does

1. Upgrades **laravel-mix** to **4.0.12**
2. Installs **laravel-tailwind 0.1.0**
3. Installs **tailwindcss 0.7.4**
4. Removes **jquery** & **bootstrap**
5. Adds an in memory **sqlite** database connection for phpunit.
6. Removes the **css** directory within the **resources/** directory.
7. Adds `primary`, `secondary` & `error` colors to the **tailwind.js** file. These colors are currently set to orange, grey & red respectively. They can then be used to assign primary and secondary colors to backgrounds, text, borders, etc. and contain the same shading as the rest of the colors. e.g. `text-primary-lighter`, `bg-secondary-darkest`, `text-error-darker`
8. Adds a `_btn` and `_text` partial with basic styling in the **sass** directory.
9. Updates all relevant views to use the new primary, secondary and error color styles.
10. -auth preset will add the HomeController along with all relevant views and routes.


## Usage

1. Fresh install Laravel >= 5.7.0 and cd to your app.
2. Install this preset via `composer require sc-laravel-presets/default-tailwindcss`. Laravel will automatically discover this package. No need to register the service provider.
3. Use `php artisan preset default-tailwind` for the basic Tailwind CSS preset OR use `php artisan preset default-tailwind-auth` for the basic preset, auth route entry and Tailwind CSS auth views in one go. (NOTE: If you run this command several times, be sure to clean up the duplicate Auth entries in `routes/web.php`)
4. `npm install && npm run dev && npm run dev` (this is required twice, due to the way that `laravel-mix-tailwind` installs the Tailwind CSS dependency)
5. Configure your favorite database (mysql, sqlite etc.)
6. `php artisan migrate` to create basic user tables.
7. `php artisan serve` (or equivalent) to run server and test preset.

### Config

The default `tailwind.js` configuration file included by this package uses primary & secondary colors. Should you wish to make changes, you should remove the file and run `node_modules/.bin/tailwind init`, which will generate a fresh configuration file for you, which you are free to change to suit your needs.
