<?php

/*

@name			Styles
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/ 

/*
====================================================================================================
Frontend Styles
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Frontend Output Styles from WordPress Customizer
----------------------------------------------------------------------------------------------------
*/

if (!function_exists('gp_frontend_styles_generate')) {

    function gp_frontend_styles_generate() {
        
        // Google Font Face
        if (gp_option('gp_font_face') != '') {
            $font_face = gp_option('gp_font_face');
        } else {
            $font_face = "Open Sans Condensed";
        }
        
        // Colors
        if (get_theme_mod('gp_color_background')) { $color_background = get_theme_mod('gp_color_background'); } else { $color_background = '#2d1912'; }
        if (get_theme_mod('gp_color_text')) { $color_text = get_theme_mod('gp_color_text'); } else { $color_text = '#ffffff'; }
        if (get_theme_mod('gp_color_primary')) { $color_primary = get_theme_mod('gp_color_primary'); } else { $color_primary = '#d2462d'; }
        if (get_theme_mod('gp_color_secondary')) { $color_secondary = get_theme_mod('gp_color_secondary'); } else { $color_secondary = '#2e8489'; }
        if (get_theme_mod('gp_color_tertiary')) { $color_tertiary = get_theme_mod('gp_color_tertiary'); } else { $color_tertiary = '#4f241c'; }
        if (get_theme_mod('gp_color_navigation_primary')) { $color_navigation_primary = get_theme_mod('gp_color_navigation_primary'); } else { $color_navigation_primary = '#d2462d'; }
        if (get_theme_mod('gp_color_navigation_secondary')) { $color_navigation_secondary = get_theme_mod('gp_color_navigation_secondary'); } else { $color_navigation_secondary = '#2e8489'; }
        
        // Retina Logo
		if (gp_option('gp_image_logo_2x') != '') {
			$image_logo_2x = gp_option('gp_image_logo_2x');
        }

        ?>
    
        <style type="text/css">
    
        /* Font Face */
        
        /* Typography */
        h1, h2, h3, h4, h5, h6 { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
        blockquote { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
        /* Forms */
        label { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
        button, .button a, #submit, #comment-submit { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
        button:hover, .button a:hover, #submit:hover, #comment-submit:hover { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
        /* Search */
        input.input-search[type="text"] { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
        /* Navigation */
        .navigation,
        .navigation-mobile li,
        .navigation-categories,
        .navigation-terms .term { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
        /* Slideshow */
        .slide-caption,
        .slide-caption p { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
        /* Posts */
        .post-price { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
        /* Widgets */
        .widget_recent_tweet .tweet_text, .widget_pages li a, .widget_subpages li a, .widget_nav_menu li a, .widget_archive li, .widget_categories li, .widget_archive li li, .widget_categories li li, .widget_opening_hours .day { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
        .wa-footer-full .widget_recent_tweet .tweet-text { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
        
		<?php if (!empty($image_logo_2x)) { ?>
		@media
        only screen and (-webkit-min-device-pixel-ratio: 2),
        only screen and (-o-min-device-pixel-ratio: 2/1),
        only screen and (min--moz-device-pixel-ratio: 2),
        only screen and (min-device-pixel-ratio: 2),
        only screen and (min-resolution: 192dpi),
        only screen and (min-resolution: 2dppx) {
            
            /* Retina Logo */
            .header .logo-image {
                background-image: url("<?php echo $image_logo_2x; ?>");
                background-position: center center;
                background-repeat: no-repeat;
                -webkit-background-size: auto 100%;
                -moz-background-size: auto 100%;
                -o-background-size: auto 100%;
                background-size: auto 100%;
            }
            .header .logo-image img { visibility: hidden; }
            
        }
        <?php } ?>

        /* CSS Common > Selection */
        ::selection { background: <?php echo $color_secondary; ?>; }
        ::-moz-selection { background: <?php echo $color_secondary; ?>; }
        /* CSS Common > Links */
        a { color: <?php echo $color_text; ?>; }
        a:hover { color: <?php echo $color_text; ?>; background-color: <?php echo $color_primary; ?>; }
        a.underline, .underline a { color: <?php echo $color_text; ?>; border-color: <?php echo $color_text; ?>; }
        a.underline:hover, .underline a:hover { background-color: <?php echo $color_primary; ?>; }
        a.underline-hover, .underline-hover a { color: <?php echo $color_text; ?>; }
        a.underline-hover:hover, .underline-hover a:hover { color: <?php echo $color_text; ?>; border-color: <?php echo $color_text; ?>; }
        /* Body */
        body { color: <?php echo $color_text; ?>; background-color: <?php echo $color_background; ?>; }
        /* Typography */
        blockquote { color: <?php echo $color_primary; ?>; }
        blockquote cite { color: <?php echo $color_text; ?>; }
        /* Forms */
        label { color: <?php echo $color_primary; ?>; }
        button, .button a, #submit, #comment-submit { color: <?php echo $color_text; ?> !important; background-color: <?php echo $color_primary; ?>; border-color: <?php echo $color_text; ?>; }
        button:hover, .button a:hover, #submit:hover, #comment-submit:hover { background-color: <?php echo $color_secondary; ?> !important; border-color: <?php echo $color_secondary; ?>; }
        /* Forms > Comments */
        .comments .comment-body { background-color: <?php echo $color_background; ?>; }
        .comments .comment-body:before { border-top-color: <?php echo $color_background; ?>; }
        .comments .comment-body .alert { color: <?php echo $color_primary; ?>; border-color: <?php echo $color_primary; ?>; }
        .comments .bypostauthor .comment-body { background-color: <?php echo $color_secondary; ?>; }
        .comments .bypostauthor .comment-body:before { border-top-color: <?php echo $color_secondary; ?>; }
        .comments .bypostauthor .comment-body h5 { color: <?php echo $color_text; ?>; }
        .comments #cancel-comment-reply-link { color: <?php echo $color_secondary; ?>; }
        .comments #cancel-comment-reply-link:hover { color: <?php echo $color_text; ?>; }
        .comments #reply-title { color: <?php echo $color_primary; ?>; }
        /* Grid > Common */
        /* Navigation > Navigation - Primary > 1st Level */
        .navigation-primary li,
        .navigation-primary li a { color: <?php echo $color_navigation_primary; ?>; }
        .navigation-primary li:hover a,
        .navigation-primary li a:hover { color: <?php echo $color_navigation_secondary; ?> !important; border-color: <?php echo $color_navigation_secondary; ?>; }
        .navigation-primary li.current-menu-item a,
        .navigation-primary li.current_page_item a { color: <?php echo $color_navigation_secondary; ?>; }
        .navigation-primary li.current-menu-item a:hover,
        .navigation-primary li.current_page_item a:hover,
        .navigation-primary li.current-menu-item:hover a,
        .navigation-primary li.current_page_item:hover a { color: <?php echo $color_navigation_secondary; ?>; }
        /* Navigation > Navigation - Primary > 2nd+ Level */
        .navigation-primary li li,
        .navigation-primary li li a { color: <?php echo $color_navigation_secondary; ?> !important; background-color: <?php echo $color_text; ?>; }
        .navigation-primary li li a:hover { color: <?php echo $color_text; ?> !important; background-color: <?php echo $color_navigation_secondary; ?>; }
        /* Navigation > Navigation - Mobile */
        .mobile-active .navigation-mobile-button a { border-color: <?php echo $color_navigation_secondary; ?>; }
        .navigation-mobile li a { color: <?php echo $color_background; ?> !important; background-color: <?php echo $color_text; ?>; }
        .navigation-mobile li a:hover { color: <?php echo $color_text; ?> !important; background-color: <?php echo $color_navigation_secondary; ?>; }
        /* Navigation > Navigation - Categories */
        .navigation-categories ul li.current-cat a { background-color: <?php echo $color_navigation_secondary; ?>; } 
        .navigation-categories ul li.current-cat a:hover { background-color: <?php echo $color_navigation_primary; ?>; } 
        .navigation-categories ul li ul li a { color: <?php echo $color_navigation_secondary; ?>; } 
        .navigation-categories ul li ul li a:hover { color: <?php echo $color_text; ?>; }
        .navigation-categories ul li ul li.current-cat a { color: <?php echo $color_text; ?>; } 
        .navigation-categories ul li ul li.current-cat ul li a { color: <?php echo $color_navigation_secondary; ?>; } 
        .navigation-categories ul li ul li.current-cat ul li a:hover { color: <?php echo $color_text; ?>; } 
        /* Navigation > Navigation - Terms */
        .navigation-terms .term .term-header a { color: <?php echo $color_navigation_primary; ?>; }
        .navigation-terms .term .term-header a:hover { color: <?php echo $color_navigation_secondary; ?>; }
        .navigation-terms .term .term-image-blank .term-header { background-color: <?php echo $color_background; ?>; }
        .navigation-terms .term .children li a { color: <?php echo $color_navigation_secondary; ?>; }
        .navigation-terms .term .children li a:hover { color: <?php echo $color_text; ?>; }
        /* Toolbar > qTranslate Language Switcher */
        .toolbar .qtrans_language_chooser li a { border-color: <?php echo $color_text; ?>; }
        .toolbar .qtrans_language_chooser li a:hover { background-color: <?php echo $color_text; ?>; }
        /* Toolbar > Search - Modal */
        .modal-search-button a { border-color: <?php echo $color_text; ?>; }
        .modal-search-button a:hover { background-color: <?php echo $color_secondary; ?>; }
        .modal-search-close { background-color: <?php echo $color_secondary; ?>; }
        .modal-search-close:hover { background-color: <?php echo $color_primary; ?>; }
        /* Content */
        .page-content h1, .single-content h1,
        .page-content h2, .single-content h2,
        .page-content h3, .single-content h3,
        .page-content h4, .single-content h4,
        .page-content h5, .single-content h5,
        .page-content h6, .single-content h6 { color: <?php echo $color_secondary; ?>; }
        /* Posts > Common */
        .post-header a { color: <?php echo $color_primary; ?>; }
        .post-header a:hover { color: <?php echo $color_secondary; ?>; border-color: <?php echo $color_secondary; ?>; }
        .post-comments .icon-comment { color: <?php echo $color_text; ?>; }
        .post-comments .icon-comment  { background-color: <?php echo $color_text; ?>; }
        .post-comments .icon-comment:after { border-color: <?php echo $color_text; ?>; }
        .post-comments a:hover .icon-comment  { background-color: <?php echo $color_secondary; ?>; }
        .post-comments a:hover .icon-comment:after { border-color: <?php echo $color_secondary; ?>; }
        .post-more a { color: <?php echo $color_primary; ?>; }
        .post-more a:hover { color: <?php echo $color_secondary; ?>; border-color: <?php echo $color_secondary; ?>; }
        .post-price .price,
        .post-price .price { color: <?php echo $color_primary; ?>; }
        .ingredients { color: <?php echo $color_secondary; ?>; }
        .post-share li a { background-color: <?php echo $color_primary; ?>; }
        .post-share li a:hover { background-color: <?php echo $color_secondary; ?>; }
        .post-buy.button a { color: <?php echo $color_text; ?>; background-color: <?php echo $color_background; ?>; }
        .post-buy.button a:hover { background-color: <?php echo $color_secondary; ?>; border-color: <?php echo $color_text; ?>; }
        /* Posts > Callout Grid Home */
        .grid-callout-home .post a { color: <?php echo $color_background; ?>; }
        .grid-callout-home .post a:hover { color: <?php echo $color_primary; ?>; }
        .grid-callout-home .post .post-header,
        .grid-callout-home .post .post-header a { color: <?php echo $color_text; ?>; background-color: <?php echo $color_primary; ?>; }
        .grid-callout-home .post .post-header a:hover { color: <?php echo $color_text; ?>; background-color: <?php echo $color_secondary; ?>; }
        .grid-callout-home .post.no-url .post-header { color: <?php echo $color_text; ?>; background-color: <?php echo $color_primary; ?>; }
        .grid-callout-home .post .post-header { border-color: <?php echo $color_background; ?>; }
        .grid-callout-home .post .post-content { color: <?php echo $color_background; ?>; background-color: <?php echo $color_text; ?>; }
        /* Posts > Event Grid Home */
        .grid-event-home .post-buy a { color: <?php echo $color_primary; ?>; }
        .grid-event-home .post-buy a:hover { color: <?php echo $color_secondary; ?>; border-color: <?php echo $color_secondary; ?>; }
        /* Posts > Event Grid */
        .grid-event-upcoming .post-status { color: <?php echo $color_secondary; ?>; }
        /* Posts > Menu Grid */
        .grid-menu .post-header, .list-menu .post-header { color: <?php echo $color_primary; ?>; }
        /* Posts > Archive Grid */
        .grid-archives a { color: <?php echo $color_secondary; ?>; }
        .grid-archives a:hover { color: <?php echo $color_text; ?>; background-color: <?php echo $color_secondary; ?>; }
        /* Singles > Common */
        .post-meta .post-categories a { color: <?php echo $color_primary; ?>; }
        .post-meta .post-categories a:hover { color: <?php echo $color_text; ?>; }
        .post-meta-line ul.post-categories a { background-color: <?php echo $color_secondary; ?>; }
        .post-meta-line ul.post-categories a:hover { background-color: <?php echo $color_primary; ?>; }
        /* Singles > Single Blog */
        .single-blog .format-quote blockquote { color: <?php echo $color_text; ?>; }
        /* Singles > Single Event */
        .single-event .post-meta .button a { background-color: <?php echo $color_secondary; ?>; }
        .single-event .post-meta .button a:hover { background-color: <?php echo $color_primary; ?>; }
        .single-event .post-facebook a:hover { background-color: <?php echo $color_secondary; ?> !important; }
        /* Pagination */
        .pagination a,
        .pagination-post a { background-color: <?php echo $color_primary; ?>; }
        .pagination a:hover,
        .pagination-post a:hover,
        .pagination span.current { background-color: <?php echo $color_secondary; ?>; }
        /* Footer */
        .footer .footer-block { background-color: <?php echo $color_background; ?>; }
        /* Widget Tweets [Custom] */
        .widget_tweets li a,
        .widget_recent_tweet li a { color: <?php echo $color_primary; ?>; }
        .widget_tweets li a:hover,
        .widget_recent_tweet li a:hover { color: <?php echo $color_text; ?>; }
        /* Widget Recent [WordPress & Custom] */
        .widget_recent_posts a,
        .widget_recent_events a,
        .widget_recent_albums a,
        .widget_recent_videos a,
        .widget_recent_entries a,
        .widget_recent_comments a { color: <?php echo $color_primary; ?>; border-color: <?php echo $color_primary; ?>; }
        .widget_recent_posts a:hover,
        .widget_recent_events a:hover,
        .widget_recent_albums a:hover,
        .widget_recent_videos a:hover,
        .widget_recent_entries a:hover,
        .widget_recent_comments a:hover { color: <?php echo $color_text; ?>; }
        /* Widget Pages, Subpages, Navigation [WordPress] */
        .widget_pages ul li a:hover,
        .widget_subpages ul li a:hover,
        .widget_nav_menu ul li a:hover { background-color: <?php echo $color_navigation_secondary; ?>; }
        .widget_pages ul li.current_page_item a,
        .widget_subpages ul li.current_page_item a,
        .widget_nav_menu ul li.current_page_item a { background-color: <?php echo $color_navigation_primary; ?>; }
        .widget_pages ul li.current_page_item a:hover,
        .widget_subpages ul li.current_page_item a:hover,
        .widget_nav_menu ul li.current_page_item a:hover { background-color: <?php echo $color_navigation_secondary; ?>; }
        /* Widget Archive, Categories [WordPress] */
        .widget_archive li a,
        .widget_categories li a { color: <?php echo $color_text; ?>; }
        /* Widget Tag Cloud & Tags [WordPress] */
        .post-tags a,
        .widget_tag_cloud a { background-color: <?php echo $color_primary; ?>; }
        .post-tags a:hover,
        .widget_tag_cloud a:hover { background-color: <?php echo $color_secondary; ?>; }
        /* Widget Links [WordPress] */
        .widget_links li a { color: <?php echo $color_primary; ?>; }
        .widget_links li a:hover { color: <?php echo $color_text; ?>; }
        /* Widget qTranslate [qTranslate] */
        .widget_qtranslate li a { background-color: <?php echo $color_primary; ?>; }
        .widget_qtranslate li a:hover { background-color: <?php echo $color_secondary; ?>; }
        
        /* Components */
        
        /* Components > Slideshow */
        .gp-theme .rsPlayBtn .rsPlayBtnIcon { background-color: <?php echo $color_secondary; ?>; }
        .gp-theme .rsPlayBtn:hover .rsPlayBtnIcon { background-color: <?php echo $color_primary; ?>; }
        .gp-theme .rsCloseVideoIcn { background-color: <?php echo $color_secondary; ?>; }
        .gp-theme .rsCloseVideoIcn:hover { background-color: <?php echo $color_primary; ?>; }
        /* Components > Player */
        .player a:hover { background-color: <?php echo $color_primary; ?> !important; }
        .player-progress { background-color: <?php echo $color_secondary; ?>; }
        .player-progress .player-seek-bar { background-color: <?php echo $color_secondary; ?>; }
        .player-progress .player-play-bar { background-color: <?php echo $color_primary; ?>; }
        .player-controls { background-color: <?php echo $color_secondary; ?>; }
        .player-controls .player-volume-value { background-color: <?php echo $color_secondary; ?>; }
        .player-controls .player-volume-container { background-color: <?php echo $color_text; ?>; }
        .player-playlist ul li a { background-color: <?php echo $color_primary; ?>; }
        .player-playlist ul li a:hover { background-color: <?php echo $color_secondary; ?> !important; }
        .player-playlist ul li.jp-playlist-current a { background-color: <?php echo $color_primary; ?> !important; }
        .grid-blog .post-audio { background-color: <?php echo $color_background; ?>; }
        /* Components > Lightbox */
        .lightbox-arrow-left,
        .lightbox-arrow-right { background-color: <?php echo $color_secondary; ?>; }
        .lightbox-arrow-left:hover,
        .lightbox-arrow-right:hover { background-color: <?php echo $color_primary; ?>; }
        .lightbox-close { background-color: <?php echo $color_secondary; ?>; }
        .lightbox-close:hover { background-color: <?php echo $color_primary; ?>; }
        .lightbox-title-container { background-color: <?php echo $color_secondary; ?>; }
        /* Components > Tabs */
        .ui-tabs .ui-tabs-nav li.ui-state-default a { color: <?php echo $color_text; ?>; background-color: <?php echo $color_primary; ?>; }
        .ui-tabs .ui-tabs-nav li.ui-state-default a:hover { color: <?php echo $color_text; ?>; background-color: <?php echo $color_secondary; ?>; }
        .ui-tabs .ui-tabs-nav li.ui-state-active a,
        .ui-tabs .ui-tabs-nav li.ui-state-active a:hover { color: <?php echo $color_primary; ?>; background-color: <?php echo $color_text; ?>; }
        .ui-tabs .ui-tabs-panel { background-color: <?php echo $color_text; ?>; color: <?php echo $color_tertiary; ?>; }
        /* Components > Back to Top Button */
        .back-to-top { background-color: <?php echo $color_secondary; ?>; }
        .back-to-top:hover { background-color: <?php echo $color_primary; ?>; }
        
        <?php if (is_page_template('template-reservation.php')) { ?>
        /* Components > Datepicker */
        .ui-widget-header { background-color: <?php echo $color_primary; ?>; }
        .ui-widget-content { color: <?php echo $color_secondary; ?>; }
        .ui-widget-content a { color: <?php echo $color_secondary; ?>; }
		.ui-state-highlight,
		.ui-widget-content .ui-state-highlight { background-color: <?php echo $color_primary; ?>; border-color: <?php echo $color_primary; ?>; }
		.ui-state-highlight:hover,
		.ui-widget-content .ui-state-highlight:hover { background-color: <?php echo $color_secondary; ?>; border-color: <?php echo $color_secondary; ?>; }
		.ui-state-default:hover { background-color: <?php echo $color_secondary; ?>; }
		.ui-state-active,
		.ui-widget-content .ui-state-active,
		.ui-widget-header .ui-state-active { color: <?php echo $color_primary; ?>; background-color: <?php echo $color_text; ?>; border-color: <?php echo $color_primary; ?>; }
        .ui-state-active:hover,
		.ui-widget-content .ui-state-active:hover,
		.ui-widget-header .ui-state-active:hover { color: <?php echo $color_text; ?>; background-color: <?php echo $color_primary; ?>; }
        <?php } ?>
        
        /* WooCommerce */
        div.woocommerce .product a h3 { color: <?php echo $color_secondary; ?>; }
        div.woocommerce .product a:hover h3 { color: <?php echo $color_primary; ?>; }
        div.woocommerce .product a .from { color: <?php echo $color_text; ?> !important; }
        .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button { color: <?php echo $color_text; ?> !important; background-color: <?php echo $color_primary; ?> !important; }
        
        /* Shop Mini Cart */
        .toolbar-shop .float-right li.cart a:hover { color: <?php echo $color_secondary; ?>; }
        .toolbar-shop .float-right li.checkout a { background-color: <?php echo $color_secondary; ?>; }
        .toolbar-shop .float-right li.checkout a:hover { background-color: <?php echo $color_primary; ?>; }
        
        .toolbar-shop .float-left li a { color: <?php echo $color_secondary; ?>; }
        .toolbar-shop .float-left li a:hover { color: <?php echo $color_text; ?>; }
        
        <?php if (gp_option('gp_custom_css')) {	?>
        
        /* Custom CSS */
        <?php echo stripslashes(htmlspecialchars(gp_option('gp_custom_css'))); ?>
            
        <?php } ?>
        
        </style>
        
        <?php
        
    }
    
    add_action('wp_head', 'gp_frontend_styles_generate');

}

?>