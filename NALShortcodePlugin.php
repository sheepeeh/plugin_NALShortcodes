<?php

class NALShortcodePlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = array('initialize');

    public function hookInitialize()
    {
        add_shortcode('nal_recent_items', array($this, 'recentNAL'));
        add_shortcode('nal_featured_items', array($this, 'featuredNAL'));
        add_shortcode('nal_collection_items', array($this, 'collectionItem'));
        add_shortcode('nal_exhibits', array($this,"exhibitsNAL"));
        add_shortcode('build_url', array($this,"buildURL"));
        add_shortcode('exhibit_search', array($this,"exhibitSearch"));
    }


    public function exhibitSearch($args,$view)
    {


// Get exhibit ID from shortcode
  	    if (isset($args['exhibit'])) {
	            $eid = $args['exhibit'];
	    }

// Get page IDs for the exhibit
        $db = get_db();

        $select = "
                    SELECT id
                    FROM omeka_exhibit_pages
                    WHERE (exhibit_id=?)
                    ORDER BY id
                    ";

        $pages = $db->getTable("ExhibitPage")->fetchObjects($select,array($eid));
        $page_ids = array();
        foreach ($pages as $page) {
            array_push($page_ids,$page['id']);
        }

        $page_string = join(",",$page_ids);


// Build the options and filters arrays used for searches.
    	$options = array();
		 // Set the default flag indicating whether to show the advanced form.
		if (!isset($options['show_advanced'])) {
		$options['show_advanced'] = true;
		}
		// Set the default submit value.
		if (!isset($options['submit_value'])) {
		$options['submit_value'] = __('Search');
		}
		// Set the default form attributes.
		$options['form_attributes'] = array();
				
		$url = apply_filters('search_form_default_action', url('search'));
		$options['form_attributes']['action'] = $url;
		$options['form_attributes']['id'] = 'search-form';
		$options['form_attributes']['method'] = 'get';
		$options['form_attributes']['style'] = 'text-align:left;width:75%';
		
		$this->_validQueryTypes = get_search_query_types();
		$this->_validRecordTypes = get_custom_search_record_types();
		$filters = array();
		if (isset($_GET['query'])) {
		$filters['query'] = $_GET['query'];
		} else {
		$filters['query'] = '';
		}
		if (isset($_GET['query_type']) && array_key_exists($_GET['query_type'], $this->_validQueryTypes)) {
		$filters['query_type'] = $_GET['query_type'];
		} else {
		$filters['query_type'] = 'keyword';
		}
		if (isset($_GET['record_types'])) {
		$filters['record_types'] = $_GET['record_types'];
		} else {
		$filters['record_types'] = array_keys($this->_validRecordTypes);
		}
// Add a filter for exhibit_id
		if (isset($_GET['exhibit_id'])) {
		$filters['exhibit_id'] = $_GET['exhibit_id'];
		} else {
		$filters['exhibit_id'] = $page_ids;
		}

		
		
		$this->_filters = $filters;

// Pass variables to a view; the view returns a search box.

		return $view->partial(
		'search/search.php',
		array('options' => $options,
		'filters' => $this->_filters,
		'recordIDs' => $page_string,
		'query_types' => array('keyword' => __('Keyword')),
		'record_types' => array('ExhibitPage' => __('Exhibit Page')),
		'exhibit_id' => array($eid => "Record Id: $eid")));
	  }

    public function recentNAL($args, $view)
    {
		return $view->partial('items/recent-item.php');
    }


    public function featuredNAL($args, $view)
    {
    	$items = get_records('Item', array('featured'=> 1,'sort_field'=>'random'));
		$content = '';
		foreach ($items as $item) {
			$content =  $view->partial('items/featured-item.php',array('item'=>$item));
		}

		return $content;
    }


    public function collectionItem($args, $view)
    {
		$params = array();
		
		if (isset($args['ids'])) {
			$params['range'] = $args['ids'];
		}

		if (isset($args['sort'])) {
			$params['sort_field'] = $args['sort'];
		}

		if (isset($args['order'])) {
			$params['sort_dir'] = $args['order'];
		}

		if (isset($args['is_featured'])) {
			$params['featured'] = $args['is_featured'];
		}

		if (isset($args['num'])) {
			$limit = $args['num'];
		
		} else {
			$limit = 10;
		}
		
		$collections = get_records('Collection', $params, $limit);
		$content = '';
		
		$content .= $view->partial('items/collection-item.php', array('collections' => $collections));
		

		return $content;
    }

    public function exhibitsNAL($args, $view)
	{
	    $params = array();

	    if (isset($args['is_featured'])) {
	        $params['featured'] = $args['is_featured'];
	    }

	    if (isset($args['sort'])) {
	        $params['sort_field'] = $args['sort'];
	    }

	    if (isset($args['order'])) {
	        $params['sort_dir'] = $args['order'];
	    }

	    if (isset($args['ids'])) {
	            $params['range'] = $args['ids'];
	    }

	    if (isset($args['num'])) {
	        $limit = $args['num'];
	    } else {
	        $limit = 10; 
	    }

	    if (isset($args['display'])) {
	        $body_class = $args['display'];
        } else {
        	$body_class = false;
	    }

	    $exhibits = get_records('Exhibit', $params, $limit);

	    $content = '';
	    foreach ($exhibits as $exhibit) {
	        $content .= $view->partial('exhibits/single.php', array('exhibit' => $exhibit, 'body_class' => $body_class));
	        release_object($exhibit);
	    }

	    return $content;
	}

	public function buildURL($args) {
		return url($args['string']);
	}


}