<?php
    include APP_DIR.'views/templates/adminsidebar.php';
    ?>
    <h1>Add New Term</h1>
<form action="<?= site_url('/terms/create'); ?>" method="POST">
    <label for="TermText">Term Text:</label>
    <textarea name="TermText" required></textarea>
    <label for="status">Status:</label>
    <input type="text" name="status" required> 
    <button type="submit">Add Term</button>
</form>
