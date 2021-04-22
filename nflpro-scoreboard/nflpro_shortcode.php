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
    $file = file_get_contents(plugins_url('data/nfl_scraping.json', __FILE__));
    $json= json_decode($file);
    $schedules = $json->schedule;
    //var_dump($json->schedule);
    //var_dump($json->scores[1][4]);
    ob_start(); ?>
    <!--    Shortcode start-->
    <div id="nflpro-carousel">
        <div class="container2" id="resource-slider">
            <button class='arrow prev'></button>
            <button class='arrow next'></button>
            <div class="resource-slider-frame">
                <?php foreach ($schedules as $schedule){ ?>
                <div class="resource-slider-item">
                    <div class="resource-slider-inset">
                        <div class="resource">
                            <footer class="hmt2 small">
                                <p>
                                    <img src="<?php echo plugins_url('images/teams/'.$schedule[0].'.svg', __FILE__);?>" width="24">
                                    <?php echo $schedule[0].'  '.$schedule[1];?>
                                </p>
                                <p>
                                    <img src="<?php echo plugins_url('images/teams/'.$schedule[2].'.svg', __FILE__);?>" width="24">
                                    <?php echo $schedule[2].'  '.$schedule[3];?>
                                </p>
                                <p><?php echo $schedule[4];?></p>
                            </footer>
                        </div>
                    </div>
                </div>

                <?php }?>

            </div>
        </div>
    </div>
    <!--    Shortcode end-->
    <?php return ob_get_clean();
}

add_shortcode('nflpro-schedule', 'nflpro_schedule_shortcode');
add_action('nflpro_carousel', function (){
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

function hook_css_head() {
    //wp_register_style('green_style', plugins_url('css/green_style.css', __FILE__));
    //wp_enqueue_style('green_style');
    ?>
    <link rel='stylesheet' id='green_style-css'  href='http://localhost/wordpress/wp-content/plugins/nflpro-scoreboard/css/green_style.css?ver=4.9.8' type='text/css' media='all' />

    <?php
}
add_action('wp_head', 'hook_css_head');
function load_js_footer() {
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
    echo '<script src="'.plugins_url('js/green_script.js', __FILE__).'"/>';

    //wp_register_script('green_script', plugins_url('js/green_script.js', __FILE__), array('jquery1'));
    //wp_enqueue_script('green_script');

}
add_action( 'wp_footer', 'load_js_footer');

//Include
    include_once 'nflpro-standing.php';