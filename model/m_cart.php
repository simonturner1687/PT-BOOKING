<?php

/*
	Cart Class
	HAndle all tasks realted to showing or modyifying the number of items in a cart

	The cart keeps trak of user selected items using a session variable, $_SESSION['cart'].
	The session variable holds an array that contains the id's and number of selected products in the cart

	$_SESSION['cart']['product_id'] = num of specified items in cart

*/

class Cart
{
	function __construct() {}

	/* 
		Getters and Setters
	*/

	/**
	* return array of all product info for items in the cart
	*
	* @access public
	* @param 
	* @return array, null
	*/	
	public function get()
	{
		if (isset($_SESSION['cart']))
		{
			// get all the product ids of items in the cart
			$ids = $this->get_ids();

			// use list of ids to get product info 
			global $Products;
			return $Products->get($ids);
		}
		return NULL;
	}

	/**
	* return array of all product ids in cart
	*
	* @access public
	* @param 
	* @return array, NULL
	*/	
	public function get_ids()
	{
		if (isset($_SESSION['cart']))
		{
			return array_keys($_SESSION['cart']);
		}
		return NULL;
	}

	/**
	* Adds items to the cart
	*
	* @access public
	* @param int, int
	* @return null
	*/	
	public function add($id, $num = 1)
	{
		// setup or retrieve cart
		$cart = array();

		if (isset($_SESSION['cart']))
		{
			$cart = $_SESSION['cart'];
		}

		// Check to see if item is already in cart
		if (isset($cart[$id]))
		{
			// if item is in cart
			$cart[$id] = $cart[$id] + $num;
		}
		else
		{
			// if itme is not in cart
			$cart[$id] = $num;
		}
		$_SESSION['cart'] = $cart;
	}

/**
	* update quantity of items in the cart
	*
	* @access public
	* @param int, int
	* @return NULL
	*/	
	public function update($id, $num)
	{
		if ($num == 0)
		{
			unset($_SESSION['cart'][$id]);
			if (empty($_SESSION['cart']))
			{
				unset($_SESSION['cart]']);
			}
		}
		else
		{
			$_SESSION['cart'][$id] = $num;
		}
	}



	/**
	* Empties contents of the cart
	*
	* @access public
	* @param 
	* @return null
	*/	
	public function empty_cart()
	{
		unset($_SESSION['cart']);
	}


	/**
	* return total number of all items in cart
	*
	*
	* @access public
	* @param
	* @return int
	*/
	public function get_total_items()
	{
		$num = 0;

		if (isset($_SESSION['cart']))
		{
			foreach($_SESSION['cart'] as $item)
			{
				$num = $num + $item;
			}
		}
		return $num;
	}

	/**
	* return total cost of all items in cart
	*
	*
	* @access public
	* @param
	* @return int
	*/
	public function get_total_cost()
	{
		$num = '0.00';

		if (isset($_SESSION['cart'])) // checks there are items to display
		{
			// get product id's
			$ids = $this->get_ids();

			//get products prices
			global $Products;
			$prices = $Products->get_prices($ids); // return array of prices set

			// loop through, adding cost of each item x the number of the item in the cart then add to $num
			if ($prices != NULL)
			{
				foreach ($prices as $price)
				{
					$num += doubleval($price['price'] * $_SESSION['cart'][$price['id']]); 
				}
			}
		}
		return $num;
	}

	/**
	* return shipping copst based on item price
	*
	*
	* @access public
	* @param double
	* @return double
	*/
	public function get_shipping_cost($total)
	{
		if ($total >= 200)
		{
			return 40.0;
		}
		else if ($total >= 50)
		{
			return 15.0;
		}
		else if ($total >= 10)
		{
			return 4.0;
		}
		else
		{
			return 2.0;
		}
	}

	/*
	Creation of page elements
	*/

