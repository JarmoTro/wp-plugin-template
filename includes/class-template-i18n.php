<?php

/**
 * Class for handling internationalization.
 *
 * @link       https://github.com/JarmoTro/wp-plugin-template
 * @since      1.0.0
 *
 * @package    Template
 * @subpackage Template/includes
 * @author     Jarmo Troska
 */

class Template_i18n {

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain() {

        load_plugin_textdomain(
                'template',
                false,
                dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }

}
