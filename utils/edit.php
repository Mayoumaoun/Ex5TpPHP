<?php
include("../classes/student.php");
include("../classes/section.php");
include("../header.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $student = (new Student())->findById($id);
    $sections = (new Section())->findAll();
    if ($student){ ?>
        <div class="container mt-4">
            <h2>Edit Student (ID: <?= $student->id ?>)</h2>
            <form action="update.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= $student->id ?>">

  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="name" name="name" value="<?= $student->name ?>" required>
    </div>
  </div>

  <div class="form-group row">
    <label for="birthday" class="col-sm-2 col-form-label">Birthday</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $student->birthday ?>" required>
    </div>
  </div>

  <div class="form-group row">
    <label for="section" class="col-sm-2 col-form-label">Section</label>
    <div class="col-sm-10">
      <select class="form-control" id="section" name="section" required>
        <?php foreach ($sections as $s) { ?>
          <option value="<?= $s->id ?>" <?= $student->section == $s->designation ? "selected" : "" ?>>
            <?= strtoupper($s->designation) ?>
          </option>
        <?php } ?>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Current Image</label>
    <div class="col-sm-10">
      <img src="../uploads/<?= $student->image ?>" height="100" class="img-thumbnail mb-2">
    </div>
  </div>

  <div class="form-group row">
    <label for="image" class="col-sm-2 col-form-label">Change Image</label>
    <div class="col-sm-10">
      <input type="file" class="form-control-file" id="image" name="image">
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10 offset-sm-2">
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="../students.php" class="btn btn-secondary">Cancel</a>
    </div>
  </div>
</form>

            </div>
    <?php } else{ ?>
        <p>Student not found</p>
    <?php }
}

include("../footer.php");
