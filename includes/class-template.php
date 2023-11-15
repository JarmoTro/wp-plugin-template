<?php

/**
 * The core plugin class.
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/JarmoTro/wp-plugin-template
 * @since      1.0.0
 *
 * @package    Template
 * @subpackage Template/includes
 * @author     Jarmo Troska
 */

class Template {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Template_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {

        $this->version = defined('TEMPLATE_VERSION') ? TEMPLATE_VERSION : "1.0.0";

        $this->plugin_name = 'template';

        $this->load_dependencies();
        $this->register_locale();
        $this->define_public_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - includes/class-template-loader. Registers the hooks and filters of the plugin.
     * - includes/class-template-i18n. Internationalization functionality.
     * - includes/template-global-functions. Functions that can be accessed globally.
     * - public/class-template-public. The public-facing functionality of the plugin.
     *
     * Also creates an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        /*
         * Class that registers all actions and filters for the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-template-loader.php';

        /**
         * Class for handling internationalization.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-template-i18n.php';

        /**
         * The public-facing functionality of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-template-public.php';

        /**
         * Functions that can be accessed globally.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/template-global-functions.php';

        $this->loader = new Template_Loader();

    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Template_i18n class in order to register the plugins text domain.
     *
     * @since    1.0.0
     * @access   private
     */
    private function register_locale() {

        $plugin_i18n = new Template_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {

        $plugin_public = new Template_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that loads the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Template_Loader    Loads the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }
}
