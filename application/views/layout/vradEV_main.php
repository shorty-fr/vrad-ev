<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <?php
    echo css_url('bootstrap.min');
    echo css_url('bootstrap-theme.min');
    echo css_url('design');
    echo css_url('slick');
    echo css_url('slick-theme');
    echo css_url('toastr.min');
    echo css_url('datetimepicker');
    ?>


    <title>VRAD-EV</title>

</head>
<body>
<?php echo $menu; ?>
<?php echo show_notification() ?>
<div class="maincontent">
    <?php echo $contents; ?>
</div>

<?php // Logo NDI #3 ?>
<div class="ndifooter">
    <?php echo img_url("logorond.png", "Logo de la NDI", "chouetteLogo"); ?>
    <p>D&eacute;velopp&eacute; par Devloop & MBW</p>
</div>
</body>

<!-- INSERT JS HERE -->
<?php
echo js_url('jquery');
echo js_url('moment');
echo js_url('moment-locale-fr');
echo js_url('bootstrap.min');
echo js_url('validator');
echo js_url('slick');
echo js_url('toastr.min');
echo js_url('datetimepicker');
echo js_url('script');
?>
</html>
