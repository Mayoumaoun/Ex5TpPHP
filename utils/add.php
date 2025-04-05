<?php
include("../header.php");
?>
    <div>
        <form action="../handel.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="form_type" value="add">
            <label for="name">Name: </label>
            <input type="text" name="name" id="name">
            <br>
            <label for="birthday">Birthday:  </label>
            <input type="date" name="birthday" id="birthday">
            <br>
            <label for="section">Section: </label>
            <label>
            <input type="radio" name="section" value="1"> GL
            </label>
            <label>
            <input type="radio" name="section" value="2"> RT
            </label>
            <input type="radio" name="section" value="3"> IIA
            </label>
            <label>
            <input type="radio" name="section" value="4"> IMI
            </label>
            <br>
            <label for="image">Image:  </label>
            <input type="file" name="image" id="image">
            <br>
            <button type="submit" >Add</button>
        </form>
    </div>
<?php
include("../footer.php");
?>