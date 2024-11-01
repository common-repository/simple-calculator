<?php
/**
 * @package simple calculator
 * @version 1.1
 */
/*
Plugin Name: simple calculator
Plugin URI: http://www.devzoneindia.com
Description: simple calculator is a plugin for Calculation functionality for front end as well as backend admin panel
Author: Ronak Dave
Version: 1.1
Author URI: http://www.devzoneindia.com/
*/
add_action('admin_menu', 'scalculator_plugin_menu');

function scalculator_plugin_menu() {
	add_options_page('scalculator Plugin Setup', 'scalculator', 'manage_options', 'scalculator', 'scalculator_plugin_options');
}

function scalculator_plugin_options() {
?>
<script type="application/javascript">
http = getHTTPObject();
 
function getHTTPObject(){
  var xmlhttp;
 
  /*@cc_on
 
  @if (@_jscript_version >= 5)
    try {
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }catch(e){
      try{
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }catch(E){
      xmlhttp = false;
    }
  }
  @else
    xmlhttp = false;
  @end @*/
 
  if(!xmlhttp && typeof XMLHttpRequest != 'undefined'){
    try {
      xmlhttp = new XMLHttpRequest();
    }catch(e){
      xmlhttp = false;
    }
  }
 
  return xmlhttp;
}
 
function doMath(){
  var url = "<?php echo get_bloginfo('url') ?>/wp-content/plugins/simple-calculator/calc.php?op=" + document.getElementById('op').value;
  url += "&num1=" + document.getElementById('num1').value;
  url += "&num2=" + document.getElementById('num2').value;
 
  http.open("GET", url, true);
  http.onreadystatechange = handleHttpResponse;
 
  http.send(null);
}
 
function handleHttpResponse(){
  if(http.readyState == 4){
    document.getElementById('answer').innerHTML = http.responseText;
  }
}
</script>
<div class="scalc">
<h2>Welcome to Simple Calculator</h2>
<br />
<span class="scalc1">Input Value 1 : <input type="text" id="num1" size="6"></span>
<span class="scalc2"><select id="op">
<option value="add">+</option>
<option value="subtract">-</option>
<option selected="selected" value="multiply">*</option>
<option value="divide">/</option>
</select></span>
<span class="scalc3">Input Value 2 : <input type="text" id="num2" size="6"></span>
<input type="button" value=" = " onClick="doMath();"> : <div class="scalc4" id="answer" style="display: inline; font-size: 16px"></div>
<br /><br /><br /><br />
<strong>This Calculator is build for Admin use as well as on the front end use.<br /> Simply use [scalculator] Short code anywhere in the post or page and Simple calculator is ready to use. Unique CSS Class are already defined with the help of which you can design your calculator as per requirement.</strong><br /><br /><br /><br />
Thank you for Using Our Plugin,<br />
from <a href="http://www.devzoneindia.com">Plugin Developer</a>.
</div>

<?php
}


add_shortcode("scalculator","scalculator_plugin_option");
function scalculator_plugin_option() {
?>
<script type="application/javascript">
http = getHTTPObject();
 
function getHTTPObject(){
  var xmlhttp;
 
  /*@cc_on
 
  @if (@_jscript_version >= 5)
    try {
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }catch(e){
      try{
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }catch(E){
      xmlhttp = false;
    }
  }
  @else
    xmlhttp = false;
  @end @*/
 
  if(!xmlhttp && typeof XMLHttpRequest != 'undefined'){
    try {
      xmlhttp = new XMLHttpRequest();
    }catch(e){
      xmlhttp = false;
    }
  }
 
  return xmlhttp;
}
 
function doMath(){
  var url = "<?php echo get_bloginfo('url') ?>/wp-content/plugins/simple-calculator/calc.php?op=" + document.getElementById('op').value;
  url += "&num1=" + document.getElementById('num1').value;
  url += "&num2=" + document.getElementById('num2').value;
 
  http.open("GET", url, true);
  http.onreadystatechange = handleHttpResponse;
 
  http.send(null);
}
 
function handleHttpResponse(){
  if(http.readyState == 4){
    document.getElementById('answer').innerHTML = http.responseText;
  }
}
</script>
<div class="scalc">
<span class="scalc1">Input Value 1 : <input type="text" id="num1" size="6"></span>
<span class="scalc2"><select id="op">
<option value="add">+</option>
<option value="subtract">-</option>
<option selected="selected" value="multiply">*</option>
<option value="divide">/</option>
</select></span>
<span class="scalc3">Input Value 2 : <input type="text" id="num2" size="6"></span>
<input type="button" value=" = " onClick="doMath();"> : <div class="scalc4" id="answer" style="display: inline; font-size: 16px"></div>
</div>
<?php
}


add_action( 'widgets_init', 'scalculator_widget' );


function scalculator_widget() {
	register_widget( 'SC_Widget' );
}

class SC_Widget extends WP_Widget {

	function SC_Widget() {
		$widget_ops = array( 'classname' => 'scalculator', 'description' => __('A widget for displaying Calulator ', 'scalculator') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'scalculator-widget' );
		
		$this->WP_Widget( 'scalculator-widget', __('Calulator Widget', 'scalculator'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		//$name = $instance['name'];
		//$show_info = isset( $instance['show_info'] ) ? $instance['show_info'] : false;

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;
			
			
		do_shortcode('[scalculator]');

		//Display the name 
		//if ( $name )
			//printf( '<p>' . __('Hey their Sailor! My name is %1$s.', 'example') . '</p>', $name );

		
		//if ( $show_info )
			//printf( $name );

		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		//$instance['name'] = strip_tags( $new_instance['name'] );
		//$instance['show_info'] = $new_instance['show_info'];

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Simple Calculator', 'scalculator'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'scalculator'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
        <p>There are no Other Params Needed to run this Widget, Just Save it and its ready to go. </p>
        <p>class are already defined for making CSS changes to the Widget. You can design the Widget how ever you like as per the Sites need</p>
		

	<?php
	}
}
?>