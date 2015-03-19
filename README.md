# favicon

[![Build Status](https://travis-ci.org/letrunghieu/favicon.svg?branch=master)](https://travis-ci.org/letrunghieu/favicon) [![Latest Stable Version](https://poser.pugx.org/hieu-le/favicon/v/stable.svg)](https://packagist.org/packages/hieu-le/favicon) [![Total Downloads](https://poser.pugx.org/hieu-le/favicon/downloads.svg)](https://packagist.org/packages/hieu-le/favicon) [![Latest Unstable Version](https://poser.pugx.org/hieu-le/favicon/v/unstable.svg)](https://packagist.org/packages/hieu-le/favicon) [![License](https://poser.pugx.org/hieu-le/favicon/license.svg)](https://packagist.org/packages/hieu-le/favicon)

A configurable PHP solution to auto generate favicons and HTML tags from a original PNG file.

## What does this package do?

In short, it will help you display correct favicon for your website with just **one** original PNG image.

In more details, it supports:

* create **one** ICO file and **many** PNG files with many favicon sizes from just **one** original PNG image as well as a `manifest.json` file for Android devices. Both input file path and output folder (which contains images and json files) are configurable via a command line interface.
* Generate suitable `meta` and `link` tags for desktop web browsers as well as mobile touch devices to properly display favicon.

## Installation

We need [PHP imagick extension](http://php.net/manual/en/book.imagick.php) or [PHP GD extension](http://php.net/manual/en/book.image.php) for generating images. By default, the Imagick extension is loaded, if you cannot install it, you can switch to using GD ~~via command line option~~ if available.

You will need (Composer)[] to use this package. After install Composer, add this dependency into your `composer.json` file.

```
"hieu-le/favicon" : "~1.0"
```

Run `composer update` and start using.

## Generate images

To use the command line to to generate favicon files: 

```
$ vendor/bin/favicon generate [-g|--use-gd] [--ico-64] [--ico-48] [--no-old-apple] [--no-android] [--no-ms] [--app-name="..."] input [output]
```

Arguments:

* `input`: path to the input image files, which is required
* `output`: path to the folder which contains output files. If this folder does not exist, the package will try to create it. This argument is optional, default value is current folder.

Options:

* ~~`--use-gd`: use GD extension instead of Imagick extension~~ The Imagick ext is used by default. GD library is used if cannot load Imagick ext.
* `--ico-64`: include the 64x64 image inside the output ICO file (which contains only 16x16 and 32x32 images by default)
* `--ico-48`: include the 48x48 image inside the output ICO file (which contains only 16x16 and 32x32 images by default). Both `--ico-48` and `--ico-64` options make the output icon file larger a lot.
* `--no-old-apple`: exclude pngs files that used by old Apple touch devices
* `--no-android`: exclude `manifest.json` files and PNG files for Android devices
* `--no-ms`: exclude images for Windows tile
* `--app-name="..."` set the application name in the `manifest.json` file. Default is an empty string.

## Output HTML tags

Call the `favicon` function inside your HTML template as follow:

```php
echo favicon($option = FAVICON_ENABLE_ALL, array $msOptions = array())
```

The `$option` argument is a bitmask with following bit:

* `FAVICON_NO_OLD_APPLE` :  do not include old apple touch `link` tags
* `FAVICON_NO_ANDROID` : do not include Android `manifest.xml` link tag
* `FAVICON_NO_MS` : do not include Windows and IE `meta` tags

The default value is `FAVICON_ENABLE_ALL` turns of all these three bit and include everything in the final output. Here are some examples:

* To exclude old apple touch `link` tags: `FAVICON_NO_OLD_APPLE`
* To exclude Android manifest file and IE `meta` tags: `FAVICON_NO_ANDROID | FAVICON_NO_MS`
* To exclude all these additional tags: `FAVICON_NO_OLD_APPLE | FAVICON_NO_ANDROID | FAVICON_NO_MS`

The `$msOptions` argument is an array contains information for Windows and IE. It can has these fields:

* `tile_color`: the background of live tile when this site is pinned, default is white (`#ffffff`)
* `browser_config_file`: the path to browser config XML file if you have it. By default, it is set to an empty string to prevent IE from auto looking `browserconfig.xml` file
* `application_name`: the default application name displayed when user pinned this site

The result of 

```php
echo favicon(FAVICON_ENABLE_ALL, array(
  'tile_color' => '#F0F0F0', 
  'browser_config_file' => 'IEConfig.xml', 
  'application_name' => 'Hieu Le Favicon'
));
```
is a HTML segment link this:

```html
<meta name="msapplication-config" content="/IEConfig.xml" />
<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png" />
<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png" />
<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192" />
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16" />
<link rel="manifest" href="/manifest.json" />
<meta name="application-name" content="Hieu Le Favicon" />
<meta name="msapplication-TileColor" content="#F0F0F0" />
<meta name="msapplication-TileImage" content="/mstile-144x144.png" />
<meta name="msapplication-square70x70logo" content="/mstile-70x70.png" />
<meta name="msapplication-square150x150logo" content="/mstile-150x150.png" />
<meta name="msapplication-wide310x150logo" content="/mstile-310x150.png" />
<meta name="msapplication-square310x310logo" content="/mstile-310x310.png" />
```


## License

The package is released under MIT license. See the [`LICENSE`](https://github.com/letrunghieu/favicon/blob/master/LICENSE) file for more detail.