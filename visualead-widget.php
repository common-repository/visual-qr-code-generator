<?php

/*
Plugin Name: Visualead Widget - Visual QR Code
Description: Visualead makes QR Codes more effective by instantly and seamlessly blending them with any design, attracting users and increasing engagement.
Version: 1.3.9
License: GPL
Author: Visualead
Author URI: www.visualead.com
*/


define('MAGPIE_CACHE_AGE', 120);


// Define our widgets fields
$visual_options['widget_fields']['visualead_myurl'] = array('label' => '<b>My url:</b>', 'type' => 'text', 'default' => 'http://www.visualead.com');
$visual_options['widget_fields']['visualead_color'] = array('label' => '<b>Hex Color</b>', 'type' => 'text', 'default' => '#efefef');

$visual_options['widget_fields']['visualead_subtitle'] = array('label' => '<b>Title:</b> (optional):', 'type' => 'text', 'default' => 'My visualead URL:');
$visual_options['widget_fields']['visualead_txt'] = array('label' => '<b>Small Text:</b> (optional):', 'type' => 'text', 'default' => 'Visualead Visual QR Code');

$visual_options['prefix'] = 'VisualQR';

$visual_options['visualead_url'] = get_option('visualead_url');

// Control what we are about to show
function visualQR_show($visualSettings)
{
    global $visual_options;

    print '<script type="text/javascript"><!--
	var visualead_url = "' . $visualSettings["visualead_url"] . '";

	var visualead_txt = "' . $visualSettings["visualead_txt"] . '";
    var visualead_sub = "' . $visualSettings["visualead_subtitle"] . '";

	//--></script>


	<div style="text-align:center;margin-bottom:10px;padding:10px;border:0;font-size:10px;line-height:1.2;"><div style="font-size:11px;font-weight:bold;text-align:center;margin-bottom:5px;"><a href="http://www.visualead.com/" title="Visualead QR Code"><img style="border:0;" src="http://www.visualead.com/favicon.ico" title="Visualead QR Code" /></a> ' . $visualSettings["visualead_sub"] . '</div><div id="graphimage"></div>
	<div style="margin-top:10px;">' . $visualSettings["visualead_txt"] . '</div>';

      print '<script>if(visualead_url == "http://" || visualead_url == "") {
			visualead_url = "iVBORw0KGgoAAAANSUhEUgAAAHwAAAB8BAMAAABZMMmNAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAgY0hSTQAAeiYAAICEAAD6AAAAgOgAAHUwAADqYAAAOpgAABdwnLpRPAAAABJQTFRF9e71ZgBmLgAuYwBjo2ajWABYcpBYgQAAAAFiS0dEAf8CLd4AAAAJcEhZcwAADsMAAA7DAcdvqGQAAAKuSURBVFjD1ZldboMwEISp1AOUK/QKUd77kBvk/ndpwVl2ZnZJgXWQYhQSiD9nsPfHdoYhlI9xpXwNW8pb4d9UhuHyV25zae92fbnEugl+vV/vP5/T0d7t+no/A98tHvthGBi1q6nEugnOwu1qOs7AD4i3rmj4BDXgdvPGDMe6Cd4kN7lNut05Ay+Kb1XNXPC8CW9CzVjxfAZeFO8ImoybzYaBswdwg3WjfS1+QHzmMh4muOs2OqwHKR641+K7xWuoNERfGwO1CdbXGfhO8VoYwrIpw7JkPM7Ad4pH09DuwiZi6vyDxxENUwcLHyAm7nGs48fFzzh3ElbCVIEh05qfcR4ilIiJCgO2PVwPvCg+VmdEU6Y3tIhnsSxYE7Y/Rg+8KJ6NhR0ldhf+xEP8mplikMZHsLo98KJ4dhUvmCqxCf+BRTxOSFAgT1T08XrgRfFx2q9TQm+MXegRrHTRoRNSfxR24B54UXzsOjWVPFgu/q4Dp4aah+rF30t4UbwaiZoPmxE2LOL5rAcPHfl7AS+KZ2PRLlNjSfydp908YGqqib+X8KJ4NAR1kbX0Qf6eyc0cmE0W5jYFvCg+VtVkwUlDwkUUqqmKU5YEqyJeFJ9PCNWAsvS5BOo4HVXzzZJ3D7woPoYHngDZHV8CER6DE0+/7I7jJL6E27rtoPhYMsOZPtuy7x88M9vps+MkvjO+U7wua9V1rAttu2PC2/cpro5rA+i4ff8KfLd43s5YSw/adXOaiPhactKBm5NUd/yA+Gy7j90GXQaWA+ubjey06LCwGOmOF8Wjo/CkSDfDUhzdlKdkuhX3CrwoXpdC2fYfhQsdOJ2e5Kl7cdiu+AHxutW5/tcO3k/xfIOJ38VoO+K7xWuo1K2ObOvrSZzXjZZs4+1JnC/hO8Vv/iszKW+N/wI4DtSbrHbF5QAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAxMy0wMS0wM1QxMzoyODo0OCswMDowMGHw8jUAAAAldEVYdGRhdGU6bW9kaWZ5ADIwMTMtMDEtMDNUMTM6Mjg6NDgrMDA6MDAQrUqJAAAAGnRFWHRTb2Z0d2FyZQBQYWludC5ORVQgdjMuNS4xMDD0cqEAAAAASUVORK5CYII=";
		};';
        print 'document.getElementById("graphimage").innerHTML = \'<img src="data:image/png;base64,\'+visualead_url+\'" title="Visualead QR Code" alt="Visualead QR Code" />\'; </script>';




}


