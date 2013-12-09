<?php

/*

@name			GPanel Tweets Init
@package		GPanel WordPress Framework
@since			3.0.3
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Get Tweets [Twitter API 1.1]
====================================================================================================
*/

function gp_tweets($count = 5, $username = false, $options = false) {
    
    // Keys
    $twitter_api_consumer_key = gp_option('gp_twitter_api_consumer_key');
    $twitter_api_consumer_secret = gp_option('gp_twitter_api_consumer_secret');
    $twitter_api_access_token = gp_option('gp_twitter_api_access_token');
    $twitter_api_access_token_secret = gp_option('gp_twitter_api_access_token_secret');
    
    $config['key'] = $twitter_api_consumer_key;
    $config['secret'] = $twitter_api_consumer_secret;
    $config['token'] = $twitter_api_access_token;
    $config['token_secret'] = $twitter_api_access_token_secret;
    
    $config['screenname'] = $username;
    $config['cache_expire'] = 3600;
    
    if ($config['cache_expire'] < 1) { 
        $config['cache_expire'] = 3600;
    }
    
    $config['directory'] = plugin_dir_path(__FILE__);
    
    $object = new gp_Twitter($config);
    $result = $object->getTweets($count, $username, $options);
    
    update_option('tdf_last_error', $object->st_last_error);
    
    return $result;
    
}

/*
====================================================================================================
Create Tweet Links
====================================================================================================
*/

function gp_tweet_links($text) {
        
    $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\" target=\"_blank\">$1</a>", $text);
    $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\" target=\"_blank\">$1</a>", $text);
    
    // email
    $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\" target=\"_blank\">$1</a>", $text);
    
    // @mentions
    $text = preg_replace('~(.*?)@{1}([\w\d_-]+)(.*?)~ui', '$1<a href="http://twitter.com/$2" class="twitter-user" target="_blank">@$2</a>$3', $text);
    
    // #hashes
    $text = preg_replace('~(.*?)#{1}([\w\d_-]+)(.*?)~ui', '$1<a href="http://twitter.com/search?q=%23$2&amp;src=hash" class="twitter-hashtag">#$2</a>$3', $text);
    
    return $text;
    
}