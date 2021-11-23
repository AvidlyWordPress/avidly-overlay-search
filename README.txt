=== Accessible overlay search ===
Author: Henkka Avoketo, Avidly
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


== Description ==

Accessible overlay search with live search results. Supports Polylang.

== Usage ==

Call accessible_overlay_search_button() -function anywhere in the theme and search will appear.

Example:
<?php echo accessible_overlay_search_button(); ?>

Function will accept three parameters:
$show_label (bool) = true/false to display button text visually. Defaults to true.
$class (string)    = add custom classes for button. Defaults to none.
$svg (string)      = use custom SVG as button icon. Default sto icon from Heroicons.

Example:
<?php echo accessible_overlay_search_button( false, 'my-custom-class', '<svg>...</svg>' ); ?>



