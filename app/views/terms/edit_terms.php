<?php
    include APP_DIR.'views/templates/adminsidebar.php';
    ?>
    <h1>Edit Term</h1>
<form action="<?=site_url('auth/terms/update/' . $term['id']);?>" method="POST">
    <label for="text">Term Text:</label>
    <textarea name="text" required><?= $term['text']; ?></textarea>
    <label for="status">Status:</label>
    <input type="text" name="status" value="<?= $term['status']; ?>" required>
    <button type="submit">Update Term</button>
</form>