	/**
	* return string contained list items for each product in cart
	*
	*
	* @access public
	* @param
	* @return string
	*/
	public function create_cart_products()
	{
		// get prodcuts currently in the cart
		$products = $this->get();

		$data ='';
		$total = 0;

		if ($products != '')
		{
			// products to display
			$shipping = 0;

			foreach($products as $product)
			{
				
				//create new item in cart

				$data .= '<tr>';
                $data .= '<td scope="row">' .$product['name']. '</td>';
                $data .= '<td><input class="cart" name="product' .$product['id']. '" value="' .$_SESSION['cart'][$product['id']]. '"></td>';
                $data .= '<td>£' .number_format($product['price'], 2). '</td>';
                $data .= '<td>£' .number_format($product['price'] * $_SESSION['cart'][$product['id']],2). '</td>';
				$data .= '</tr>';
			}
			return $data;
		}
		else
		{
			$data .= '<tr>';
	        $data .= '<td scope="row"><strong>There are no items in the cart!</strong></td>';
	        $data .= '<td></td>';
	        $data .= '<td></td>';
	        $data .= '<td></td>';
			$data .= '</tr>';
		}
		return $data;
	}


public function create_cart_totals()
	{
		// get prodcuts currently in the cart
		$products = $this->get();

		$data ='';
		$total = 0;

		if ($products != '')
		{
			// products to display
			$shipping = 0;

			foreach($products as $product)
			{
				$shipping += ($this->get_shipping_cost($product['price']));
				$total += $product['price'] * $_SESSION['cart'][$product['id']];
			}


			// add subtotal row
				$data .= '<tr>';
		        $data .= '<th>Subtotal</th>';
		        $data .= '<td scope="row">£ ' .number_format($total, 2).'</td>';
			    $data .= '</tr>';

			//Shipping
				$data .= '<tr>';
		        $data .= '<th>Shipping</th>';
		        $data .= '<td>£ '.number_format($shipping, 2). '</td>';
			    $data .= '</tr>';

			// taxes row
			if (SHOP_TAX > 0)
			{
				$data .= '<tr>';
		        $data .= '<th>VAT (' .(SHOP_TAX * 100). '%)</th>';
		        $data .= '<td>£ ' .number_format(SHOP_TAX * $total, 2).'</td>';
			    $data .= '</tr>';
			}

			// add total row
				$data .= '<tr class="success">';
		        $data .= '<th>Total</th>';
		        $data .= '<td>£ ' .number_format((SHOP_TAX * $total) + $total + $shipping, 2).'</td>';
			    $data .= '</tr>';
		
				return $data;
		}
		else
		{

			// add subtotal row
				$data .= '<tr>';
		        $data .= '<th>Subtotal</th>';
		        $data .= '<td scope="row">£ 0.00</td>';
			    $data .= '</tr>';

			// shipping
				$data .= '<tr>';
		        $data .= '<th>Shipping</th>';
		        $data .= '<td>£ 0.00</td>';
			    $data .= '</tr>';	  			

			// taxes row
			if (SHOP_TAX > 0)
			{
				$data .= '<tr>';
		        $data .= '<th>VAT (' .(SHOP_TAX * 100). '%)</th>';
		        $data .= '<td>£ 0.00</td>';
			    $data .= '</tr>';
			}

			// add total row
				$data .= '<tr class="success">';
		        $data .= '<th>Total</th>';
		        $data .= '<td>£ 0.00</td>';
			    $data .= '</tr>';
			}
		return $data;
	}

	public function stripe_total()
	{
		// get prodcuts currently in the cart
		$products = $this->get();

		$data ='';
		$total = 0;


		if ($products != '')
		{
			// products to display
			$shipping = 0;

			foreach($products as $product)
			{
				$shipping += ($this->get_shipping_cost($product['price']));
				$total += $product['price'] * $_SESSION['cart'][$product['id']];
			}

			$data = (SHOP_TAX * $total) + $total + $shipping; 


			return $data;
		}
	}

	public function cart_products_email()
	{
		// get prodcuts currently in the cart
		$products = $this->get();

		$data ='';
		$total = 0;

		if ($products != '')
		{
			// products to display
			$shipping = 0;

			foreach($products as $product)
			{
				
				//create new item in cart


                $data .= "Product: ".$product['name']. "\n\n";
                $data .= "Quantity: ".$_SESSION['cart'][$product['id']]. "\n\n";
                $data .= "Item Price: ".number_format($product['price'], 2). "\n\n";
                $data .= "Item Subtotal: ".number_format($product['price'] * $_SESSION['cart'][$product['id']],2). "\n\n";
                $data .= "................................\n\n";
			}
			return $data;
		}
		else
		{
	        $data .= 'There are no items in the cart!';

		}
		return $data;
	}







} 