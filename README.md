# favicon

[![Build Status](https://travis-ci.org/letrunghieu/favicon.svg?branch=master)](https://travis-ci.org/letrunghieu/favicon) [![Latest Stable Version](https://poser.pugx.org/hieu-le/favicon/v/stable.svg)](https://packagist.org/packages/hieu-le/favicon) [![Total Downloads](https://poser.pugx.org/hieu-le/favicon/downloads.svg)](https://packagist.org/packages/hieu-le/favicon) [![Latest Unstable Version](https://poser.pugx.org/hieu-le/favicon/v/unstable.svg)](https://packagist.org/packages/hieu-le/favicon) [![License](https://poser.pugx.org/hieu-le/favicon/license.svg)](https://packagist.org/packages/hieu-le/favicon)

A configurable PHP solution to auto generate favicons and HTML meta tags from a original PNG file.

## What does this package do?

In short, it will help you display correct favicon for your website with just **one** original PNG image.

In more details, this package will generate these stuffs from your PNG image:

| File name       	| Image size    	| Explanation                                                                                   	|
|-----------------	|---------------	|-----------------------------------------------------------------------------------------------	|
| favicon.ico     	| 16x16 & 32x32 	| Default required by IE                                                                        	|
| favicon-32.png  	| 32x32         	| Favicons targeted to any additional png sizes                                                 	|
| favicon-57.png  	| 57x57         	| For non-Retina iPhone, iPod Touch, and Android 2.1+ devices                                   	|
| favicon-72.png  	| 72x72         	| For first- and second-generation iPad, iPad home screen icon                                  	|
| favicon-114.png 	| 114x114       	| For iPhone with high-resolution Retina display running iOS ≤ 6                                	|
| favicon-120.png 	| 120x120       	| For iPhone with high-resolution Retina display running iOS ≥ 7                                	|
| favicon-144.png 	| 144x144       	| For iPad with high-resolution Retina display running iOS ≤ 6, IE10 Metro tile for pinned site 	|
| favicon-152.png 	| 152x152       	| For iPad with high-resolution Retina display running iOS ≥ 7                                  	|

Except the `ico` file that is allways generated, all other images can included in your final result or not via some configurations. This packages can also generate correct `link` tags for each type of *favicon*. Thanks [audreyr](https://github.com/audreyr/favicon-cheat-sheet) for the cheatsheet that helped me a lot.

## Installation

We need [PHP imagick extension](http://php.net/manual/en/book.imagick.php) for generating iamges, if you just use the HTML function, this extension is not need.

You will need (Composer)[] to use this package. After install Composer, add this dependency into your `composer.json` file.

```
"hieu-le/favicon" : "~1.0"
```

Run `composer update` and start using.

## Generate images

The basic syntax: generate the `ico` file only:

```
$ vendor/bin/favicon generate your-input-image
```

To generate all available `png` images along with the default `ico` file:

```
$ vendor/bin/favicon generate your-input-image --all
```

You can choose to generate just come `png` size by use appropritate command line options. To list all available options, use the command:

```
$ vendor/bin/favicon generate --help
```

To save time, you can use a **config file** which contains a JSON content to tell the generator which images to be include in the result. Intead of passing individual options, tell the generator use a config file by:

```
$ vendor/bin/favicon generate your-input-image --config
```

By default, the config file is `favicon.json`. However, you can specify another file by using `--config-file` option, for example

```
$ vendor/bin/favicon generate your-input-image --config --config-file=path/to/json/file
```

You can save all current settings from command line options to the config file to use later by passing the `--save` option to the command.

## Configuration file

A full configuration file will be like this

```
{
    "sizes": {
        "touch": 1,    /* include 152x152 png for touch devices */
        "fav": 1,      /* include 32x32 png for all devices */
        "fav-57": 1,   /* include 57x57 png */
        "ms": 1,       /* include 144x144 png and other info for windows tile */
        "touch-152": 1,/* include 152x152 png */
        "touch-144": 1,/* include 144x144 png */
        "touch-120": 1,/* include 120x120 png */
        "touch-114": 1,/* include 114x114 png */
        "touch-72": 1  /* include 72x72 png */
    },
    "ms-tile-color": "#FFFFFF" /* the background color for windows tile */
}
```

Some configurations are not used by the generator but for the HTML dumper, which is introduced in the next section.

## Ouput HTML link tags

After having images, to tell browsers that you have these favicon, you need include some HTML. Fortunately, this package will do this for you. Two things you need is `Config` and `Html` class.

A configuration, which is an instance of `HieuLe\Favicon\Config` class can be created frin scratch and add more settings later; or created from an PHP array; or from a file that contains JSON string (see the config file above)

```
use HieuLe\Favicon\Config

$config = new Config;
$config->allOn()  // turn on all options (all available options are used)
       ->allOff() // turn off all options (only ico file is used)
       ->turnOn('touch') // use `touch` option
       ->turnOff('fav-57') // do not use `fav-57` option
       ->setTileBackground('#f0f0f0') // use the #f0f0f0 color for windows tile


# Config can be imported from an PHP array, invalid options are ignored
$config = Config::fromArray($array);

# Or via a text file with JSON content
$config = Config::fromFile('favicon.json');

```

As you can see, the `Config` methods are mostly chainable. 

After create a configuration, we use it to create the HTML dumper and output link tags

```
$html = new HieuLe\Favicon\HTML($config)

# use in your HTML template
$html->output();
```

With the configuration as the example JSON file above, we fill have the following HTML:

```
<meta name='msapplication-TileColor' content='#F0F0F0'>
<meta name='msapplication-TileImage' content='/favicon-144.png'>
<link rel='icon href='/favicon-32.png' sizes='32x32>
<link rel='apple-touch-icon-precomposed' href='/favicon-152.png'>
<link rel='apple-touch-icon-precomposed' href='/favicon-57.png'>
<link rel='apple-touch-icon-precomposed' sizes='152x152' href='/favicon-152.png'>
<link rel='apple-touch-icon-precomposed' sizes='144x144' href='/favicon-144.png'>
<link rel='apple-touch-icon-precomposed' sizes='120x120' href='/favicon-120.png'>
<link rel='apple-touch-icon-precomposed' sizes='114x114' href='/favicon-114.png'>
<link rel='apple-touch-icon-precomposed' sizes='72x72' href='/favicon-72.png'>
```

## License

The package is released under MIT license. See the [`LICENSE`](https://github.com/letrunghieu/favicon/blob/master/LICENSE) file for more detail.