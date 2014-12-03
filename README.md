This plugin was developed by Special Collections at the National Agricultural Libary to add functionality and design customizations to Omeka. 

The shortcodes generally have the same options as the regular shortcodes, unless otherwise noted: http://omeka.org/codex/Shortcodes#Recent_Items 

#Available Shortcodes
##Items
**[nal_recent_items]**: Display a list of recent items without using the default `items/single.php`
**[nal_collection_items]**: Includes the parent collection in item list entries.
**[nal_featured_item]**: Custom layout for featured item, including x of n count at the bottom of the `div`

##Exhibits
**[nal_exhibits]**: Returns a longer description with some regular expression replacements.
**[exhibit_search]**: Creates a search box to search exhibit pages. Currently requires a custom `search/index.php` in your theme folder to function correctly. E.g. https://github.com/sheepeeh/theme-NALSpecColl/blob/5b5b6566ff225ef158165522585616bcbfd2815e/search/index.php

##Other
**[build_url]**: Enables the php `url()` function to be used where shortcodes are accepted. Syntax is `[build_url string='YOUR/STRING/HERE']`