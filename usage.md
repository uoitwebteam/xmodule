Usage
=====

## Basics

### The `XModule` class

The `XModule` class serves as a parent container for all elements. Generally, it just contains a version number (for the XModule version) and a `content` array containing the elements of the module.

To create a new XModule, create a `new` instance of its class; the default version is `1` if left with no parameters:

```php
use \XModule\Base\XModule;
$xmodule = new XModule();

// or without namespaces...
$xmodule = new \XModule\Base\XModule();
```

### Elements

All elements inherit from the base `Element` class, which takes care of setting the element's `elementType` property for you.

All classes are a direct representation of their name in Modo Labs' [XModule documentation](https://xmodule-docs.modolabs.net) stylized in PascalCase; for instance, the class for a button container element is called `ButtonContainer`. __The only exception is the XModule [list element](https://xmodule-docs.modolabs.net/elements/list/), which is called `LinkList` due to a conflict with PHP's native `List` class.__

To use an element, create a `new` instance of its class:

```php
use \XModule\LinkButton;

$linkbutton = new LinkButton();
```

The classes have properties that are direct representations of the element's properties in the [XModule docs](https://xmodule-docs.modolabs.net). For example, a [`LinkButton`](https://xmodule-docs.modolabs.net/elements/link_button/) class will have a `disabled` property which receives a boolean value. __These values are accessible via "getter/setter" methods with names that follow a format of `get{PropertyName}`/`set{PropertyName}`:__

```php
$linkbutton->setDisabled(true);
```