// Initializing our widget
function visual_widget_init()
{

    if (!function_exists('register_sidebar_widget'))
        return;

    $check_options = get_option('visual_widget');
    if ($check_options['number'] == '') {
        $check_options['number'] = 1;
        update_option('visual_widget', $check_options);
    }

    function visual_widget($args, $number = 1)
    {

        global $visual_options;


        extract($args);


        include_once(ABSPATH . WPINC . '/rss.php');
        $options = get_option('visual_widget');

        // Adding default values if not set.
        $item = $options[$number];
        foreach ($visual_options['widget_fields'] as $key => $field) {
            if (!isset($item[$key])) {
                $item[$key] = $field['default'];
            }
        }
        $item['visualead_url'] = $visual_options['visualead_url'];


        echo $before_widget;
        visualQR_show($item);
        echo $after_widget;
    }


    function visual_widget_control($number)
    {

        global $visual_options;


        $options = get_option('visual_widget');

        foreach ($visual_options['widget_fields'] as $key => $field) {

            $field_name = sprintf('%s_%s_%s', $visual_options['prefix'], $key, $number);
            $field_checked = '';
            if ($field['type'] == 'text') {
                $field_value = htmlspecialchars($options[$number][$key], ENT_QUOTES);
            }

            printf('<p style="text-align:right;" class="visualead_field"><label for="%s">%s <input id="%s" name="%s" type="%s" value="%s" class="%s" %s /></label></p>',
                   $field_name, __($field['label']), $field_name, $field_name, $field['type'], $field_value, $field['type'], $field_checked);
        }

        echo '<input type="hidden" id="visual-submit" name="visual-submit" value="1" />';
    }

    function visual_widget_setup()
    {
        $options = $newoptions = get_option('visual_widget');

        if (isset($_POST['visual-number-submit'])) {
            $number = (int)$_POST['visual-number'];
            $newoptions['number'] = $number;
        }

        if ($options != $newoptions) {
            update_option('visual_widget', $newoptions);
            visual_widget_register();
        }

    }

    function visual_widget_register()
    {

        $options = get_option('visual_widget');
        $dims = array('width' => 300, 'height' => 300);
        $class = array('classname' => 'visual_widget');

        for ($i = 1; $i <= 9; $i++) {
            $name = sprintf(__('Visualead QR Code widget'), $i);
            $id = "visualead-$i"; // Never never never translate an id
            wp_register_sidebar_widget($id, $name, $i <= $options['number'] ? 'visual_widget' : /* unregister */
                                                  '', $class, $i);
            wp_register_widget_control($id, $name, $i <= $options['number'] ? 'visual_widget_control' : /* unregister */
                                                  '', $dims, $i);
        }

        add_action('sidebar_admin_setup', 'visual_widget_setup');
    }

    add_externals();
    visual_widget_register();
}


// Adding scripts needed by the widget - jquery well you know jquery , spectrum for our color select option
function add_externals()
{

    wp_register_script('spectrum', plugins_url('/js/spectrum.js', __FILE__));
    wp_register_style('spectrum', plugins_url('/stylesheet/spectrum.css', __FILE__));

}

