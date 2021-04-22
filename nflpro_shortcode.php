<?php
/*
Plugin Name: nflpro-schedule
Plugin URI: https://www.fiverr.com/shapon_pal
Description: This is nflpro-schedule Plugin.
Version: 1.0
Author: Shapon Pal
Author URI: https://www.fiverr.com/shapon_pal
License: GPL2
*/


// Add Shortcode
function nflpro_schedule_shortcode()
{
//    $nfl_url_file = "http://shaponpal.website/nflproapi/api/nfl/data/schedule.json";
    $nfl_url_file = "http://nflpro.website/api/api/nfl/data/schedule.json";
//    $nfl_url = "http://shaponpal.website/nflapi/nfl/schedule";
    $nfl_url = "http://nflpro.website/api/nfl/schedule";
    $nfl_url_file = "http://nflpro.website/api/nfl/schedule";
    $delay_time = '+30 second';
    $target_time = get_user_meta($user_id = 1, 'nfl_schedule_time', true);
    $now = strtotime('now');

    if ($target_time > $now) { # In Limit
        //echo 'In Limit last file request ';
        $file = file_get_contents($nfl_url_file, true);
    } else { # new Request
        //echo 'New CURL Request ';
        // Start Time Limit for next Request
        // So check and make sure the stored value matches
        if ($target_time = get_user_meta($user_id = 1, 'nfl_schedule_time', true)) {
            update_user_meta(1, 'nfl_schedule_time', strtotime($delay_time));
        } else {
            // New input
            global $wpdb;
            $table = $wpdb->prefix . 'usermeta';
            $data = array('user_id' => 1, 'meta_key' => 'nfl_schedule_time', 'meta_value' => strtotime($delay_time));
            $format = array('%s', '%s');
            $wpdb->insert($table, $data, $format);
            //$my_id = $wpdb->insert_id;
            //print_r($my_id);
        }

        // Create a curl handle to a non-existing location
        $ch = curl_init($nfl_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $file = '';
        if (($file = curl_exec($ch)) === true) {
            //echo 'Curl error: ' . curl_error($ch);
            //$file = file_get_contents($nfl_url_file, true);
        } else {
            //echo ' Operation completed without any errors';
            //echo ' || But  error Found : ' . curl_error($ch);
            $file = file_get_contents($nfl_url_file, true);

        }
        // Close handle
        curl_close($ch);
    }
    if ($file) {
        $json = json_decode($file);
        $schedules = $json->schedule;
    } else {
        echo 'Alert: No File Found';
    }


    //   $schedule_url = "http://shaponpal.website/nflapi/nfl/schedule";
    //$file = @file_get_contents($schedule_url);
    //$file = file_get_contents(plugins_url('data/point-table.json', __FILE__));
//    if (!$file = @file_get_contents($schedule_url)) {
//        //echo("Something Went Wrong. Please try again");
//        $file = file_get_contents(plugins_url('data/schedule.json', __FILE__));
//    }
//    $file = file_get_contents(plugins_url('data/schedule.json', __FILE__));
//    $json = json_decode($file);
//    $schedules = $json->schedule;
//    var_dump($json->schedule);
//    var_dump($json->scores[1][4]);


    ob_start();
    if ($schedules) {
        ?>
        <!--    Shortcode start-->
        <div id="nflpro-carousel">
            <div class="container2" id="resource-slider">
                <button class='arrow prev'></button>
                <button class='arrow next'></button>
                <div class="resource-slider-frame">
                    <?php
                    foreach ($schedules as $schedule) { ?>
                        <div class="resource-slider-item">
                            <div class="resource-slider-inset">
                                <div class="resource">
                                    <footer class="hmt2 small">
                                        <p>
                                            <a target="_blank"
                                               href="<?php echo home_url('/teams?team=') . $schedule[0]; ?>">
                                                <img src="<?php echo plugins_url('images/teams/' . $schedule[0] . '.svg', __FILE__); ?>"
                                                     width="24">
                                                <?php echo $schedule[0] . '  ' . $schedule[1]; ?>
                                            </a>
                                        </p>
                                        <p>
                                            <a target="_blank"
                                               href="<?php echo home_url('/teams?team=') . $schedule[2]; ?>">
                                                <img src="<?php echo plugins_url('images/teams/' . $schedule[2] . '.svg', __FILE__); ?>"
                                                     width="24">
                                                <?php echo $schedule[2] . '  ' . $schedule[3]; ?>
                                            </a>
                                        </p>
                                        <p><?php echo $schedule[4]; ?></p>
                                    </footer>
                                </div>
                            </div>
                        </div>

                    <?php }
                    ?>

                </div>
            </div>
        </div>
        <!--    Shortcode end-->
        <?php
    } else {
        echo '';
    }
    return ob_get_clean();
}

add_shortcode('nflpro-schedule', 'nflpro_schedule_shortcode');
add_action('nflpro_carousel', function () {
    //echo 'body begain here 1111';
    echo nflpro_schedule_shortcode();
});


// Add Style
function greenline_style()
{
    wp_register_style('green_style', plugins_url('css/green_style.css', __FILE__));
    wp_enqueue_style('green_style');
    wp_register_script('jquery1', plugins_url('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', __FILE__));
    wp_enqueue_script('jquery1');
    wp_register_script('green_script', plugins_url('js/green_script.js', __FILE__), array('jquery1'));
    wp_enqueue_script('green_script');
}

//add_action('wp_enqueue_scripts', 'greenline_style');

function hook_css_head()
{
    //wp_register_style('green_style', plugins_url('css/green_style.css', __FILE__));
    //wp_enqueue_style('green_style');
    ?>
    <link rel='stylesheet' id='green_style-css' href="<?php echo plugins_url('css/green_style.css', __FILE__); ?>"
          type='text/css' media='all'/>

    <?php
}

add_action('wp_head', 'hook_css_head');
function load_js_footer()
{
    ?>
    <script>
        //        var nflpro_carousel = document.getElementById("nflpro-carousel").innerHTML;
        //        var body = document.body.innerHTML;
        //        document.body.innerHTML = nflpro_carousel + body;

        //        var v_centered = document.getElementsByClassName('v-centered');
        //        var body = document.getElementsByTagName('body');
        //
        //        var div = document.createElement('div');
        //        Array.prototype.slice.call(v_centered).forEach(v_centered, function(v_centered) {
        //            div.appendChild(v_centered);
        //        });
        //        document.body.appendChild(div);
        //document.body.innerHTML = body;

    </script>
    <?php
    //echo nflpro_schedule_shortcode();
    wp_enqueue_script('jquery');
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>';
    echo '<script src="' . plugins_url('js/green_script.js', __FILE__) . '"/>';

    //wp_register_script('green_script', plugins_url('js/green_script.js', __FILE__), array('jquery1'));
    //wp_enqueue_script('green_script');

}

add_action('wp_footer', 'load_js_footer');

//Include
include_once 'nflpro-standing.php';
include_once 'nflpro-standing-individual.php';
include_once 'nflpro-teams.php';