Elements with required properties must take their requirements as arguments in the constructor. For instance, the [`Heading`](https://xmodule-docs.modolabs.net/elements/heading/) element has a required `title` property, therefore its title must be declared when the new instance is created. Optional properties, such as its `description` or `id`, can also be set inside an options array during creation for convenience:

```php
use \XModule\Heading;

$heading = new Heading("Songs About Cats");

// or with optional properties...
$heading = new Heading("Songs About Cats", [
  "id" => "cat_songs",
  "description" => "Look at all the tunes about these amazing creatures!"
]);
```

All properties, required or optional, can either be set immediately on creation or at a later time using getter/setters (as in the first example):

```php
$heading->setId("cat_songs");
$heading->setDescription("Look at all the tunes about these amazing creatures!");
```

Some elements take other elements for their properties. For example, the [`LinkList`](https://xmodule-docs.modolabs.net/elements/list/) element takes an array of `LinkListItem` elements for its `items` property. In this case, it's recommended to create the "inner" items first and then add them to the parent as you work your way up:

```php
use \XModule\LinkList;
use \XModule\LinkListItem;

$listitems = [
  new LinkListItem(["heading" => "Cashmere Cat - Mirror Maru"]),
  new LinkListItem(["heading" => "deadmau5 - 50 something cats"]),
  new LinkListItem(["heading" => "Squarepusher - Hello Meow"])
];
$list = new LinkList(["items" => $listitems]);
```

Properties whose values are arrays (such as `items` or `cells`) also offer an `add{PropertyName}` method on their parent class for adding single items imperatively:

```php
$listitem = new LinkListItem(["heading" => "Cashmere Cat - Mirror Maru"]);
$list->addItem($listitem);
```

### Building structures

To compile your elements into an XModule that can be rendered, they need to be added to a parent `XModule` class (such as the one created [here](#the-xmodule-class)) after they've been configured:

```php
$xmodule->setContent([$heading, $list]);

// or one by one...
$xmodule->addContent($heading);
$xmodule->addContent($list);
```

The above example illustrates adding `content` to an XModule; the same pattern can be followed to create an XModule that instead features `regionContent`, i.e. for use as the result of an Ajax-loaded element, like a list whose items are dynamic:

```php
$xmodule->setRegionContent($listitems);

// or one by one...
$xmodule->addRegionContent($listitem1);
$xmodule->addRegionContent($listitem2);
```

To expose a "final" view of your XModule (i.e. for sending as JSON from your API), you'll need to call your module's `render` method after configuring all elements/properties/content. This collapses all its properties into a single, flat representation that respects the XModule API footprint. __Keep in mind that this representation is still a PHP array – you'll need to `json_encode` the result before sending it anywhere:__

```php
$rendered = $xmodule->render();
echo json_encode($rendered);

// or in one line...
echo json_encode($xmodule->render());
```

### Constants

Some XModule properties, such as the `actionType` property of the [`LinkButton`](https://xmodule-docs.modolabs.net/elements/link_button/) element, require one of a specific set of string values (like an "enum" type) – in this case, `constructive`, `destructive`, and `emphasized` are the allowed choices. To reduce the potential for errors and duplication caused by 'magic' string values, all enum-type values take __class constants__ named after their respective value.

All constants originate from the `\XModule\Constants` namespace and use SNAKE_CASE for their naming:

```php
use \XModule\LinkButton;
use \XModule\Constants\ActionType;

$linkbutton = new LinkButton([
  "title" => "Destroy Things",
  "actionType" => ActionType::DESTRUCTIVE
]);
```

This allows IDEs and tooling to offer autocomplete suggestions for enum values, and also throws errors for invalid/disallowed values at runtime:

```php
$linkbutton = new LinkButton([
  "title" => "Destroy Things",
  "actionType" => "dstructiveWithTypo"
]);

// !!! ERROR: invalid actionType "dstructiveWithTypo" provided for link button
```

Supported constants include:

* AccessoryIconPosition
* ActionType
* BrowserType
* ButtonType
* DisclosureIcon
* ElementType
* Enum
* Height
* Icon
* InputType
* LinkType
* Margins
* Position
* PostType
* Size
* Spacing
* TabType
* Target

## Special elements

### Shared

A small handful of XModule elements are usable as pieces within a number of different elements – these live under the `\XModule\Shared` namespace. For instance, the `Link` element contains properties that are shared by all links, whether they are attached to a `LinkListItem`, a `LinkButton`, etc...

Currently supported shared elements include:

* `AjaxContent`
* `Badge`
* `Link`
* `Thumbnail`

An `\XModule\Shared\Functions` class is also included in this namespace; these are internal functions and are unlikely to be needed in a user-facing application.

#### `Link`

The `Link` class is a generic element for handling all XModule link behaviour; see the page on [XModule Links](https://xmodule-docs.modolabs.net/xmodule/links/) for more info. It has two required properties that must be supplied on creation, its path and type:

```php
use \XModule\Link;
use \XModule\Constants\LinkType;

$link = new Link("./details", LinkType::RELATIVE_PATH);
```

As demonstrated above, the link element's type must use one of the `LinkType` constants (in this case, `RELATIVE_PATH`).

Available link types include:

* RELATIVE_PATH
* EXTERNAL
* MODULE
* XMODULE
* NATIVE_PLUGIN

#### `AjaxContent`

Some XModule elements, like the list and container element, accept _Ajax_ content in place of their regular static content; see the page on [Ajax Content](https://xmodule-docs.modolabs.net/xmodule/ajax/) for more details. In these cases, it is necessary to provide an `AjaxContent` instance for the element's content.

The `AjaxContent` class requires a path argument, which points to the relative URL that will supply the "inner" content:

```php
use \XModule\Container;
use \XModule\Shared\AjaxContent;

$container = new Container();
$ajaxcontent = new AjaxContent("./details?region_content=true");

$container->setContent($ajaxcontent);
```

When using Ajax content instead of regular content, remember to use the `setContent` method (like above) and just supply a single `AjaxContent` item instead of an array of elements like you'd normally supply. This is because the array of items will be supplied as the `regionContent` of the XModule that provides the inner Ajax content:

```php
// ./details?region_content=true

use \XModule\Base\XModule;
use \XModule\Heading;
use \XModule\Image;

$xmodule = new XModule();
$heading = new Heading("Cat travels via Ajax");
$image = new Image("https://placekitten.com/200/300");

$xmodule->setRegionContent([$heading, $image]);
```

In the above examples, the rendered output (after a call to `json_encode($xmodule->render())`) would look like the following:

__Example 1__

```json
{
  "metadata": {
    "version": "1"
  },
  "content": [
    {
      "elementType": "container",
      "content": {
        "ajaxRelativePath": "./details?region_content=true"
      }
    }
  ]
}
```

__Example 2__

```json
{
  "metadata": {
    "version": "1"
  },
  "regionContent": [
    {
      "elementType": "heading",
      "title": "Cat travels via Ajax"
    },
    {
      "elementType": "image",
      "url": "https://placekitten.com/200/300"
    }
  ]
}
```

### Forms

XModule form elements have their own namespace, `\XModule\Forms` – apart for the `Form` element itself, which lives with the rest of the `\XModule` namespace elements. All form elements must go inside a parent `Form` element.

All form elements inherit from the `FormElement` class, which gives them an input type and label. Additionally, some inherit from the `FormControl` class, which gives the input some additional properties, like a `name` attribute.

See the page on [XModule forms](https://xmodule-docs.modolabs.net/forms/) for more details.

#### Form

The `Form` element itself serves as a container for all form elements, and additionally, a [few other non-form elements](https://xmodule-docs.modolabs.net/appendix/supported_child_elements/) as well. Its only required property is the URL to which the form submits, i.e. the form's `action` attribute.

It is similar in function to the `Container` element, in that it holds an array of items (in this case, form elements) as its content under an `items` property:

```php
use \XModule\Form;
use \XModule\Forms\Text;

$form = new Form("./submit");
$firstname = new Text("First name", "name_first");
$lastname = new Text("Last name", "name_last");

$form->setItems([$firstname, $lastname]);

// or one at a time...
$firstname = new Text("First name", "name_first");
$form->addItem($firstname);
$lastname = new Text("Last name", "name_last");
$form->addItem($lastname);
```

#### Foreground POST

The [XModule page for foreground POST](https://xmodule-docs.modolabs.net/forms/post_requirements_foreground/) outlines some specifications for how this type of interaction should be handled. Specifically, it describes a three-stage workflow in which a form is submitted, a response containing _a redirect URL_ is returned, and finally the redirect URL returns the result of the form submission.

To carry this out using this library's classes, you'll need to set the root XModule instance's `metadata` to contain the `redirectLink` for the response to a form submission; the link itself is an XModule `Link` element:

```php
use \XModule\Base\XModule;
use \XModule\Shared\Link;
use \XModule\Constants\LinkType;

$xmodule = new XModule();
$redirect = new Link("./submit?token=_SSKdg93fsdmv9Dsffa", LinkType::RELATIVE_PATH);

$xmodule->setMetadata(["redirectLink" => $redirect]);

// or just add the one property...
$xmodule->addMetadata("redirectLink", $redirect);
```

The redirect URL can simply return another `new XModule()` with normal content, which will be displayed as the final result of the form.

## Complete examples

### Building a table

Rendering a table is a common layout task. Often we'll need to operate on a large set of data – usually an array – to create a cascade of rows with cells.

Take for example the following JSON array of 'person' objects:

```json
[
  {
    "id": 1,
    "name": "Jane Goodall",
    "rsvp": false
  },
  {
    "id": 2,
    "name": "Ada Lovelace",
    "rsvp": true
  },
  {
    "id": 2,
    "name": "Marie Curie",
    "rsvp": true
  }
]
```

We can create an XModule `Table` element from this array by using PHP's `array_map()` function to iteratively transform it. The properties of each of object become the row's `cells`, each object becomes one of the `rows`, and finally the rows are added to a table with the appropriate headings.

Below is an example that demonstrates how such as structure might be achieved, as well as use of the shared `Link` element in order to make the table rows linkable.

First we import the needed elements – the base, the table elements, and link elements:

```php
// base container
use \XModule\Base\XModule;

// table parts
use \XModule\Table;
use \XModule\TableCell;
use \XModule\TableRow;
use \XModule\TableColumnOption;

// link and type constant
use \XModule\Shared\Link;
use \XModule\Constants\LinkType;
```

The first thing we'll need to create is a new `XModule` container for our table:

```php
$xmodule = new XModule();
```

Assuming the raw JSON data is already stored in a variable called `$json`, we'll need to decode it into a PHP-readable format – in this case, an associative array:

```php
$data = json_decode($json, true);
```

Next, the array of person objects stored in the `$data` variable will need to be transformed into an array of `TableRow` instances. We can use `array_map()` to walk along the array and return something new for each array item:

```php
$rows = array_map(function ($person) {
  // ...
}, $data)
```

Inside the `array_map()` callback function, we can extract the needed parts from each object and assign them to a `Link` and `TableCell`s:

```php
// ...function ($person) {
  $id = $person["id"];
  $link = new Link("./person/$id", LinkType::RELATIVE_PATH);
  $cells = [
    new \XModule\TableCell(["title" => $id]),
    new \XModule\TableCell(["title" => $person["name"]]),
    new \XModule\TableCell(["title" => $person["rsvp"] ?: "Yes" : "No"])
  ];
// ...}
```

Finally, we can assign the link and cells to a new `TableRow` instance and return it as the replacement array item:

```php
// ...function ($person) {
  $row = new \XModule\TableRow([
    "cells" => $cells,
    "link" => $link
  ]);
  // !!! important – return the replacement array item
  return $row;
// ...}
```

To display the rows, we'll need a `Table` element to hold them. This is where we can use `TableColumnOption` elements to define the table's header row, as well as optionally give the table some heading text:

```php
$table = new \XModule\Table([
  "heading" => "Science Party guest list",
  "columnOptions" => [
    new \XModule\TableColumnOption(["header" => "ID"]),
    new \XModule\TableColumnOption(["header" => "Name"]),
    new \XModule\TableColumnOption(["header" => "Has RSVP?"])
  ],
  "rows" => $rows
]);
```

Last but not least, the table must be added to the `XModule` instance:

```php
$xmodule->addContent($table);
// or...
// $xmodule->setContent([ $table ]);
```

To return a final JSON-encoded version of your XModule, be sure to call the `XModule` element's `render()` method to flatten its properties:

```php
echo json_encode($xmodule->render());
```

## Full example

```php
/**
 * Imports
 */
use \XModule\Base\XModule;
use \XModule\Table;
use \XModule\TableCell;
use \XModule\TableRow;
use \XModule\TableColumnOption;
use \XModule\Shared\Link;
use \XModule\Constants\LinkType;

/**
 * Initialization and data parsing
 */
$xmodule = new XModule();

$data = json_decode($json, true);

/**
 * Transform array into table rows with cells
 */
$rows = array_map(function ($person) {
  $id = $person["id"];
  $link = new Link("./person/$id", LinkType::RELATIVE_PATH);
  $cells = [
    new \XModule\TableCell(["title" => $id]),
    new \XModule\TableCell(["title" => $person["name"]]),
    new \XModule\TableCell(["title" => $person["rsvp"] ?: "Yes" : "No"])
  ];
  $row = new \XModule\TableRow([
    "cells" => $cells,
    "link" => $link
  ]);
  return $row;
}, $data);

/**
 * Add rows to table with column headings
 */
$table = new \XModule\Table([
  "heading" => "Science Party guest list",
  "columnOptions" => [
    new \XModule\TableColumnOption(["header" => "ID"]),
    new \XModule\TableColumnOption(["header" => "Name"]),
    new \XModule\TableColumnOption(["header" => "Has RSVP?"])
  ],
  "rows" => $rows
]);

/**
 * Add table to module and render
 */
$xmodule->addContent($table);

echo json_encode($xmodule->render());
```

__Result:__

```json
{
  "metadata": {
    "version": "1"
  },
  "content": [{
    "elementType": "table",
    "heading": "Science Party guest list",
    "columnOptions": [{
        "header": "ID"
      },
      {
        "header": "Name"
      },
      {
        "header": "Has RSVP?"
      }
    ],
    "rows": [{
        "link": {
          "relativePath": "./person/1"
        },
        "cells": [{
            "title": "1"
          },
          {
            "title": "Jane Goodall"
          },
          {
            "title": "No"
          }
        ]
      },
      {
        "link": {
          "relativePath": "./person/2"
        },
        "cells": [{
            "title": "2"
          },
          {
            "title": "Ada Lovelace"
          },
          {
            "title": "Yes"
          }
        ]
      },
      {
        "link": {
          "relativePath": "./person/2"
        },
        "cells": [{
            "title": "2"
          },
          {
            "title": "Marie Curie"
          },
          {
            "title": "Yes"
          }
        ]
      }
    ]
  }]
}
```