<?php
    require_once("const.inc.php");
    require_once(SCRIPTS_DIR . "set_data.inc.php");
?>

<?php include(TOP_PATH); ?>

<div class="text_input_box select_year_box">
  <select name="year" id="year">
    <?php echo(genYears()); ?>
    <option value="Not Selected" selected="selected" hidden>Year:</option>
  </select>
</div>
<div class="text_input_box select_day_box">
  <select name="day" id="day">
    <?php echo(genDays()); ?>
    <option value="Not Selected" selected="selected" hidden>Day:</option>
  </select>
</div>

<?php include(BOT_PATH); ?>