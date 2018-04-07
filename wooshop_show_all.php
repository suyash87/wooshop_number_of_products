<?php
/*
*Plugin Name: wooshop_show_products
*Plugin URI: https://www.freelancer.com/u/Suyash87
*Description:Using this plugin you can set the number of products to show on woocommerce shop page. Please Go to Settings-> Wooshop Show Products
*Version: 1.0
*Author: Suyash
*Author URI: https://www.freelancer.com/u/Suyash87
*License: GPL2
*/

$plugin_url = WP_PLUGIN_URL.'/wooshop_show_all';


/* ADD A LINK TO PLUGIN IN THE ADMIN MENU UNDER 'SETTINGS>flexgrid*/
function wp_wooshop_show_all()
{
  /*add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);
 IT ADDS MENU UNDER SETTINGS LINK IN ADMIN
 */ 
 
 add_options_page('wp_wooshop_show_all Plugin', 
 'Wooshop Show Products', 
 'manage_options' , 
 'wp_wooshop_show_all', 
 'wooshop_show_all' );
}

add_action('admin_menu','wp_wooshop_show_all'); // this will call function and 
//function will execute above code to add menu option under settings




function wooshop_show_all()
{
 		 if(!current_user_can('manage_options'))/*CHECK PERMISSIONS*/
 		 {
  		  		wp_die('do not have permission to access page');
 		 }
		 
		 echo "<h2>Welcome to wooshop show products page</h2><br />

		 You can set the required number of products in the box below and click save.<br /><br />

		 How many products do you want? <span style=color:#7b7b7b;><b>(minimum 1) </b></span><br />"; ?>

		 <div id="products_form">

		 <form action="" method="post">

		 <input type="text" name="products" placeholder="Number of products" id="product_no">

		 <input type="submit" name="submit" value="save">

		 </form>

		 </div>



<?php

		$show_products = $_POST['products'];
				if (isset($show_products)) {

			update_option( "Show all products", $show_products);

			new_loop_shop_per_page();

			}

			if ( is_admin() ) {
				$int = get_site_option('Show all products');

				if($int == ""){
					echo "<span class=woo_success_message>Please set number of products in above box.</span><br />";
 					}
 				else{ echo "<span class=woo_success_message>From now your shop page will show ". $int ." product(s). 
 				Refresh Shop page</span> <br> ";}

 				echo "If you find this plugin useful then please do not forget to let us know on <h4>suyash.patankar@gmail.com / prash.893@gmail.com</h4>";


 			}

		 
}




add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 1025);

function new_loop_shop_per_page() {

  // Return the number of products you wanna show per page.

 $int = get_site_option('Show all products');

 return $int;
}





function wp_sho_products_styles()
{
 		 wp_register_style( 'custom_wooshop', plugins_url('wooshop_show_all/wooshop_show_all.css'));
		 wp_enqueue_style('custom_wooshop');
}

add_action('admin_head', 'wp_sho_products_styles');
add_action('wp_enqueue_scripts', 'wp_sho_products_styles');



?>