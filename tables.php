<div id="team-profile-col-2">

<!--    table 0-->
    <?php if (isset($table0) && $table0[0][0] != ''){?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="data-table1 container2">
        <tbody><tr class="thd1 NEcolors">
            <td><?php echo ($title != '') ? $title : $table0[0][0];?></td>
            <td></td>
        </tr>
        <tr class="thd2">
            <td class="first"><?php echo $table0[1][0];?></td>
            <td class="last"><?php echo $table0[1][1];?></td>
        </tr>

        <?php for ($x = 2; $x < count($table0); $x++) {?>
        <tr class="tbdy1">
            <td><?php echo $table0[$x][0];?></td>
            <td><?php echo $table0[$x][1];?> &nbsp;</td>
        </tr>
        <?php }?>

        </tbody></table>
    <!--    table 0-->

    <div class="hSpacer10px"></div>
    <?php }
    if (isset($table1) && $table1[0][0] != ''){?>

    <!--    table 1-->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="data-table1 container2">
        <tbody>
        <tr class="thd1 NEcolors">
            <td colspan="6"><?php echo ($title != '') ? $title : $table1[0][0];?></td>
        </tr>
        <tr class="tbdy1">
            <td class="first"><?php echo $table1[1][0];?></td>
            <td><?php echo $table1[1][1];?></td>
            <td><?php echo $table1[1][2];?></td>
            <td><?php echo $table1[1][3];?></td>
            <td><?php echo $table1[1][4];?></td>

            <td class="last"><?php echo $table1[1][5];?></td>
        </tr>


        <?php for ($x = 2; $x < count($table1); $x++) {?>
            <tr class="tbdy1">
                <td><?php echo $table1[$x][0];?></td>
                <td><?php echo $table1[$x][1];?></td>
                <td><?php echo $table1[$x][2];?></td>
                <td><?php echo $table1[$x][3];?></td>
                <td><?php echo $table1[$x][4];?></td>
                <td><?php echo $table1[$x][5];?></td>
            </tr>
        <?php }?>

        </tbody></table>
    <!--    table 1-->
    <div class="hSpacer10px"></div>

    <?php }
    if (isset($table2) && $table2[0][0] != ''){?>
    <!--    table 2-->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="data-table1 container2">
        <tbody><tr class="thd1 NEcolors">
            <td colspan="4"><?php echo ($title != '') ? $title : $table2[0][0];?></td>
        </tr>
        <tr class="thd2">
            <td class="first">Wk</td>
            <td>Date</td>
            <td>Opponent</td>
            <td class="last">Time</td>
        </tr>
        <?php for ($x = 2; $x < count($table2); $x++) {?>
            <tr class="tbdy1">
                <td><?php echo $table2[$x][0];?></td>
                <td><?php echo $table2[$x][1];?></td>
                <td><?php echo $table2[$x][2];?></td>
                <td><?php echo $table2[$x][3];?></td>
            </tr>
        <?php }?>

        </tbody></table>
    <!--    table 2-->
    <?php }
    if (isset($table3) && $table3[0][0] != ''){?>
    <!--    table 3-->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="data-table1 container2">
        <tbody><tr class="thd1 NEcolors">
            <td colspan="2"><?php echo ($title != '') ? $title : $table3[0][0];?></td>
        </tr>
        <tr class="thd2">
            <td class="first">Player (Pos)</td>
            <td class="last">Injury</td>
        </tr>

        <?php for ($x = 2; $x < count($table3); $x++) {?>
            <tr class="tbdy1">
                <td><?php echo $table3[$x][0];?></td>
                <td><?php echo $table3[$x][1];?></td>
            </tr>
        <?php }?>

        </tbody></table>
    <!--    table 3-->
    <div class="hSpacer10px"></div>

    <?php }
    if (isset($table4) && $table4[0][0] != ''){?>
    <!--    table 4-->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="data-table1 container2">
        <tbody><tr class="thd1 NEcolors">
            <td colspan="5"><?php echo ($title != '') ? $title : $table4[0][0];?></td>
        </tr>
        <tr class="thd2">
            <td class="first">Passing</td>
            <td>Att</td>
            <td>Cmp</td>
            <td>Yds</td>
            <td class="last">TDs</td>
        </tr>

        <?php for ($x = 2; $x < count($table4); $x++) {?>
            <tr class="tbdy1">
                <td><?php echo $table4[$x][0];?></td>
                <td><?php echo $table4[$x][1];?></td>
                <td><?php echo $table4[$x][2];?></td>
                <td><?php echo $table4[$x][3];?></td>
                <td><?php echo $table4[$x][4];?></td>
            </tr>
        <?php }?>
        </tbody></table>
    <div class="hSpacer10px"></div>

    <?php }
    if (isset($table5) && $table5[0][0] != ''){?>
    <!--    table 5-->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="data-table1 container2">
        <tbody><tr class="thd1 NEcolors">
            <td colspan="2"><?php echo ($title != '') ? $title : $table5[0][0];?></td>
        </tr>
        <tr class="thd2">
            <td class="first">Date</td>
            <td class="last">Transaction</td>
        </tr>

        <?php for ($x = 2; $x < count($table5); $x++) {?>
            <tr class="tbdy1">
                <td><?php echo $table5[$x][0];?></td>
                <td><?php echo $table5[$x][1];?></td>
            </tr>
        <?php }?>

        </tbody></table>
    <div class="hSpacer10px"></div>

    <?php }
    if (isset($table6) && $table6[0][0] != ''){?>
    <!--    table 6-->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="data-table1 container2">
        <tbody><tr class="thd1 NEcolors">
            <td colspan="5"><?php echo ($title != '') ? $title : $table6[0][0];?></td>
        </tr>
        <tr class="thd2">
            <td class="first_header first">Team</td>
            <td width="40">W</td>
            <td width="40">L</td>
            <td width="40">T</td>
            <td width="40" class="last">Win %</td>
        </tr>

        <?php for ($x = 2; $x < count($table6); $x++) {?>
            <tr class="tbdy1">
                <td><?php echo $table6[$x][0];?></td>
                <td><?php echo $table6[$x][1];?></td>
                <td><?php echo $table6[$x][2];?></td>
                <td><?php echo $table6[$x][3];?></td>
                <td><?php echo $table6[$x][4];?></td>
            </tr>
        <?php }?>

        </tbody></table>
    <div class="hSpacer10px"></div>
    <?php }?>


</div>