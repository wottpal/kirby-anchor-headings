<?php

/**
* A Kirby 3 field-method which enumerates heading-elements, generates IDs for
* anchor-links and inserts custom markup based on your options.
*
* @package   Kirby CMS
* @author    Dennis Kerzig <hi@wottpal.com>
* @version   0.5.0
*/


// https://github.com/slaith/phpQuery
include_once __DIR__ . DS . 'vendor' . DS . 'phpQuery'. DS . 'phpQuery.php';
include_once __DIR__ . DS . 'helpers.php';


function anchorHeadings($field)
{
  // Options (see `README.md`)
  $options = [
    'toplevel_only' => option('anchorheadings.toplevel.only', true),
    'heading_min' => option('anchorheadings.heading.min', 2),
    'heading_max' => option('anchorheadings.heading.max', 3),
    'enum_start' => option('anchorheadings.enum.start', 1),
    'enum_seperator' => option('anchorheadings.enum.seperator', "."),
    'id_prefix' => option('anchorheadings.id.prefix', false),
    'id_prepend_enum' => option('anchorheadings.id.prepend.enum', true),
    'id_rules' => option('anchorheadings.id.rules', [
      '/[_ ~\/,.]/' => '-',
      '/ä/' => 'ae', '/ö/' => 'oe', '/ü/' => 'ue',
      '/Ä/' => 'Ae', '/Ö/' => 'Oe', '/Ü/' => 'Ue',
      '/ß/' => 'ss', '/ẞ/' => 'SS',
      '/[^A-Za-z0-9\-]/' => '',
      '/-+$/' => '',
      '/-{2,}/' => '-',
      '/([A-Z]+)/' => function($x) { return strtolower($x[1]); }
    ]),
    'markup' => option('anchorheadings.markup', "
    <a href='#{{id}}'>{{enum}}.</a> {{heading}}
    ")
  ];

  // Parse document with PHPQuery
  $doc = phpQuery::newDocument($field->value());

  // Insert anchors
  insertAnchors($options);

  return $doc->html();
}


/**
* Sets the method as field method, so you can use it like:
* <?= $page->text()->kirbytext()->anchorHeadings() ?>
*/
Kirby::plugin('wottpal/anchor-headings', [

  'fieldMethods' => [

    'anchorHeadings' => function($field) {
      return anchorHeadings($field);
    }

  ]
]);
