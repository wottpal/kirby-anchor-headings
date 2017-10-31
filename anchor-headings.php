<?php

/**
* A kirby field-method which enumerates heading-elements, generates IDs for
* anchor-links and inserts custom markup based on your options.
*
* @package   Kirby CMS
* @author    Dennis Kerzig <hi@wottpal.com>
* @version   0.3.0
*
*/


include_once __DIR__ . DS . 'vendor' . DS . 'phpQuery.php'; // http://bit.ly/2vvZ3GX
include_once __DIR__ . DS . 'helpers.php';


function headingAnchors($field)
{
  // Options (see `README.md`)
  $options = [
    'heading_min' => c::get('anchorheadings.heading.min', 2),
    'heading_max' => c::get('anchorheadings.heading.max', 3),
    'enum_start' => c::get('anchorheadings.enum.start', 1),
    'enum_seperator' => c::get('anchorheadings.enum.seperator', "."),
    'id_prefix' => c::get('anchorheadings.id.prefix', false),
    'id_prepend_enum' => c::get('anchorheadings.id.prepend.enum', true),
    'id_rules' => c::get('anchorheadings.id.rules', [
      '/[_ ~\/,.]/' => '-',
      '/ä/' => 'ae', '/ö/' => 'oe', '/ü/' => 'ue',
      '/Ä/' => 'Ae', '/Ö/' => 'Oe', '/Ü/' => 'Ue',
      '/ß/' => 'ss', '/ẞ/' => 'SS',
      '/[^A-Za-z0-9\-]/' => '',
      '/-+$/' => '',
      '/-{2,}/' => '-',
      '/([A-Z]+)/' => function($x) { return strtolower($x[1]); }
    ]),
    'markup' => c::get('anchorheadings.markup', "
    <a href='#{id}'>{enum}.</a> {heading}
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
 * <?= $page->text()->kirbytext()->headingAnchors() ?>
 */
field::$methods['headingAnchors'] = 'headingAnchors';
