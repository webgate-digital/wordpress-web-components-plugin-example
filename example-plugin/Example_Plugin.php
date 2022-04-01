<?php

/**
 * Plugin Name: Example Plugin
 * Version: 1.0.0
 * Text Domain: example-plugin
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class Example_Plugin
{
    const WEB_COMPONENTS_PROJECT_NAME = 'example-plugin-web-components';

    public function __construct()
    {
        add_action('init', array($this, 'init'));
    }

    function init()
    {
        add_action('wp_head', array($this, 'include_web_components'));
        add_shortcode('my_component', array($this, 'my_component_shortcode'));
    }

    function include_web_components()
    {
        $version = get_file_data(__FILE__, ["Version" => "Version"])["Version"];

?>
        <!--[if IE]>
        <script nomodule src='<?php echo plugins_url("/web-components/" . self::WEB_COMPONENTS_PROJECT_NAME . ".js?version={$version}", __FILE__); ?>'></script>
        <![endif]-->
        <!--[if !IE]><!-->
        <script type="module" src='<?php echo plugins_url("/web-components/" . self::WEB_COMPONENTS_PROJECT_NAME . ".esm.js?version={$version}", __FILE__); ?>'></script>
        <!--<![endif]-->
<?php
    }

    function my_component_shortcode($atts = array(), $content = null)
    {
        extract(shortcode_atts(array(
            'first' => '',
            'middle' => '',
            'last' => '',
        ), $atts));

        return "<my-component first='{$first}' middle='{$middle}' last='{$last}'></my-component>";
    }
}

new Example_Plugin();
