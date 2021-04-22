<?php

// Add Shortcode
function nflpro_standing_group($atts)
{
    $group = (isset($atts['group']) && $atts['group'] != '') ? $atts['group'] : '1';
    $title = (isset($atts['title']) && $atts['title'] != '') ? $atts['title'] : '';
//    $point_url_file = "http://shaponpal.website/nflproapi/api/nfl/data/point-table.json";
    $point_url_file = "http://nflpro.website/api/api/nfl/data/point-table.json";
//    $point_url = "http://shaponpal.website/nflapi/nfl/point-table";
    $point_url = "http://nflpro.website/api/nfl/point-table";
    $delay_time = '+30 second';
    $target_time = get_user_meta($user_id = 1, 'point_table_time', true);
    $now = strtotime('now');

    if ($target_time > $now) { # In Limit
        //echo 'In Limit last file request';
        $file = file_get_contents($point_url_file, true);
    } else { # new Request
        //echo 'New CURL Request | ';
        // Start Time Limit for next Request
        // So check and make sure the stored value matches
        if ($target_time = get_user_meta($user_id = 1, 'point_table_time', true)) {
            update_user_meta(1, 'point_table_time', strtotime($delay_time));
        } else {
            // New input
            global $wpdb;
            $table = $wpdb->prefix . 'usermeta';
            $data = array('user_id' => 1, 'meta_key' => 'point_table_time', 'meta_value' => strtotime($delay_time));
            $format = array('%s', '%s');
            $wpdb->insert($table, $data, $format);
            //$my_id = $wpdb->insert_id;
        }

        // Create a curl handle to a non-existing location
        $ch = curl_init($point_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //$file = '';
        if (($file = curl_exec($ch)) === false) {
            //echo 'Curl error: ' . curl_error($ch);
            $file = file_get_contents($point_url_file, true);
        } else {
            //echo ' Operation completed without any errors';
            $file = file_get_contents($point_url_file, true);
            //echo ' || But  error Found : ' . curl_error($ch);
        }
        curl_close($ch);
    }
    if ($file) {
        $json = json_decode($file);
        $scores = $json->scores;
    } else {
        echo 'Alert: No File Found';
    }

    $teams = array(
        1 => 'AFC East Team',
        5 => 'AFC North Team',
        9 => 'AFC South Team',
        13 => 'AFC West Team',
        17 => 'NFC East Team',
        21 => 'NFC North Team',
        25 => 'NFC South Team',
        29 => 'NFC West Team',
        33 => 'NFLPRO'
    );
    //var_dump($json->schedule);
    //var_dump($json->scores[1][4]);
    ob_start();
    if ($scores) {
        ?>
        <!--    Shortcode start-->
        <div class="nflpro-standing">
            <div class="afc_team"><h2><?php echo $title!=''?$title:''; ?></h2></div>
            <table id="tbl_nflpro_standing" class="container2">

                <thead>
                <tr data-radium="true">
                    <th>
                        <?php if (!empty($teams[$group]) && $teams[$group] != '') {
                            echo $teams[$group];
                        } ?>
                    </th>
                    <th><u>W</u></th>
                    <th><u>L</u></th>
                    <th><u>T</u></th>
                    <th><u>PCT</u></th>
                    <th><u>HOME</u></th>
                    <th><u>AWAY</u></th>
                    <th><u>DIV</u></th>
                    <th><u>CONF</u></th>
                    <th><u>PF</u></th>
                    <th><u>PA</u></th>
                    <th><u>DIFF</u></th>
                    <th><u>STRK</u></th>
                </tr>
                </thead>
                <tbody>
                <?php $i = $group-1;

                for ($i; $i < $group+3; $i++ ) {
                    $score = $scores[$i];
                    // Table
                    ?>
                    <tr>
                        <td>
                            <a href="<?php echo home_url('/teams?team=') . $score[13]; ?>" target="__blank">
                                <img src="<?php
                                $img = explode(' ', $score[0]);
                                echo plugins_url('images/teams/' . $score[13] . '.svg', __FILE__); ?>" width="24">
                                <?php echo $score[12]; ?>

                            </a>
                        </td>
                        <td><?php echo $score[0]; ?></td>
                        <td><?php echo $score[1]; ?></td>
                        <td><?php echo $score[2]; ?></td>
                        <td><?php echo $score[3]; ?></td>
                        <td><?php echo $score[4]; ?></td>
                        <td><?php echo $score[5]; ?></td>
                        <td><?php echo $score[6]; ?></td>
                        <td><?php echo $score[7]; ?></td>
                        <td><?php echo $score[8]; ?></td>
                        <td><?php echo $score[9]; ?></td>
                        <td><?php echo $score[10]; ?></td>
                        <td><?php echo $score[11]; ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <!--    Shortcode end-->
        <?php
    } else {
        echo '';
    }
    return ob_get_clean();
}

add_shortcode('nflpro-group', 'nflpro_standing_group');