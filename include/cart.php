<?php

include('init.php');

$Template->set_data('page_class', 'shoppingcart');

if (isset($_GET['id']) && is_numeric($_GET['id']))
{
	// check if adding valid item
	if (! $Products->product_exists($_GET['id']))
	{
		$Template->set_alert('Invalid item!');
		$Template->redirect('cart.php');
	}
	// add item to cart
	if (isset($_GET['num']) && is_numeric($_GET['num']))
	{
		$Cart->add($_GET['id'], $_GET['num']);
		$Template->set_alert('Items has been added to the cart!');
	}
	else
	{
		$Cart->add($_GET['id']);
		$Template->set_alert('Item has been added to the cart!');
	}
	$Template->redirect('cart.php');
}

if (isset($_GET['empty']))
{
	$Cart->empty_cart();
	$Template->set_data('cart_total_items', 0);
	$Template->set_data('cart_total_cost', '0.00');
	$Template->set_alert('Shopping cart emptied');
	$Template->redirect('cart.php');
}

if (isset($_POST['update1']))
{
	// get all ids of products in cat
	$ids = $Cart->get_ids();

	// make sure we have ids
	if ($ids != NULL)
	{
		foreach ($ids as $id)
		{
			if (is_numeric($_POST['product' .$id]))
			{
				$Cart->update($id, $_POST['product'. $id]);
			}
		}
	}

	$Template->set_data('cart_total_items', $Cart->get_total_items());
	$Template->set_data('cart_total_cost', $Cart->get_total_cost());


	// add alert
	$Template->set_alert('Quantity of items updated');

}

	// get itmes in cart
	$display = $Cart->create_cart_products();
	$Template->set_data('cart_rows', $display);

	// create cart totals
	$display = $Cart->create_cart_totals();
	$Template->set_data('cart_totals', $display);

	// create stipre totals
	$display = $Cart->stripe_total();
	$Template->set_data('stripe_total', $display);
	

	// get category nav
	$category_nav = $Categories->create_category_nav('');
	$Template->set_data('page_nav', $category_nav);

$Template->load('views/v_public_cart.php', 'Shopping Cart');
