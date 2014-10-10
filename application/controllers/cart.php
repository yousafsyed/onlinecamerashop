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
	public function index($error = NULL) {
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
		if($error){$data['error'] = 'Your Entered Quantity is Greater than Avaialable Stock!';}
		$this->load->view('cart_view', $data);
	}
	public function add() {
		$email        = $this->session->userdata('email');
		$p_id         = $this->input->post('pid');
		$qty          = $this->input->post('qty');
		$dbqty          = $this->input->post('dbqty');
		$color        = $this->input->post('color');
		$product_info = $this->products_model->getProductById($p_id);
		//print_r($product_info);

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
		
		$dbqty = $product_info['p_quantity'];
		$data = array(
			'id'      => $p_id,
			'qty'     => $qty,
			'dbqty'   => $dbqty,
			'price'   => $product_info['p_price'],
			'name'    => $product_info['p_name'],
			'options' => array('Color' => $color),
			'c_id'                     => $product_info['c_id']
		);

		// print_r($data);
		if($qty<=$dbqty)
		{	
			if ($insert_id = $this->cart->insert($data)) {

				echo json_encode(array('success' => 'Item Added to cart Successfully'));
			} else {
				echo json_encode(array('error' => 'Something went wrong while adding the item to cart session'));
			}
		}
		else echo json_encode(array('error' => 'Your entered Quantity is more than Avaialable Quantity')); 

	}

	public function update() {
		echo "form submitted";
		$email = $this->session->userdata('email');

		if (is_array($_POST)) {
			$postdata = $_POST;
			//print_r($postdata);
			$dbqty = $_POST['dbqty'];
			print_r($postdata);
			foreach ($postdata as $key => $items) {

				$data = array(
					'rowid' => $items['rowid'],
					'qty'   => $items['qty'],

				);

			if($items['qty'] > $dbqty)
				{
					redirect(base_url('index.php/cart/index/error'), 'referesh');
					// echo $items['qty'].' > '.$dbqty.' - sorry could not be updated';
				}
				
				else 
				{
					if ($this->cart->update($data)) {
						// echo 'cart update';
						redirect(base_url('index.php/cart'), 'refresh');
					} else {
						redirect(base_url('index.php/cart'), 'refresh');
					}
				}

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
			// destroy the cart
			$this->cart->destroy();
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
