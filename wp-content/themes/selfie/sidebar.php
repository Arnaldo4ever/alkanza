<?php

if(is_search()){
	$sidebar_choice = "default"; 
} else {
	if(null !== get_post_custom(get_the_ID())){
		$options = get_post_custom(get_the_ID());
		
		if(isset($options['custom_sidebar']))  
		{  
			$sidebar_choice = $options['custom_sidebar'][0];  
		}  
		else  
		{  
			$sidebar_choice = "default";  
		} 		
	} else {
		$sidebar_choice = "default";
	}

}

?>


<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar_choice) ) :   
dynamic_sidebar($sidebar_choice);  
else :  
/* No widget */  
endif; ?>  

