<?php
include("../classes/section.php");
include("../header.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $section = (new Section())->findById($id);
    if ($section) { ?>
        <div class="container mt-4">
          <h2>Edit Section (ID: <?= $section->id ?>)</h2>
          <form action="update_section.php" method="POST">
            <input type="hidden" name="id" value="<?= $section->id ?>">
              <div class="form-group row">
              <label for="designation" class="col-sm-2 col-form-label">Designation</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="designation" name="designation" value="<?= $section->designation ?>" required>
                  </div>
                </div>
                <div class="form-group row mt-3">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="description" name="description" rows="3" required><?= $section->description ?></textarea>
                  </div>
                </div>

            <div class="form-group row mt-4">
              <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary">Update</button>
                  <a href="../sections.php" class="btn btn-secondary">Cancel</a>
                </div></div>
        </form>
        </div>
    <?php } else { ?>
        <div class="alert alert-danger text-center mt-5">Section not found.</div>
    <?php }
}
include("../footer.php");
?>
