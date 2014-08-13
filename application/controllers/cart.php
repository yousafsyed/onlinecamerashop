<?php

class Cart extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('products_model');
		$this->load->model('cart_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library("session");

	}
	public function index() {
		$email = $this->session->userdata('email');
		$data  = array();
		if (!empty($email)) {
			// get user data
			$userdata = $this->users_model->get_user_by_email($email);

			$data['email']     = $email;
			$data['user_name'] = $userdata['user_name'];
			$data['logged_in'] = true;
		} else {
			//not logged it
			$data['user_name'] = 'Guest';
			$data['email']     = 'Guest';
			$data['logged_in'] = false;

		}
		$this->load->view('cart_view', $data);
	}
	public function add() {
		$email        = $this->session->userdata('email');
		$p_id         = $this->input->post('pid');
		$qty          = $this->input->post('qty');
		$color        = $this->input->post('color');
		$product_info = $this->products_model->getProductById($p_id);
		if (empty($email)) {// user is not logged in than just save the data in session

			if (empty($qty)) {
				$qty = 1;
			}

			if (empty($color)) {
				$color = $product_info['color'];
				$color = explode(',', $color);
				$color = $color[0];
			}
			$available_colors  = explode(',', $product_info['color']);
			$current_color_key = array_search($color, $available_colors);
			unset($available_colors[$current_color_key]);
			$data = array(
				'id'      => $p_id,
				'qty'     => $qty,
				'price'   => $product_info['p_price'],
				'name'    => $product_info['p_name'],
				'options' => array('Color' => $color)
			);

			if ($insert_id = $this->cart->insert($data)) {
				$sessiondata = array($insert_id => $available_colors);
				$this->session->set_userdata($sessiondata);
				echo json_encode(array('success' => 'Item Added to cart Successfully'));
			} else {
				echo json_encode(array('error' => 'Something went wrong while adding the item to cart session'));
			}

		} else {// save the cart in database
			$userdata = $this->users_model->get_user_by_email($email);
			$user_id  = $userdata['user_id'];
			if (empty($qty)) {
				$qty = 1;
			}
			if (empty($color)) {
				$color = $product_info['color'];
				$color = explode(',', $color);
				$color = $color[0];
			}
			$available_colors  = explode(',', $product_info['color']);
			$current_color_key = array_search($color, $available_colors);
			unset($available_colors[$current_color_key]);

			// add the product id(p_id) and (user_id) to database
			if ($this->cart_model->addtocart($user_id, $p_id, $qty, $product_info['c_id'], $color)) {

				$data = array(
					'id'      => $p_id,
					'qty'     => $qty,
					'price'   => $product_info['p_price'],
					'name'    => $product_info['p_name'],
					'options' => array('Color' => $color)
				);

				if ($this->cart->insert($data)) {
					echo json_encode(array('success' => 'Item Added to cart Successfully'));
				} else {
					echo json_encode(array('error' => 'Something went wrong while adding the item to cart session'));
				}

			} else {
				echo json_encode(array('error' => 'Something went wrong while adding the item to cart database'));
			}

		}
	}

	public function update() {
		$email = $this->session->userdata('email');

		if (is_array($_POST)) {
			$postdata = $_POST;
			print_r($postdata);
			foreach ($postdata as $key => $items) {

				$data = array(
					'rowid' => $items['rowid'],
					'qty'   => $items['qty'],

				);

				$this->cart->update($data);

			}
		}
		exit();
		// $p_id         = $this->input->post('pid');
		// $qty          = $this->input->post('qty');
		// $color        = $this->input->post('color');

		if (empty($email)) {// user is not logged in than just save the data in session

			if (empty($qty)) {
				$qty = 1;
			}

			if (empty($color)) {
				$color = $product_info['color'];
				$color = explode(',', $color);
				$color = $color[0];
			}
			$available_colors  = explode(',', $product_info['color']);
			$current_color_key = array_search($color, $available_color);
			unset($available_colors[$current_color_key]);
			$data = array(
				'id'      => $p_id,
				'qty'     => $qty,
				'price'   => $product_info['p_price'],
				'name'    => $product_info['p_name'],
				'options' => array('Color' => $color, 'available_colors' => $available_colors)

			);

			if ($this->cart->insert($data)) {
				echo json_encode(array('success' => 'Item Added to cart Successfully'));
			} else {
				echo json_encode(array('error' => 'Something went wrong while adding the item to cart session'));
			}

		} else {// save the cart in database
			$userdata = $this->users_model->get_user_by_email($email);
			$user_id  = $userdata['user_id'];
			if (empty($qty)) {
				$qty = 1;
			}
			if (empty($color)) {
				$color = $product_info['color'];
				$color = explode(',', $color);
				$color = $color[0];
			}
			$available_colors  = explode(',', $product_info['color']);
			$current_color_key = array_search($color, $available_color);
			unset($available_colors[$current_color_key]);
			// add the product id(p_id) and (user_id) to database
			if ($this->cart_model->addtocart($user_id, $p_id, $qty, $product_info['c_id'], $color)) {

				$data = array(
					'id'      => $p_id,
					'qty'     => $qty,
					'price'   => $product_info['p_price'],
					'name'    => $product_info['p_name'],
					'options' => array('Color' => $color),
					'available_colors'         => $available_colors

				);

				if ($this->cart->insert($data)) {
					echo json_encode(array('success' => 'Item Added to cart Successfully'));
				} else {
					echo json_encode(array('error' => 'Something went wrong while adding the item to cart session'));
				}

			} else {
				echo json_encode(array('error' => 'Something went wrong while adding the item to cart database'));
			}

		}

	}

	public function checkout() {
		if ($this->cart->total_items() > 0) {
			$items                        = $this->cart->contents();
			$config["first_name"]         = 'yousaf';
			$config['business']           = 'mmesunny-facilitator@gmail.com';
			$config['cpp_header_image']   = '';// Image header url [750 pixels wide by 90 pixels high]
			$config['return']             = base_url().'index.php/cart/ipn';
			$config['cancel_return']      = base_url().'index.php/cart/payment_rejected';
			$config['notify_url']         = base_url().'index.php/cart/ipn';//IPN Post
			$config['notification_url']   = base_url().'index.php/cart/ipn';//IPN Post
			$config['production']         = false;//Its false by default and will use sandbox
			$config['discount_rate_cart'] = 0;//This means 20% discount
			$config['shipping']           = 20;
			$this->load->library('paypal', $config);
			foreach ($items as $key => $item) {
				//print_r($item);
				$this->paypal->add($item['name'], $item['subtotal']);
			}

			$payment_url = $this->paypal->pay();//Proccess the payment
			header("Location:".$payment_url);
		}

	}
	public function ipn() {

		$this->load->library('PayPal_IPN');// Load the library

		// Try to get the IPN data.
		if ($this->paypal_ipn->validateIPN()) {
			// Succeeded, now let's extract the order
			$this->paypal_ipn->extractOrder();
			$email = $this->session->userdata('email');
			// And we save the order now (persist and extract are separate because you might only want to persist the order in certain circumstances).
			$user_info = $this->users_model->get_user_by_email($email);
			$this->paypal_ipn->saveOrder($user_info['user_id']);

			// Now let's check what the payment status is and act accordingly
			if ($this->paypal_ipn->orderStatus == PayPal_IPN::PAID) {
				$data          = $this->paypal_ipn->order;
				$data['items'] = $this->paypal_ipn->orderItems;
				$this->load->view('payment_success_view', $data);
			}
		} else {
			// Just redirect to the root URL
			{
				$this->load->helper('url');
				redirect('/', 'refresh');
			}
		}

	}
}
