=== Elementor Custom Widgets ===
Contributors: Aishan
Tags: elementor

== Installation ==
	1. Upload the entire `elementor-custom-widget` folder to the `/wp-content/plugins/` directory.
	2. Activate the plugin through the 'Plugins' menu in WordPress.

== Description ==
	- This plugin can be used as a boilerplate for creation of custom widget element in elementor.
	- You will find 'Popular Posts' widget if you search on the elementor Elements
	- Just named 'Popular Posts' you can update the code on widget-popular-post.php as your requirements
	- You can create other modules like: <folder-name>/widgets/widget-<folder-name>.php
		And after that you need to add array value of that folder name.
		For example
			$this->modules = [
	            'popular-posts',
	            '<folder-name>',
	        ];


== For Further Reference ==
	- https://developers.elementor.com/creating-a-new-widget/







