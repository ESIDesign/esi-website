## To dump data from local to prod

* `wp search-replace "http://esidesigndev.staging.wpengine.com" "http://esi.hgv.test"` - Run this for dump to staging
* `wp search-replace "http://esi.hgv.test/" "http://esidesigndev.staging.wpengine.com"` - Run this for dump to staging
* `wp search-replace "http://esi.hgv.test/" "http://esidesigndev.wpengine.com"` - Run this for dump to prod
* `wp search-replace "http://esidesigndev.wpengine.com" "http://hhvm.hgv.test"` - Run this after dump



## Theme setup

Edit `src/setup.php` to enable or disable theme features, setup navigation menus, post thumbnail sizes, post formats, and sidebars.

## Theme development

Sage uses [Webpack](https://webpack.github.io/) as a build tool and [npm](https://www.npmjs.com/) to manage front-end packages.

### Install dependencies

From the command line on your host machine (not on your Vagrant development box), navigate to the theme directory then run `npm install`:

```shell
# @ example.com/site/web/app/themes/your-theme-name
$ npm install
```

You now have all the necessary dependencies to run the build process.

### Build commands

* `npm start` — Compile assets when file changes are made, start BrowserSync session
* `npm run build` — Compile and optimize the files in your assets directory
* `npm run build:production` — Compile assets for production

#### Additional commands

* `npm run clean` — Remove your `dist/` folder
* `npm run lint` — Run eslint against your assets and build scripts
* `composer test` — Check your PHP for code smells with `phpmd` and PSR-2 compliance with `phpcs`

### Using BrowserSync

To use BrowserSync during `npm start` you need to update `devUrl` at the bottom of `assets/config.json` to reflect your local development hostname.

If your local development URL is `https://project-name.dev`, update the file to read:
```json
...
  "devUrl": "https://project-name.dev",
...
```

By default, BrowserSync will use webpack's [HMR](https://webpack.github.io/docs/hot-module-replacement.html), which won't trigger a page reload in your browser.

If you would like to force BrowserSync to reload the page whenever certain file types are edited, then add them to `watch` in `assets/config.json`.

```json
...
  "watch": [
    "assets/scripts/**/*.js",
    "templates/**/*.php",
    "src/**/*.php"
  ],
...
```

## Documentation

Sage 8 documentation is available at [https://roots.io/sage/docs/](https://roots.io/sage/docs/).

## Development Notes

In terms of keeping consistency, when integrating the templates into wordpress fields, follow the following guidelines:

### Naming Field Groups

This should just be '<Name> Page' or '<Name> Post'. For rules, set them as Page Template or Post Type.

### Naming Fields

These are for all fields, and can/often are prefaced by a `pageName_` descriptor. The exceptions are when these fields are nested, or only used once on a page.
	
  - header_image: These are landing/splash images for each page, generally lazy loaded in.
  - headline: these are long, shorter blocks of texts, either above smaller blocks of text or not. generally single text lines.
  - subheadline: this is occassionally flavor text underneath the main catching headline 
  - text: these go underneath headlines, and are generally optional. They add breif descriptions about the sections
  - block: these are WYSIWYG editors, make sure that they do not have &lt;p&gt; wrapping tags (NOTE: this is generally not used, as much of the site as JS dependent naming which causes this text to disappear in the editor)

### Building Fields

This is standard on how you create advanced custom fields, in terms of actually linking WP formats to the associated frontend templates

  - Text Area: Make sure these have no formatting selected on the field creation section, as this will prevent style removal for single lines of nested text/spans
  - Images: These are to be displayed as Image URLs, since they are used inline across the board (If used differently on the site, it must be noted in here)
  - Files/Videos: These are to be displayed as File Arrays, as Kei built this out and I'm mostly copying his stuff.
  - Repeaters: mostly sliders, try and keep the name 'repeater' off the field. Keep to plural vs singular, 'names' --> 'name'

### TODOS?
  - Kei has some images pulling via ID, maybe either replace my process or replace his?
