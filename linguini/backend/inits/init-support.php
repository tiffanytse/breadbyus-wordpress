<?php

/*

@name			GPanel Support Init
@package		GPanel WordPress Framework
@since			3.0.0
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Link to Support Forum
====================================================================================================
*/

if (!function_exists('gp_init_support')) {

	function gp_init_support() {
	?>
	
		<script type="text/javascript">
	
			//<![CDATA[
	
				window.location.replace("http://grandpixels.com/support-forum");
	
			//]]>
	
		</script>
	
	<?php
	}

}

?>