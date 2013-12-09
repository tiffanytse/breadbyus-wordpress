<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo('charset'); ?>" />
    
    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
    <link rel="dns-prefetch" href="http://ajax.googleapis.com" />
    
	<?php gp_meta_head(); ?>
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta name="author" content="www.grandpixels.com" />
	
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php if (gp_option('gp_feedburner') != '') { echo gp_option('gp_feedburner'); } else { bloginfo('rss2_url'); } ?>" />
    
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    
    <title><?php wp_title(''); ?></title>

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
	<?php wp_head(); ?>
    
</head>

<body <?php body_class(); ?>>

    <div class="body-background"></div>

    <?php
        if (gp_option('gp_search') != 'false') {
        ?>
            
            <div class="modal-search display-none">
                
                <div class="modal-search-inner">
                    
                    <div class="modal-search-input">
                        
                        <?php get_search_form(); ?>
                        
                    </div>
                    
                </div>
                
                <a href="javascript:;" title="<?php _e('Close', 'gp'); ?>" class="modal-search-close corner-left"></a>
                
            </div><!-- END // modal-search -->
            
        <?php
        }
	?>
    
    <?php
        if (class_exists('woocommerce')) {
            get_template_part('toolbar', 'shop');
        }
    ?>
    
    <div class="header">
    
        <div class="header-container">
        
            <?php 
                if (gp_option('gp_toolbar_header') != 'false') {
                    get_template_part('toolbar', 'left');
                }
            ?>
    
            <?php if (gp_option('gp_image_logo')) { ?>
                    
                <div class="logo logo-image">
                    
                    <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>">
                        <img src="<?php echo gp_option('gp_image_logo'); ?>" alt="<?php echo get_bloginfo('name'); ?>" />
                    </a>
    
                </div><!-- END // logo-image -->
                
            <?php } else { ?>
            
                <div class="logo logo-default">
                    
                    <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php echo get_bloginfo('name'); ?>" />
                    </a>
                    
                </div><!-- END // logo-default -->
                
            <?php } ?>
            
            <?php
                if (gp_option('gp_toolbar_header') != 'false') {
                    get_template_part('toolbar', 'right');
                }
            ?>
        
        </div><!-- END // header-container -->
    
    </div><!-- END // header -->
    
    <nav id="navigation" class="navigation" role="navigation">
        
        <div class="navigation-container">
        
            <div id="navigation-mobile-button" class="navigation-mobile-button">
                
                <a href="#navigation-mobile"></a>
                
            </div><!-- END // navigation-mobile-button -->
        
            <?php gp_navigation(); ?>
        
        </div><!-- END // navigation-container -->
        
    </nav><!-- END // navigation -->