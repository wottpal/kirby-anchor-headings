# ⚓ Kirby Anchor-Headings by [@wottpal](https://twitter.com/wottpal)

<!-- Buttons --> ![Release](https://img.shields.io/github/release/wottpal/kirby-anchor-headings/all.svg) [![MIT](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/wottpal/kirby-video/master/LICENSE) [![Tweet](https://img.shields.io/twitter/url/https/github.com/wottpal/kirby-anchor-headings.svg?style=social)](https://twitter.com/intent/tweet?text=⚓ Anchor-Headings for @getkirby by @wottpal&url=https://git.io/v7aFU)

(_Disclaimer:_ This is a pre-release.)

A field-method for the [Kirby CMS](https://getkirby.com) which automagically enumerates your headings, generates IDs for them and inserts matching anchor links. Customizable to it's core. 🤘

# Demos

_Coming Soon_ ([submit your demo](https://twitter.com/wottpal))


# Installation

Use [Kirby's CLI](https://github.com/getkirby/cli) and install the plugin via: `kirby plugin:install wottpal/kirby-anchor-headings` or place the repo manually under `site/plugins`.

🎉 **That's it.**


# Usage

This is a kirby field-method, so you can basically just do:

```html
<?= $page->text()->kirbytext()->headingAnchors() ?>
```


# Options

The following options can be set globally in your `config.php` with `c::set($key, $value = null)`. You can also set multiple keys with `c::set([$key => $value, ..])`. 🤓

**Please prefix every key with `anchorheadings.`!**

key               | default | description
----------------- | ------- | ------------------------------------------------
`heading.min`     | `2`     | The `<h>`-level to _begin_ enumeration.
`heading.max`     | `3`     | The `<h>`-level to _end_ enumeration.
`enum.start`      | `1`  | Integer to start enumeration on each level.
`enum.seperator`  | `'.'` | Seperator for enumeration-levels.
`id.prepend.enum` | `true` | If the enumeration should be part of the generated ID.
`id.rules`        | _(see below)_ | A dictionary of reg. expressions and their respective replacements. (They will be applied in the given order.)
`markup`          | _(see below)_ | A template-string which defines the new inner-markup of each heading-element


#### Default of `id.rules`

```php
[
  // characters to replace with an hyphen
  '/[_ ~\/,.]/' => '-',
  // replace German umlauts (YES, even the large ß)
  '/ä/' => 'ae', '/ö/' => 'oe', '/ü/' => 'ue',
  '/Ä/' => 'Ae', '/Ö/' => 'Oe', '/Ü/' => 'Ue',
  '/ß/' => 'ss', '/ẞ/' => 'SS',
  // remove all remaining characters that are not letters/digits
  '/[^A-Za-z0-9\-]/' => ''
]
```

#### Default of `markup`

```html
<a href='#{id}'>{enum}.</a> {heading}
```

You can use the following template-literals in your markup: `{id}`, `{enum}` and `{heading}`. I think they are self-explanatory, but feel free to reach out if you need further guidance.


# Changelog

Have a look at the [releases page](https://github.com/wottpal/kirby-anchor-headings/releases).


# Roadmap

- [ ] Add an explanatory screenshot/gif to the `README.md`
- [ ] Add an example with advanced markup & styling to the `README.md`
- [ ] Allow non integer values for `enum.start` like `A` or `i` and conitnue enumeration with this style.



# 💰‍ Pricing
Just kidding. This plugin is totally free. Please consider following [me](https://twitter.com/wottpal) on Twitter if it saved your day.

[![Twitter Follow](https://img.shields.io/twitter/follow/wottpal.svg?style=social&label=Follow)](https://twitter.com/wottpal)

You can also check out one of my other Kirby-plugins:

* [Lightbox-Gallery](https://github.com/wottpal/kirby-lightbox-gallery) - Easily inline beautifully aligned galleries with lightbox-support powered by PhotoSwipe.
* [HTML5-Video Kirbytag](https://github.com/wottpal/kirby-video) - Adds a kirbytag for embedding HTML5-videos with a variety of features.
