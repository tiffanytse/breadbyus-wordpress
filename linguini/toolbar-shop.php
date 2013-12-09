<?php

/*

@name			Shop Toolbar Template
@since			2.0.1
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

global $woo_options, $woocommerce;

?>
    
    <?php gp_start('div', array('toolbar-shop')); ?>

        <ul class="account float-left">
            
            <?php
            	if (!is_user_logged_in()) {
            	?>
            	
                    <li class="login">
                        <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('Login', 'gp'); ?>"><?php _e('Login', 'gp'); ?></a>
                    </li>
                    
                    <li class="signin">
                        <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('Register', 'gp'); ?>"><?php _e('Register', 'gp'); ?></a>
                    </li>
                
                <?php
                } else {
                    global $current_user;
                    get_currentuserinfo();
                ?>
                
                    <li class="loggedin">
                        <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('My Account', 'gp'); ?>"><?php _e('My Account', 'gp'); ?></a>
                    </li>
                    
                    <li class="logout">
                        <a href="<?php echo wp_logout_url( home_url() ); ?>" title="<?php _e('Logout', 'gp'); ?>"><?php _e('Logout', 'gp'); ?></a>
                    </li>
                
                <?php
                }
            ?>
            
        </ul><!-- END // account -->
        
        <ul class="mini-cart float-right">

            <li class="cart">
                <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('Shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
            </li>
            
            <?php
                if (sizeof($woocommerce->cart->get_cart()) == 0) {
                ?>
                
                    <li class="checkout">
                        <a href="<?php echo $woocommerce->cart->get_checkout_url()?>" title="<?php _e('Checkout', 'gp') ?>"><?php _e('Checkout', 'gp') ?></a>
                    </li>
                
                <?php
                }
            ?>

        </ul><!-- END // mini-cart -->

    <?php gp_end('div', array('toolbar-left')); ?>
