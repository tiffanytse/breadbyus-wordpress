<?php

/*

@name			Comments Template
@since			2.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/ 

if (post_password_required()) {
	echo '<p class="no-comments">This post is password protected. Enter the password to view comments.</p>';
	return;
}

?>

<div id="comments" class="comments one-entire clearfix">

    <h2 class="comments-header">
        <?php 
            comments_number(
                __('No comments', 'gp'),
                __('1 comment', 'gp'),
                __('% comments', 'gp')
            ); 
        ?>
    </h2>
    
    <?php
        if (have_comments()) { ?>

            <div class="comments-list clearfix">
            
                <?php 
                    wp_list_comments(
                        array(
                            'style'			=> 'div',
                            'avatar_size'	=> '40',
                            'callback'		=> 'gp_comments_list'
                        )
                    );
                ?>
            
            </div><!-- END // comments-list -->
    
    <?php
        } else {
            if (comments_open()) {
            ?>
            
                <div class="be-first">
                    <?php _e('You can be the first one to leave a comment.', 'gp'); ?>
                </div>
            
            <?php
            } //if
        } //if
    ?>
    
    <?php
        if ((int) get_option('page_comments') > 1) {
        ?>

            <div class="pagination clearfix">
            
                <?php 
                    paginate_comments_links(
                        array(
                            'prev_text' => __('&lsaquo; Previous', 'gp'),
                            'next_text' => __('Next &rsaquo;', 'gp')
                        )
                    );
                ?>
                
            </div>
    
        <?php
        }
    ?>

    <?php
        if (comments_open()) {
        ?>
        
            <div class="comment-form grid clearfix">
            
                <?php
                    
                    $commenter							= wp_get_current_commenter();
                    $req								= get_option('require_name_email');
                    $aria_req							= ($req ? " aria-required='true'" : '');
                    
                    $comment_form_args = array(
                        'id_form'						=> 'comment-form',
                        'id_submit'						=> 'submit',
                        'title_reply'					=> __('Leave a Reply', 'gp'),
                        'title_reply_to'				=> __('Leave a Reply to %s', 'gp'),
                        'cancel_reply_link'				=> __('Cancel Reply', 'gp'),
                        'label_submit'					=> __('Post Comment', 'gp'),
                        'must_log_in'					=> '<p class="must-log-in">' .  sprintf(__('You must be <a href="%s">logged in</a> to post a comment.', 'gp'), wp_login_url(apply_filters('the_permalink', get_permalink()))) . '</p>',
                        'logged_in_as'					=> '<p class="logged-in-as">' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'gp'), admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink()))) . '</p>',
                        'comment_notes_before'			=> '',
                        'comment_notes_after'			=> '<p class="form-allowed-tags">' . sprintf(__('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'gp'), ' <code>' . allowed_tags() . '</code>') . '</p>',
                        'fields'						=> apply_filters('comment_form_default_fields',
                            array(
                                'author'						=> '<p class="comment-form-author one-third">' . '<label for="author">' . __('Name', 'gp') . ($req ? '<span class="required">' . __('*', 'gp') . '</span>' : '') . '</label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>',
                                'email'							=> '<p class="comment-form-email one-third"><label for="email">' . __('Email', 'gp') . ($req ? '<span class="required">' . __('*', 'gp') . '</span>' : '') . '</label><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>',
                                'url'							=> '<p class="comment-form-url one-third"><label for="url">' . __('Website', 'gp') . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>'
                            )
                        ),
                        'comment_field'					=> '<p class="comment-form-comment one-entire"><label for="comment">' . __('Comment', 'gp') . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>'
                    );
                    
                    comment_form($comment_form_args);
                
                ?>
            
            </div><!-- END // comments-form -->
        
        <?php
        }
    ?>
        
</div><!-- END // comments -->