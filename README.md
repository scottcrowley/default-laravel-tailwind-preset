# Laravel 6+ Frontend preset for Tailwind CSS

A Laravel front-end scaffolding preset for [Tailwind CSS](https://tailwindcss.com) - a Utility-First CSS Framework for Rapid UI Development.

*Current version:* **Tailwind CSS 1.1.2**

## What it does

1. Upgrades **laravel-mix** to **4.1.2**
1. Installs **postcss-import 12.0.1**
1. Installs **postcss-nesting 7.0.1**
1. Installs **tailwindcss 1.1.2**
1. Installs **@tailwindcss/custom-forms 0.2.1**
1. Installs **vue 2.6.10**
1. Installs **vue-template-compiler 2.6.10**
1. Removes **jquery** & **bootstrap** & **sass**
1. Adds an in memory **sqlite** database connection for phpunit in the `phpunit.xml` file.
1. Configures Webpack to use PostCss and not sass, since Tailwind is a PostCss plugin. With the `postcss-nesting` plugin installed, you are able to write nested css that looks very much like sass, but is using standard css files.
1. Adds `primary`, `secondary`, `success`, `warning`, `danger` & `error` colors along with a default font to the **tailwind.config.js** file. These colors are currently set to blue, gray, green, orange, red & red respectively. They can then be used to assign primary and secondary colors to backgrounds, text, borders, etc. and contain the same shading as the rest of the colors. e.g. `text-primary-500`, `bg-secondary-300`, `text-error-600`
1. Adds a `core`, `button`, `dropdown`, `loader` and `nav` partial with basic styling in the **css/components** directory.
1. Uses custom form classes from the [tailwindcss/custom-forms](https://github.com/tailwindcss/custom-forms) package.
1. Updates all relevant views to use the Tailwind classes instead of Bootstrap.
1. `-auth` preset will add the HomeController along with all relevant views and routes.


## Usage

1. Fresh install Laravel >= 6 and `cd` to your app.
1. Install this preset:
    *Laravel will automatically discover this package. No need to register the service provider.*
    ```bash
    composer require sc-laravel-presets/default-tailwindcss
    ```
1. Run the preset installer:

    *Command to install only the base preset without any of the authorization scafolding.*
    ```bash
    php artisan preset default-tailwind
    ```
    *Command to install the full preset with the authorization scafolding (auth route entry, Tailwind CSS auth views).*
    ```bash
    php artisan preset default-tailwind-auth
    ```
    ***NOTE: If you run this command several times, be sure to clean up the duplicate Auth entries in `routes/web.php`***
1. Install all the node dependencies and compile all the assets:
    ```bash
    npm install && npm run dev
    ``` 
1. Configure your favorite database (mysql, sqlite etc.). See the [Laravel documentation](https://laravel.com/docs/6.x/database) for more details.
1. Migrate your database, if needed:
    ```bash
    php artisan migrate
    ```
1. Start your local web server by running either of the following commands:

    *Command to start up [Laravel Valet](https://laravel.com/docs/6.x/valet)*
    ```bash
    valet start
    ```
    *Or use if you are not using Valet*
    ```bash
    php artisan serve
    ```
1. View your site in the browser to test the new preset.

### Config

The default `tailwind.config.js` configuration file included by this package uses custom color names. Should you wish to make changes, you can easily do so by modifying this file. See the [Tailwind documentation](https://tailwindcss.com/docs/configuration) for more detail.

The `tailwindcss/custom-forms` customization is also in the `tailwind.config.js` file under the `customForms` key. See their [documentation](https://tailwindcss-custom-forms.netlify.com/) if you want to change any of the form styling.
