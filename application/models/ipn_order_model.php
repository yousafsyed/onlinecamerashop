<?php

class Ipn_order_model extends CI_Model {
	// Define the order and order items table names
	const ORDER_TABLE      = 'ipn_orders';
	const ORDER_ITEM_TABLE = 'ipn_order_items';

	// Standard constructor
	function __construct() {
		parent::__construct();
	}

	// Save the order, performing an insert or update as appropriate
	function saveOrder($order, $orderItems, $transactionID, $user_id) {
		// Define the transaction query once
		$orderQuery = array('txn_id' => $transactionID);

		// Check the transaction ID to see if the order needs an insert or update
		$existingOrder = $this->db->get_where(self::ORDER_TABLE, $orderQuery, 1, 0);

		// Set the update/insert date
		$upsertTime          = date('Y-m-d H:i:s');
		$order['updated_at'] = $upsertTime;// All inserts/updates set the updated_at time

		// If it exists, get the ID and do an update
		if ($existingOrder->num_rows() > 0) {
			$orderID = $existingOrder->row()->id;// Grab the ID
			$this->db->update(self::ORDER_TABLE, $order, $orderQuery);// Do the update
		}
		// Else do an insert and then get the ID
		else{
			$order['created_at'] = $upsertTime;// A new order needs a created_at time too
			$order['user_id']    = $user_id;
			$this->db->insert(self::ORDER_TABLE, $order);
			$orderID = $this->db->insert_id();
		}

		// Now let's save the order's line items
		foreach ($orderItems as $item) {
			// Define the order item query
			$orderItemQuery = array(
				'item_name'   => $item['item_name'],
				'item_number' => $item['item_number'],
				'order_id'    => $orderID
			);

			// Add the order ID and datestamp into the item to update/insert
			$item['order_id']   = $orderID;
			$item['updated_at'] = $upsertTime;

			// Now try to retrieve the order item
			$existingOrderItem = $this->db->get_where(self::ORDER_ITEM_TABLE, $orderItemQuery, 1, 0);

			// If the order item exists, update
			if ($existingOrderItem->num_rows() > 0) {
				$this->db->update(self::ORDER_ITEM_TABLE, $item, $orderItemQuery);
			}
			// Else insert the order item
			else{
				$item['created_at'] = $upsertTime;// Insert needs a created_at time as well
				$this->db->insert(self::ORDER_ITEM_TABLE, $item);
			}
		}
	}

	function getOrders($user_id) {
		$this->db->where('user_id', $user_id);
		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get(self::ORDER_TABLE);
		if ($query->num_rows > 0) {
			return $query->result_array();
		} else {
			return false;
		}

	}
}