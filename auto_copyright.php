<?php

/**
 * Plugin Name: Auto Copyright Date
 * Description: Change the copyright date automatically.
 * Version: 1.0
 * Author: Dylan RADELET
 * Author URI: /
 **/

function auto_copyright_date_admin_menu()
{
    add_menu_page(
        'Auto Copyright Date Settings',
        'Auto Copyright Date',
        'manage_options',
        'auto-copyright-settings',
        'auto_copyright_options_page'
    );
}
add_action('admin_menu', 'auto_copyright_date_admin_menu');

function auto_copyright_settings()
{
    register_setting('auto_copyright_settings_group', 'auto_copyright_site_name');
    register_setting('auto_copyright_settings_group', 'auto_copyright_class');
    register_setting('auto_copyright_settings_group', 'auto_copyright_color');
    register_setting('auto_copyright_settings_group', 'auto_copyright_font_family');
    register_setting('auto_copyright_settings_group', 'auto_copyright_font_size');

    add_settings_section('auto_copyright_section', 'Site Name and Styles', 'auto_copyright_section_callback', 'auto-copyright-settings');
    add_settings_field('auto_copyright_site_name', 'Enter your site name:', 'auto_copyright_site_name_callback', 'auto-copyright-settings', 'auto_copyright_section');
    add_settings_field('auto_copyright_class', 'Enter copyright class:', 'auto_copyright_class_callback', 'auto-copyright-settings', 'auto_copyright_section');
    add_settings_field('auto_copyright_color', 'Choose copyright color:', 'auto_copyright_color_callback', 'auto-copyright-settings', 'auto_copyright_section');
    add_settings_field('auto_copyright_font_family', 'Choose copyright font family:', 'auto_copyright_font_family_callback', 'auto-copyright-settings', 'auto_copyright_section');
    add_settings_field('auto_copyright_font_size', 'Enter copyright font size:', 'auto_copyright_font_size_callback', 'auto-copyright-settings', 'auto_copyright_section');
}
add_action('admin_init', 'auto_copyright_settings');

function auto_copyright_section_callback()
{
    echo 'Enter the name of your site and customize styles below:';
}

function auto_copyright_site_name_callback()
{
    $site_name = get_option('auto_copyright_site_name');
    echo '<input type="text" name="auto_copyright_site_name" value="' . esc_attr($site_name) . '" />';
}

function auto_copyright_class_callback()
{
    $class = get_option('auto_copyright_class');
    echo '<input type="text" name="auto_copyright_class" value="' . esc_attr($class) . '" />';
}

function auto_copyright_color_callback()
{
    $color = get_option('auto_copyright_color');
    echo '<input type="color" name="auto_copyright_color" value="' . esc_attr($color) . '" />';
}

function auto_copyright_font_family_callback()
{
    $font_family = get_option('auto_copyright_font_family');
    $default_fonts = array(
        'Arial', 'Helvetica', 'Times New Roman', 'Georgia', 'Verdana',
        'Open Sans', 'Roboto', 'Lato', 'Montserrat', 'Source Sans Pro',
        'Noto Sans', 'PT Sans', 'Ubuntu', 'Droid Sans', 'Roboto Condensed',
        'Oswald', 'Raleway', 'Titillium Web', 'Quicksand', 'Muli',
        'Playfair Display', 'Merriweather', 'Crimson Text', 'Libre Baskerville',
        'Poppins', 'Arimo', 'Nunito', 'Fira Sans', 'Karla',
        'Work Sans', 'Cabin', 'Abel', 'Exo', 'Poiret One',
        'Pacifico', 'Dosis', 'Amatic SC', 'Inconsolata', 'Noto Serif',
        'Archivo', 'Josefin Sans', 'Cormorant Garamond', 'Candal', 'Questrial',
        'Maven Pro', 'Rokkitt', 'PT Serif', 'Lobster'
    );

    echo '<select name="auto_copyright_font_family">';
    foreach ($default_fonts as $font) {
        $selected = ($font_family === $font) ? 'selected="selected"' : '';
        echo '<option value="' . esc_attr($font) . '" ' . $selected . '>' . esc_html($font) . '</option>';
    }
    echo '</select>';
}

function auto_copyright_font_size_callback()
{
    $font_size = get_option('auto_copyright_font_size');
    $font_size = $font_size ? $font_size : '';

    echo '<input type="text" name="auto_copyright_font_size" value="' . esc_attr($font_size) . '" placeholder="32" /> px';
}

function auto_copyright_options_page()
{
?>
    <div class="wrap">
    <h2>Auto Copyright Date Settings</h2>
    <p>Click on the shortcode to copy it.</p>
    <p>Shortcode for widget : <span id="copiableCode1" onclick="copyCode(1)">[copyright_date]</span></p>
    <p>Shortcode for php : <span id="copiableCode2" onclick="copyCode(2)"> &lt;?php echo do_shortcode('[copyright_date]'); ?&gt;</span></p>
    
    <form method="post" action="options.php">
        <?php settings_fields('auto_copyright_settings_group'); ?>
        <?php do_settings_sections('auto-copyright-settings'); ?>
        <?php submit_button(); ?>
    </form>

    <p>To support me, don't hesitate to make a donation! : <a href="https://www.paypal.com/donate/?hosted_button_id=H3V7TDGMTKVJU" target="_blank">PayPal Donation Link</a></p>

    <script>
        function copyCode(paragraphNumber) {
            var codeTextId = "copiableCode" + paragraphNumber;
            var codeText = document.getElementById(codeTextId).innerText;
            var range = document.createRange();
            range.selectNode(document.getElementById(codeTextId));
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);

            document.execCommand("copy");

            window.getSelection().removeAllRanges();

            alert("Code copied: " + codeText);
        }
    </script>
</div>

<?php
}

function auto_copyright_shortcode()
{
    $year = date('Y');
    $site_name = get_option('auto_copyright_site_name', 'VotreNomDuSite');
    $class = get_option('auto_copyright_class', '');
    $color = get_option('auto_copyright_color', '');
    $font_family = get_option('auto_copyright_font_family', '');
    $font_size = get_option('auto_copyright_font_size', '');

    $font_size_with_unit = $font_size ? $font_size . 'px' : '';

    $style = "color: $color; font-family: $font_family; font-size: $font_size_with_unit;";
    $class_attribute = $class ? "class='$class'" : '';

    return "<span $class_attribute style='$style'>&copy; $year $site_name</span>";
}
add_shortcode('copyright_date', 'auto_copyright_shortcode');

// Please attribute the plugin to Dylan RADELET when used.

?>
