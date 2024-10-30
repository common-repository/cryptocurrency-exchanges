<?php

/**

Plugin Name: Cryptocurrency Exchanges 
Plugin URI: https://howtocreateapressrelease.com/
Description: Displays a list of regulated and legal cryptocurrency exchanges in your WordPress sidebar or any widget area of your wordpress blog.
Version: 1.0 
Author: How To Create A Press Release
Author URI: https://howtocreateapressrelease.com
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt

**/

# Exit if accessed directly
if (!defined("ABSPATH"))
{
	exit;
}

# Constant

/**
 * Exec Mode
 **/
define("CRYPTOEXCHANGES_EXEC",true);

/**
 * Plugin Base File
 **/
define("CRYPTOEXCHANGES_PATH",dirname(__FILE__));

/**
 * Plugin Base Directory
 **/
define("CRYPTOEXCHANGES_DIR",basename(CRYPTOEXCHANGES_PATH));

/**
 * Plugin Base URL
 **/
define("CRYPTOEXCHANGES_URL",plugins_url("/",__FILE__));

/**
 * Plugin Version
 **/
define("CRYPTOEXCHANGES_VERSION","1.0"); 

/**
 * Debug Mode
 **/
define("CRYPTOEXCHANGES_DEBUG",false);  //change false for distribution



/**
 * Base Class Plugin
 * @author PR Wire Pro
 *
 * @access public
 * @version 1.0
 * @package Cryptocurrency Exchanges
 *
 **/

class CryptocurrencyExchanges
{

	/**
	 * Instance of a class
	 * @access public
	 * @return void
	 **/

	function __construct()
	{
		add_action("plugins_loaded", array($this, "cryptoexchanges_textdomain")); //load language/textdomain
		add_action("wp_enqueue_scripts",array($this,"cryptoexchanges_enqueue_scripts")); //add js
		add_action("wp_enqueue_scripts",array($this,"cryptoexchanges_enqueue_styles")); //add css
		add_action("widgets_init", array($this, "cryptoexchanges_widget_cryptoexchanges_widget_init")); //init widget
		add_action("after_setup_theme", array($this, "cryptoexchanges_image_size")); // register image size.
		add_filter("image_size_names_choose", array($this, "cryptoexchanges_image_sizes_choose")); // image size choose.
		add_action("init", array($this, "cryptoexchanges_register_taxonomy")); // register register_taxonomy.
		add_action("wp_head",array($this,"cryptoexchanges_dinamic_js"),1); //load dinamic js
		if(is_admin()){
			add_action("admin_enqueue_scripts",array($this,"cryptoexchanges_admin_enqueue_scripts")); //add js for admin
			add_action("admin_enqueue_scripts",array($this,"cryptoexchanges_admin_enqueue_styles")); //add css for admin
		}
	}


	/**
	 * Loads the plugin's translated strings
	 * @link http://codex.wordpress.org/Function_Reference/load_plugin_textdomain
	 * @access public
	 * @return void
	 **/
	public function cryptoexchanges_textdomain()
	{
		load_plugin_textdomain("cryptocurrency-exchanges", false, CRYPTOEXCHANGES_DIR . "/languages");
	}


	/**
	 * Insert javascripts for back-end
	 * 
	 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_script
	 * @param object $hooks
	 * @access public
	 * @return void
	 **/
	public function cryptoexchanges_admin_enqueue_scripts($hooks)
	{
		if (function_exists("get_current_screen")) {
			$screen = get_current_screen();
		}else{
			$screen = $hooks;
		}
			wp_enqueue_script("cryptoexchanges_admin_widget", CRYPTOEXCHANGES_URL . "assets/js/cryptoexchanges_admin_widget.js", array("jquery"),"1.0",true );
	}


	/**
	 * Insert javascripts for front-end
	 * 
	 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_script
	 * @param object $hooks
	 * @access public
	 * @return void
	 **/
	public function cryptoexchanges_enqueue_scripts($hooks)
	{
			wp_enqueue_script("cryptoexchanges_main", CRYPTOEXCHANGES_URL . "assets/js/cryptoexchanges_main.js", array("jquery"),"1.0",true );
	}


	/**
	 * Insert CSS for back-end
	 * 
	 * @link http://codex.wordpress.org/Function_Reference/wp_register_style
	 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_style
	 * @param object $hooks
	 * @access public
	 * @return void
	 **/
	public function cryptoexchanges_admin_enqueue_styles($hooks)
	{
		if (function_exists("get_current_screen")) {
			$screen = get_current_screen();
		}else{
			$screen = $hooks;
		}
	}


	/**
	 * Insert CSS for front-end
	 * 
	 * @link http://codex.wordpress.org/Function_Reference/wp_register_style
	 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_style
	 * @param object $hooks
	 * @access public
	 * @return void
	 **/
	public function cryptoexchanges_enqueue_styles($hooks)
	{
		// register css
		wp_register_style("cryptoexchanges_main", CRYPTOEXCHANGES_URL . "assets/css/cryptoexchanges_main.css",array(),"1.0" );
			wp_enqueue_style("cryptoexchanges_main");
		// register css
		wp_register_style("cryptoexchanges_widget_cryptoexchanges_widget", CRYPTOEXCHANGES_URL . "assets/css/cryptoexchanges_widget_cryptoexchanges_widget.css",array(),"1.0" );
			wp_enqueue_style("cryptoexchanges_widget_cryptoexchanges_widget");
	}


	/**
	 * Register new widget (cryptoexchanges_widget)
	 *
	 * @access public
	 * @return void
	 **/
	public function cryptoexchanges_widget_cryptoexchanges_widget_init()
	{
		if(file_exists(CRYPTOEXCHANGES_PATH . "/includes/widget.cryptoexchanges_widget.inc.php")){
			require_once(CRYPTOEXCHANGES_PATH . "/includes/widget.cryptoexchanges_widget.inc.php");
			register_widget("CryptoexchangesWidget_Widget");
		}
	}


	/**
	 * Register a new image size.
	 * @link http://codex.wordpress.org/Function_Reference/add_image_size
	 * @access public
	 * @return void
	 **/
	public function cryptoexchanges_image_size()
	{
	}


	/**
	 * Choose a image size.
	 * @access public
	 * @param mixed $sizes
	 * @return void
	 **/
	public function cryptoexchanges_image_sizes_choose($sizes)
	{
		$custom_sizes = array(
		);
		return array_merge($sizes,$custom_sizes);
	}


	/**
	 * Register Taxonomies
	 * @https://codex.wordpress.org/Taxonomies
	 * @access public
	 * @return void
	 **/
	public function cryptoexchanges_register_taxonomy()
	{
	}


	/**
	 * Insert Dinamic JS
	 * @param object $hooks
	 * @access public
	 * @return void
	 **/
	public function cryptoexchanges_dinamic_js($hooks)
	{
		_e("<script type=\"text/javascript\">");
		_e("</script>");
	}
}


new CryptocurrencyExchanges();
