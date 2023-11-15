<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/JarmoTro/wp-plugin-template
 * @since      1.0.0
 *
 * @package    Template
 * @subpackage Template/public
 * @author     Jarmo Troska
 */
class Template_Public {

    /**
     * The name of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The name of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since     1.0.0
     * @param     string    $plugin_name       The name of the plugin.
     * @param     string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register and enqueue the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name . '-main-styles', plugin_dir_url( __DIR__ ) . '/public/css/template.css', array(), $this->version, 'all');
    }

    /**
     * Register and enqueue the scripts for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        $main_scripts_localization = [
            "init_message" => esc_html__("Template scripts initialized.", "template")
        ];
        wp_enqueue_script($this->plugin_name . '-main-scripts', plugin_dir_url( __DIR__ ) . '/public/js/template.js', array(), $this->version, true);
        wp_localize_script($this->plugin_name . '-main-scripts', 'template_translations', $main_scripts_localization);
    }
    
}