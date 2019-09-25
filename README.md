# Laravel 6+ Frontend preset for Tailwind CSS

A Laravel front-end scaffolding preset for [Tailwind CSS](https://tailwindcss.com) - a Utility-First CSS Framework for Rapid UI Development.

*Current version:* **Tailwind CSS 1.1.2**

## What it does

1. Upgrades **laravel-mix** to **4.1.2**
2. Installs **postcss-import 12.0.1**
3. Installs **postcss-nesting 7.0.1**
4. Installs **tailwindcss 1.1.2**
5. Installs **vue 2.6.10**
6. Installs **vue-template-compiler 2.6.10**
7. Removes **jquery** & **bootstrap** & **sass**
8. Adds an in memory **sqlite** database connection for phpunit in the `phpunit.xml` file.
9. Configures Webpack to use PostCss and not sass, since Tailwind is a PostCss plugin. With the `postcss-nesting` plugin installed, you are able to write nested css that looks very much like sass, but is using standard css files.
10. Adds `primary`, `secondary`, `success`, `warning`, `danger` & `error` colors along with a default font to the **tailwind.config.js** file. These colors are currently set to blue, gray, green, orange, red & red respectively. They can then be used to assign primary and secondary colors to backgrounds, text, borders, etc. and contain the same shading as the rest of the colors. e.g. `text-primary-500`, `bg-secondary-300`, `text-error-600`
11. Adds a `core`, `button`, `dropdown`, `loader` and `nav` partial with basic styling in the **css/components** directory.
12. Updates all relevant views to use the Tailwind classes instead of Bootstrap.
13. `-auth` preset will add the HomeController along with all relevant views and routes.


## Usage

1. Fresh install Laravel >= 6 and cd to your app.
2. Install this preset via `composer require sc-laravel-presets/default-tailwindcss`. Laravel will automatically discover this package. No need to register the service provider.
3. Use `php artisan preset default-tailwind` for the basic Tailwind CSS preset OR use `php artisan preset default-tailwind-auth` for the basic preset, auth route entry and Tailwind CSS auth views in one go. (NOTE: If you run this command several times, be sure to clean up the duplicate Auth entries in `routes/web.php`)
4. `npm install && npm run dev` 
5. Configure your favorite database (mysql, sqlite etc.)
6. `php artisan migrate` to create basic user tables.
7. `php artisan serve` (or equivalent) to run server and test preset.

### Config

The default `tailwind.config.js` configuration file included by this package uses custom color names. Should you wish to make changes, you can easily do so by modifying this file. See the [Tailwind documentation](https://tailwindcss.com/docs/configuration) for more detail.
