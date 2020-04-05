<?php $title = 'Admin Panel';
ob_start();?>

<h1>Bienvenue sur le panneau d'administration</h1>

<div id="circle">
        <div id="top" class="chart"></div>
        <div id="right" class="chart"></div>
        <div id="bottom" class="chart"></div>
        <div id="left" class="chart"></div>
        <div id="innercircle"></div>
</div>

<?php $content = ob_get_clean();
include 'template.php';