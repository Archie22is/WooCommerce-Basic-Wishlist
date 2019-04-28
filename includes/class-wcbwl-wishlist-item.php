<?php

// Exit if accessed directly
if(!defined('ABSPATH')) exit;

class WCBWL_Wishlist_Item extends WC_Data {

	protected $data = array(
		'wishlist_id' => 0,
		'product_id'  => 0,
		'date_added'  => null,
	);

	protected $cache_group = 'wishlist-items';

	protected $meta_group = 'wishlist_item';

	protected $object_group = 'wishlist_item';

	/**
	 * Constructor.
	 *
	 * @param int|object|WCBWL_Wishlist_Item $item ID to load from the DB, or WCBWL_Wishlist_Item object.
	 */
	public function __construct($item = 0) {
		parent::__construct($item);

		if($item instanceof WCBWL_Wishlist_Item) {
			$this->set_id($item->get_id());
		}
		else if(!empty($item->ID)) {
			$this->set_id($item->ID);
		}
		else if(is_numeric($item) && $item > 0) {
			$this->set_id($item);
		}
		else {
			$this->set_object_read(true);
		}

		$this->data_store = WC_Data_Store::load('wishlist-item');
		if($this->get_id() > 0) {
			$this->data_store->read($this);
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Getters
	|--------------------------------------------------------------------------
	*/

	public function get_wishlist_id($context = 'view') {
		return $this->get_prop('wishlist_id', $context);
	}

	public function get_product_id($context = 'view') {
		return $this->get_prop('product_id', $context);
	}

	public function get_date_added($context = 'view') {
		return $this->get_prop('date_added', $context);
	}

	/*
	|--------------------------------------------------------------------------
	| Setters
	|--------------------------------------------------------------------------
	*/

	public function set_wishlist_id($value) {
		$this->set_prop('wishlist_id', absint($value));
	}

	public function set_product_id($value) {
		$this->set_prop('product_id', absint($value));
	}

	public function set_date_added($date = null) {
		$this->set_date_prop('date_added', $date);
	}
}