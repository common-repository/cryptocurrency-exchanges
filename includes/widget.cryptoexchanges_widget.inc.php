<?php
/**
 * Widget (Cryptocurrency Exchanges)
 *
**/

# Exit if accessed directly
if(!defined("CRYPTOEXCHANGES_EXEC")){
	die();
}


 /**
  * Add widget Cryptocurrency Exchanges
  * 
  * @package Cryptocurrency Exchanges
  * @author PR Wire Pro
  * @version 1.0
  * @access public
  * 
  * Generate by Plugin Maker ~ http://codecanyon.net/item/wordpress-plugin-maker-freelancer-version/13581496
  */
class CryptoexchangesWidget_Widget extends WP_Widget {

	/**
	 * Option Plugin
	 * @access private
	 **/
	private $options;

	/**
	* Register widget with WordPress.
	*/
	function __construct() {
		parent::__construct(
		"cryptoexchanges_widget", // Base ID
		__("Cryptocurrency Exchanges","cryptocurrency-exchanges"), // Name
		array("description" => __("Displays a list of the top regulated, legal crypto exchanges in your sidebar or wordpress menu", "cryptocurrency-exchanges"),) // Args
		);
		$this->options = get_option("cryptocurrency_exchanges_plugins"); // get current option
	}

	/**
	* Front-end display of widget.
	*
	* @see WP_Widget::widget()
	*
	* @param array $args     Widget arguments.
	* @param array $instance Saved values from database.
	*/
	public function widget( $args, $instance ){
		//TODO: WIDGET OPTION VARIABLE
		/**
		* @var string $instance["title"] - get widget title
		**/
		
		echo $args["before_widget"];
		if (!empty($instance["title"])){
			echo $args["before_title"]. apply_filters("widget_title", $instance["title"] ). $args["after_title"];
		echo __( '<html>
		
		
		
		<head>
	
	<meta http-equiv="content-type" content="text/html; charset=windows-1252"/>

	<style type="text/css">
		body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Liberation Sans"; font-size:x-small }
		a.comment-indicator:hover + comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em;  } 
		a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em;  } 
		comment { display:none;  } 
		body {
  font-family: "Open Sans", sans-serif;
  line-height: 1.25;
}

	</style>
	
</head>

<body>
 <p>Legal, Regulated Crypto Exchanges List, Updated May 2021.</p>
<div style="overflow-x:auto;"><table>
 
  <thead>
    <tr>
	<th scope="col">Rating</th>
      <th scope="col">Exchange</th>
      <th scope="col">Website URL</th>
    </tr>
  </thead>
  <tbody>
    <tr>
	<td scope="row" data-label="Rating">#1</td>
      <td data-label="Exchange">Binance.US</td>
      <td data-label="Website URL"><a href="https://binance.us">https://binance.us</a></td>
    
    </tr>
    <tr>
	<td scope="row" data-label="Rating">#2</td>
      <td data-label="Exchange">Coinbase Pro</td>
      <td data-label="Website URL"><a href="https://coinbase.com">https://coinbase.com</a></td>
 
	 
  
    </tr>
    <tr>
	<td scope="row" data-label="Rating">#3</td>
      <td data-label="Exchange">Gemini</td>
      <td data-label="Website URL"><a href="https://gemini.com">https://gemini.com</a></td>
    
    </tr>
    <tr>
	<td scope="row" data-label="Rating">#4</td>
     <td data-label="Exchange">Bittrex</td>
      <td data-label="Website URL"><a href="https://bittrex.com/">https://bittrex.com/</a></td>

    </tr>
	<tr>
	<td scope="row" data-label="Rating">#5</td>
      <td data-label="Exchange">CEX.IO</td>
      <td data-label="Website URL"><a href="https:/cex.io">https://cex.io</a></td>

    </tr>
	<tr>
	<td scope="row" data-label="Rating">#6</td>
	<td data-label="Exchange">Kraken</td>
      <td data-label="Website URL"><a href="https:/kraken.com">https://kraken.com</a></td>
    

    </tr>
		<tr>
	<td scope="row" data-label="Rating">#7</td>
	 <td data-label="Exchange">BitStamp</td>
      <td data-label="Website URL"><a href="https:/bitstamp.com">https://bitstamp.com</a></td>
    

    </tr>
	
  </tbody>
</table></div>
</body>

</html>', 'cryptoexchanges_widget_domain' );
		}
		
		
		
		
		//Display file path
		if(CRYPTOEXCHANGES_DEBUG==true){
			$file_info = null; 
			$file_info .= "<div>" ; 
			$file_info .= "<pre style=\"color:rgba(255,0,0,1);padding:3px;margin:0px;background:rgba(255,0,0,0.1);border:1px solid rgba(255,0,0,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">%s:%s</pre>" ; 
			$file_info .= "</div>" ; 
			printf($file_info,__FILE__,__LINE__);
		}
		echo $args["after_widget"];
	}

	/**
	* Back-end widget form.
	*
	* @see WP_Widget::form()
	*
	* @param array $instance Previously saved values from database.
	*/
	public function form( $instance ) {
		// Create Title
		$title = ! empty( $instance["title"] ) ? $instance["title"] : __("Cryptocurrency Exchanges", "cryptocurrency-exchanges");
		echo "<p>";
		echo '<label for="'. $this->get_field_id("title" ).'">'. __("Title:") .'</label>';
		echo '<input class="widefat" id="'.  $this->get_field_id("title") .'" name="'. $this->get_field_name("title").'" type="text" value="' . esc_attr( $title ) . '">';
		echo "</p>";
	}

	/**
	* Sanitize widget form values as they are saved.
	*
	* @see WP_Widget::update()
	*
	* @param array $new_instance Values just sent to be saved.
	* @param array $old_instance Previously saved values from database.
	*
	* @return array Updated safe values to be saved.
	*/
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance["title"] = ( ! empty( $new_instance["title"] ) ) ? strip_tags( $new_instance["title"] ) : "";
		
		return $instance;
	}
	
}  
