<?php
include("../header.php");
include("../classes/section.php");
$sect = new Section();
$sections = $sect->findAll();
?>
    <div class="container mt-4">
    <form action="../handel.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="form_type" value="add">

        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>

        <div class="mb-3">
            <label for="birthday" class="form-label">Birthday:</label>
            <input type="date" class="form-control" name="birthday" id="birthday">
        </div>

        <div class="mb-3">
        <label class="form-label">Section:</label><br>
            <?php foreach ($sections as $s){?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="section" value="<?= $s->id ?>" id="<?= $s->designation ?>">
                    <label class="form-check-label" for="<?= $s->designation ?>"><?= strtoupper($s->designation) ?></label>
                </div>
            <?php }?>

        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>

<?php
include("../footer.php");
?>