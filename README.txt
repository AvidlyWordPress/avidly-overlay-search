Accessible overlay search functionality. Supports Relevanssi and Polylang Pro.

== Usage ==

Output a11y_overlaysearch_button() function anywhere in the theme and search will appear.

Example:
<?php echo accessible_overlay_search_button(); ?>

Function will accept three parameters:
$show_label (bool) = true/false to display button text visually. Defaults to true. If false, text will be visible to screen readers only.
$class (string)    = add custom classes for button. Defaults to none.
$svg (string)      = use custom SVG as button icon. Defaults to icon from Heroicons.

Example:
<?php echo accessible_overlay_search_button( false, 'my-custom-class', '<svg>...</svg>' ); ?>

== Polylang ==

Free version of Polylang won't show the live search results, since it doesn't support REST API.

If Polylang is enabled you need to add locale fallback to every language that has two part locale code e.g. sv_SE, de_DE etc. For example sv_SE locale fallback is sv_SE.

== Relevanssi ==

Remember to re-index posts after activating Relevanssi.