// Run our code later in case this loads prior to any required plugins.
add_action('widgets_init', 'visual_widget_init');
add_action('admin_menu', 'baw_create_menu');


// Adding our menu
function baw_create_menu()
{
    //create new top-level menu
    add_menu_page('Visualead QR Code Settings', 'Visualead QR', 'administrator', __FILE__, 'baw_settings_page', plugins_url('/images/icon.png', __FILE__));

    //call register settings function
    add_action('admin_init', 'register_mysettings');
}


function register_mysettings()
{
    //register our settings
    wp_enqueue_script('jquery');
    wp_enqueue_script('spectrum');
    wp_enqueue_style('spectrum');
    register_setting('baw-settings-group', 'my_url');
    register_setting('baw-settings-group', 'visualead_txt');
    register_setting('baw-settings-group', 'visualead_sub');
}


// Visualising our options page
function baw_settings_page()
{


    ?>
<div class="wrap" style="float:left;">
    <h2>Visualead Visual QR Code Settings</h2>

    <form method="POST" action="">
        <?php
            $options = get_option('visual_widget');
        global $visual_options;
        $number = 1;
        foreach ($visual_options['widget_fields'] as $key => $field) {

            $field_name = sprintf('%s_%s_%s', $visual_options['prefix'], $key, $number);
            $field_checked = '';
            if ($field['type'] == 'text') {
                $field_value = htmlspecialchars($options[$number][$key], ENT_QUOTES);
            }

            printf('<p  class="visualead_field"><label for="%s">%s <input id="%s" name="%s" type="%s" value="%s" class="%s" %s /></label></p>',
                   $field_name, __($field['label']), $field_name, $field_name, $field['type'], $field_value, $field['type'], $field_checked);
        }
        printf('<script>jQuery("#VisualQR_visualead_color_1").spectrum({preferredFormat: "hex",showInput: true});</script>');
        echo '<input type="submit" id="visual-submit" name="visual-submit" value="Save" />';
        ?>
        <div id="loading" style="visibility: hidden;"><img src="<?= plugins_url('/images/loading.gif', __FILE__) ?>"/>
        </div>
    </form>
</div>
<div>
    <div id="vis_outer_wrapper">
        <div id="vis_inner_wrapper">
            <div class="vis_top_text">Preview</div>
            <div class="vis_center_image">
                <div style="margin-left:15%;"><?= $options[1]['visualead_subtitle'] ?></div>
                <div style="padding-left:15px;"><img src="data:image/png;base64,<?= get_option('visualead_url'); ?>"/>

                    <div style="margin-top:10px;margin-left:25px;"><?= $options[1]['visualead_txt'] ?></div>
                </div>

            </div>


        </div>

    </div>


</div>

<?php
}

// Handle save . update / add options.
global $visual_options;

// Get our options and see if we're handling a form submission.
$options = get_option('visual_widget');
if (isset($_POST['visual-submit'])) {


    $number = 1;
    foreach ($visual_options['widget_fields'] as $key => $field) {
        $options[$number][$key] = $field['default'];
        $field_name = sprintf('%s_%s_%s', $visual_options['prefix'], $key, $number);

        if ($field['type'] == 'text') {
            $options[$number][$key] = strip_tags(stripslashes($_POST[$field_name]));
        }
    }
    $options['visualead_url'] = get_option('visualead_url');
    update_option('visual_widget', $options);

    $visualead_url = $options['visualead_url'];
    if (!$visualead_url) {


        add_option('visualead_url', generate_new_qr($options[$number]['visualead_myurl'], substr($options[$number]['visualead_color'], 1)));

    }
    else {
        update_option('visualead_url', generate_new_qr($options[$number]['visualead_myurl'], substr($options[$number]['visualead_color'], 1)));
    }
}
function generate_new_qr($my_url, $color)
{

    $request = "http://api.visualead.com/v1/generate_color_qr?api_key=284ddfc0-fa52-22e1-a21f-08xx200c9a66&redirect=1&action=url&content=" . $my_url . "&hex_color=" . $color . ";&output_type=1";
    $response = file_get_contents($request);
    $json = (array)json_decode($response);


    return $json['image'];
}

?>