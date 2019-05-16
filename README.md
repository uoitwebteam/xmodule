XModule
=======

[![Latest Stable Version](https://poser.pugx.org/ontariotechu/xmodule/v/stable.svg)](https://packagist.org/packages/ontariotechu/xmodule) [![Total Downloads](https://poser.pugx.org/ontariotechu/xmodule/downloads.svg)](https://packagist.org/packages/ontariotechu/xmodule)
[![Latest Unstable Version](https://poser.pugx.org/ontariotechu/xmodule/v/unstable.svg)](https://packagist.org/packages/ontariotechu/xmodule) [![License](https://poser.pugx.org/ontariotechu/xmodule/license.svg)](https://packagist.org/packages/ontariotechu/xmodule)

PHP library for easily and consistently scaffolding REST API endpoints for [Modo Labs](https://www.modolabs.com/)' __XModule__ feature.

This library provides a suite of PHP classes that directly mirror Modo's [collection of XModule elements](https://xmodule-docs.modolabs.net). It aids in the creation of complex XModule layouts by removing the need for boilerplate JSON and ensuring all XModule pieces fit together seamlessly using object-oriented workflows and strongly-typed parameters.

After being built, scaffolded XModules can have their contents output in fully compliant JSON using only the `json_encode` result of a call to `$xmodule->render()`.

Requirements
============

* PHP >= 7.0.0

Installation
============

```sh
$ composer require ontariotechu/xmodule:dev-master
```

Don't forget to include Composer's autoloader once at the beginning of your application:

```php
require __DIR__ . '/vendor/autoload.php';
```

Usage
=====

Import the needed components into your server application:

```php
use \XModule\Base\XModule;
use \XModule\Shared\Link;
use \XModule\Constants\LinkType;
use \XModule\ButtonContainer;
use \XModule\LinkButton;
```

Use the components to build XModule structures:

```php
/**
 * Create a new XModule
 */
$xmodule = new XModule();

/**
 * Create XModule elements
 */
$buttonContainer = new ButtonContainer(['id' => 'link_buttons']);
$link = new Link('./', LinkType::RELATIVE_PATH);
$button = new LinkButton('Click here', ['link' => $link]);

/**
 * Attach your elements to each other and the XModule
 */
$buttonContainer->addButton($button)
$xmodule->addContent($buttonContainer);

/**
 * Render the output
 */
echo json_encode($xmodule->render());
```

## Result:

```json
{
  "metadata": {
    "version": "1"
  },
  "content": [
    {
      "elementType": "buttonContainer",
      "id": "link_buttons",
      "buttons": [
        {
          "elementType": "linkButton",
          "title": "Click here",
          "link": {
            "relativePath": "./"
          }
        }
      ]
    }
  ]
}
```

Documentation
=============

...is still pending, but in the meantime there are some very basic auto-generated docs that can be found in the [`/docs`](/docs) folder of this repository. Documentation can be regenerated or viewed using the included Composer scripts:

```sh
# regenerate
$ composer run-script build-docs

# view docs (http://0.0.0.0:8080)
$ composer run-script docs
```

Credits
=======

* [__Modo Labs__](https://www.modolabs.com/) created XModule and the mobile application software it is used in. All trademarks belong to them.