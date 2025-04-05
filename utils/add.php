<?php
include("../header.php");
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
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="section" value="1" id="gl">
                <label class="form-check-label" for="gl">GL</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="section" value="2" id="rt">
                <label class="form-check-label" for="rt">RT</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="section" value="3" id="iia">
                <label class="form-check-label" for="iia">IIA</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="section" value="4" id="imi">
                <label class="form-check-label" for="imi">IMI</label>
            </div>
        </div>

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