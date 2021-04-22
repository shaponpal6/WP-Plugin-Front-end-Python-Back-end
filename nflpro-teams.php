<?php
// Add Shortcode
function nflpro_teams_shortcode($atts)
{
    $team_name1 = isset($atts['team']) ? $atts['team'] : '';
    $data = isset($atts['data']) ? $atts['data'] : 'all';
    $title = (isset($atts['title']) && $atts['title'] != '') ? $atts['title'] : '';
    $team_name2 = isset($_GET['team']) ? $_GET['team'] : '';
    if ($team_name1) {
        $team_name = $team_name1;
    } else {
        $team_name = $team_name2;
    }
    if (!empty($team_name)) {
        //$team_url = 'http://shaponpal.website/nflapi/nfl/teams?team=';
        $team_url = 'http://nflpro.website/api/nfl/teams?team=';
        $url_join = $team_url . $team_name;


        //$nfl_team_file = "http://shaponpal.website/nflproapi/api/nfl/data/schedule.json";
//        $nfl_team_file = "http://nflpro.website/api/api/nfl/data/schedule.json";
//        $nfl_team = "http://shaponpal.website/nflapi/nfl/schedule";
        $delay_time = '+30 second';
        $key = "nfl_team_" . $team_name;
        $target_time = get_user_meta($user_id = 1, $key, true);
        $now = strtotime('now');


        if ($target_time > $now) { # In Limit
            //$url = "http://shaponpal.website/nflproapi/api/nfl/data/" . $team_name . ".json";
            $url = "http://nflpro.website/api/api/nfl/data/" . $team_name . ".json";
            $headers = get_headers($url);
            if (!stripos($headers[0], "200 OK")) {
                $url = $url_join;
            }
        } else {

            if ($target_time = get_user_meta($user_id = 1, $key, true)) {
                update_user_meta(1, $key, strtotime($delay_time));
            } else {
                // New input
                global $wpdb;
                $table = $wpdb->prefix . 'usermeta';
                $data = array('user_id' => 1, 'meta_key' => $key, 'meta_value' => strtotime($delay_time));
                $format = array('%s', '%s');
                $wpdb->insert($table, $data, $format);
                //$my_id = $wpdb->insert_id;
                //print_r($my_id);
            }
            // New Scraper url
            $url = $url_join;
        }
        //$url = "http://shaponpal.website/nflproapi/api/nfl/data/NE.json";
        // Create a curl handle to a non-existing location
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $file = curl_exec($ch);
        curl_close($ch);

        if ($file) {
            $json = json_decode($file);
            ob_start();
//    echo '<pre>';
//    print_r($json[1]);
//    echo '</pre>';
            /**
             * [nflpro-teams team="BUF" data="all"]
             * [nflpro-teams team="BUF" data="draft" title=""]
             * [nflpro-teams team="BUF" data="scoreboard" title=""]
             * [nflpro-teams team="BUF" data="schedule" title=""]
             * [nflpro-teams team="BUF" data="injuries" title=""]
             * [nflpro-teams team="BUF" data="leaders" title=""]
             * [nflpro-teams team="BUF" data="transactions" title=""]
             * [nflpro-teams team="BUF" data="group-point" title=""]
             */

            // Start Table
            if ($data == 'all' || $data == 'draft') {
                $table0 = $json[0];
            }
            if ($data == 'all' || $data == 'scoreboard') {
                $table1 = $json[1];
            }
            if ($data == 'all' || $data == 'schedule') {
                $table2 = $json[2];
            }
            if ($data == 'all' || $data == 'injuries') {
                $table3 = $json[3];
            }
            if ($data == 'all' || $data == 'leaders') {
                $table4 = $json[4];
            }
            if ($data == 'all' || $data == 'transactions') {
                $table5 = $json[5];
            }
            if ($data == 'all' || $data == 'group-point') {
                $table6 = $json[6];
            }

            if (count($json[0]) > 1) {
                include 'tables.php';
            }

            return ob_get_clean();
        }
    }
}

add_shortcode('nflpro-teams', 'nflpro_teams_shortcode');


