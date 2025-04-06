<?php
include("../header.php");
?>

<div class="container mt-4">
    <h2 class="mb-4">Add Section</h2>
    <form action="../handel.php" method="post">
        <input type="hidden" name="form_type" value="add_section">

        <div class="mb-3">
            <label for="designation" class="form-label">Designation:</label>
            <input type="text" class="form-control" name="designation" id="designation" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Add Section</button>
    </form>
</div>

<?php
include("../footer.php");
?>
