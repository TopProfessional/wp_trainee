# Elementor Hello World Sample Plugin

This is a sample plugin to demonstrate how you can write extentions (plugins) to add custom functionality to [Elementor](https://github.com/pojome/elementor/)

Plugin Structure: 
```      
widgets/
      /inline-editing.php
elementor-hello-world.php
plugin.php
```

* `widgets` directory - Holds Plugin widgets

 * `/inline-editing.php` - Inline Editing demo Widget class
* `elementor-hello-world.php`	- Main plugin file, used as a loader if plugin minimum requirements are met.
* `plugin.php` - The actual Plugin file/Class.

For more documentation please see [Elementor Developers Resource](https://developers.elementor.com/creating-an-extension-for-elementor/).
