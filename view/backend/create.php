<? $title = "Nouvel article";
ob_start();
?>

<h2>Écrire un nouvel article</h2>

<div class="d-flex justify-content-center mt-4">
<textarea>Welcome to TinyMCE!</textarea>
</div>

<? $content =ob_get_clean();
include 'template.php';