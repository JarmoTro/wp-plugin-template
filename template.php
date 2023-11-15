<?php

/**
 * Plugin Name:       Template
 * Plugin URI:        https://github.com/JarmoTro/wp-plugin-template
 * Description:       Template plugin description
 * Version:           1.0.0
 * Author:            Jarmo Troska
 * Author URI:        https://github.com/JarmoTro/wp-plugin-template
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       template
 */

if (!defined('ABSPATH')) {
    exit;
}

define('TEMPLATE_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-template-activator.php
 */

function activate_template() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-template-activator.php';
    Template_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-template-deactivator.php
 */

function deactivate_template() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-template-deactivator.php';
    Template_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_template');
register_deactivation_hook(__FILE__, 'deactivate_template');

require plugin_dir_path(__FILE__) . 'includes/class-template.php';

/**
 * Initializes the plugin
 */

function run_plugin() {
    $plugin = new Template();
    $plugin->run();
}

run_plugin();
