# Advanced Use Case

In this document you will learn how to use this plugin to produce an outcome like in the GIF<sup>1</sup> below. Featuring:

* Absolutely positioned enumerations
* Link-Icon on Hover
* Yellow-Highlighting on `:target`

![Demo of Kirby Anchor-Headings](demo.gif)

<sup>1</sup> Actually in the GIF I use another icon & font but everything else is the same.


## 1. The markup
We prepend an `<a>` element to the heading which not only contains the enumeration-string but also a svg-icon as children which gets only visible on hover.

Add the code below to your `config.php`. All strings wrapped with curly braces are template-literals which are replaced by the plugin with the actual content.

```php
$markup = <<<'EOT'
<!-- Actual Anchor -->
<a href='#{id}' class='anchor-link'>

<!-- SVG-Icon -->
<!-- NOTE: In a real-world use case you would probably save it somewhere else and reference it here -->
<svg class="icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
<path fill="#6BC5D2" d="M24.7890625,16 C28.2421875,16 31,18.7578125 31,22.2109375 L31,24.7109375 C31,28.1640625 28.2421875,31 24.7890625,31 L16.0390625,31 C13.484375,31 11.2734375,29.453125 10.2890625,27.25 C9.9453125,26.46875 9.75,25.609375 9.75,24.7109375 L9.75,22.25 L13.5,22.25 L13.5,24.7109375 C13.5,26.0859375 14.6640625,27.25 16.0390625,27.25 L24.7890625,27.25 C26.1640625,27.25 27.25,26.0859375 27.25,24.7109375 L27.25,22.2109375 C27.25,20.8359375 26.1640625,19.75 24.7890625,19.75 L24.75,19.75 L23.46875,19.75 C23.03125,17.328125 21,16 21,16 L24.7890625,16 Z M21.75,19.75 C22.0703125,20.5 22.25,21.3359375 22.25,22.2109375 L22.25,24.7109375 C22.25,24.7265625 22.25,24.734375 22.25,24.75 L18.5,24.75 C18.5,24.734375 18.5,24.7265625 18.5,24.7109375 L18.5,22.2109375 C18.5,20.8359375 17.4140625,19.75 16.0390625,19.75 L16,19.75 L7.2890625,19.75 C5.9140625,19.75 4.75,20.8359375 4.75,22.2109375 L4.75,24.7109375 C4.75,26.0859375 5.9140625,27.25 7.2890625,27.25 L8.4921875,27.25 C8.984375,29.671875 11,31 11,31 L7.2890625,31 C3.8359375,31 1,28.1640625 1,24.7109375 L1,22.2109375 C1,18.7578125 3.8359375,16 7.2890625,16 L16.0390625,16 C18.6171875,16 20.8046875,17.5390625 21.75,19.75 Z"/>
</svg>

<!-- Enumeration -->
<div>{enum}</div>
</a>
<!-- Actual Heading -->
{heading}
EOT;

c::set('anchorheadings.markup', $markup);
```


## 2. The styling

Add the following styles to one of your CSS-files or inline them inside a `<style>` tag. Of course you should not only select `h2, h3` if you've changed min/max depths of the plugin.

```scss
h2, h3 {
  position: relative;

  .anchor-link {
    position: absolute;
    right: 100%;
    // align somehow vertically with the heading
    bottom: .6em;
    font-size: .5em;
    line-height: 100%;
    padding: 0 .45rem;
    margin-right: .3rem;
    text-decoration: none;
    color: #aaa;
  }

  // Show enumeration by default & hide icon
  .anchor-link .icon {
    display: none;
    width: 1.5em;
    height: 1.5em;
    stroke: none;
  }
  .anchor-link div  {
    display: block;
  }

  // Swap Enumeration with Icon on Hover
  &:hover .anchor-link,
  &:focus .anchor-link {
    background: none;
    .icon {
      display: block;
    }
    div {
      display: none;
    }
  }


  // Highlight when :target
  &:target .anchor-link {
    font-weight: bold;
    line-height: 1.8;
    color: black;
    border-radius: 3px;
    background: #FDFD93;
  }
}
```


## 3. Call the plugin

Obviously, to wire this all together call the field-method on the text you want to get anchors added to.

```php
<?= $page->text()->kirbytext()->headingAnchors() ?>
```

If this guide has helped you in any manner, follow [me on Twitter](https://twitter.com/wottpal) for more.
