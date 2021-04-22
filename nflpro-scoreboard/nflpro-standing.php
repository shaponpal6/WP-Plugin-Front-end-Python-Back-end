<?php

// Add Shortcode
function nflpro_standing_shortcode()
{
    $file = file_get_contents(plugins_url('data/nfl_scraping.json', __FILE__));
    $json = json_decode($file);
    $scores = $json->scores;
    $step = array(1);
    $teams = array(
        1 => 'AFC East Team',
        5 => 'AFC North Team',
        9 => 'AFC South Team',
        13 => 'AFC West Team',
        17 => 'NFC East Team',
        21 => 'NFC North Team',
        25 => 'NFC South Team',
        29 => 'NFC West Team'
    );
    //var_dump($json->schedule);
    //var_dump($json->scores[1][4]);
    ob_start(); ?>
    <!--    Shortcode start-->
    <div class="nflpro-standing">
        <?php $i = 1;
        foreach ($scores as $score) {
            if ($i == 1) {
                echo '<div class="afc_team"><h2>American Football Conference</h2></div>';
            } elseif ($i == 17) {
                echo '<div class="afc_team"><h2>National Football Conference</h2></div>';
            }
            // Table
            if (!empty($teams[$i]) && $teams[$i] != '') {
                ?>
                <table id="tbl_nflpro_standing">
                <thead>
                <tr data-radium="true">
                    <th>
                        <?php if (!empty($teams[$i]) && $teams[$i] != ''){ echo $teams[$i];}?>
                    </th>
                    <th>W</th>
                    <th>L</th>
                    <th>T</th>
                    <th>PCT</th>
                    <th>PF</th>
                    <th>PA</th>
                    <th>Net Pts</th>
                    <th>Home</th>
                    <th>Road</th>
                    <th>Div</th>
                    <th>Pct</th>
                    <th>Conf</th>
                    <th>Pct</th>
                    <th>Non-Conf</th>
                    <th>Streak</th>
                    <th>Last 5</th>
                </tr>
                </thead>
                <tbody>
            <?php } ?>
            <tr>
                <td>
                    <img src="<?php
                    $img = explode(' ', $score[0]);
                    echo plugins_url('images/teams/'.$img[0][0].$img[1][0].'.svg', __FILE__);?>" width="24">
                    <?php echo $score[0];?>
                </td>
                <td><?php echo $score[1];?></td>
                <td><?php echo $score[2];?></td>
                <td><?php echo $score[3];?></td>
                <td><?php echo $score[4];?></td>
                <td><?php echo $score[5];?></td>
                <td><?php echo $score[6];?></td>
                <td><?php echo $score[7];?></td>
                <td><?php echo $score[8];?></td>
                <td><?php echo $score[9];?></td>
                <td><?php echo $score[10];?></td>
                <td><?php echo $score[11];?></td>
                <td><?php echo $score[12];?></td>
                <td><?php echo $score[13];?></td>
                <td><?php echo $score[14];?></td>
                <td><?php echo $score[15];?></td>
                <td><?php echo $score[16];?></td>
            </tr>
            <?php if ( $teams[$i+1] != '') { ?>
                </tbody>
                </table>
                <?php
            }
            $i++;
        } ?>
    </div>
    <!--    Shortcode end-->
    <?php return ob_get_clean();
}

add_shortcode('nflpro-standing', 'nflpro_standing_shortcode');