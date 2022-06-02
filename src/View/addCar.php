
<div class="add-car-wrapper">
    <div id="alert-wrapper">
        <?php if (isset($success) && $success == true) {
            echo '<div class="alert alert-success" role="alert" id="addcar-successful">';
            echo "Car added successfully!";
            echo '</div>';
        } ?>
    </div>
    <main role="main" class="add-car-container">
        <div class="add-car">

            <h4 class="mt-5 mb-5">Create your new car</h4>
            <form action="" method="post" enctype="multipart/form-data">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="form6Example1">Name</label>
                            <input type="text" name="name" id="form6Example1" class="form-control"/>
                            <p style="color:red; height: 15px;"><?=$error['name'] ?? ' '?></p>
                        </div>
                    </div>
                </div>

                <!-- Text input -->
                <div class="form-outline ">
                    <label class="form-label" for="form6Example3">Color</label>
                    <input type="text" name="color" id="form6Example3" class="form-control"/>
                    <p style="color:red; height: 15px;"><?=$error['color'] ?? ' '?></p>
                </div>

                <!-- Text input -->
                <div class="form-outline ">
                    <label class="form-label" for="form6Example4">Brand</label>
                    <input type="text" name="brand" id="form6Example4" class="form-control"/>
                    <p style="color:red; height: 15px;"><?=$error['brand'] ?? ' '?></p>
                </div>


                <!-- Number input -->
                <div class="form-outline ">
                    <label class="form-label" for="form6Example6">Price ($)</label>
                    <input type="number" name="price" id="form6Example6" class="form-control"/>
                    <p style="color:red; height: 15px;"><?=$error['price'] ?? ' '?></p>
                </div>

                <!-- Message input -->
                <div class="form-outline ">
                    <label class="form-label" for="form6Example7">Description</label>
                    <textarea class="form-control" name="description" id="form6Example7" rows="4"></textarea>
                    <p style="color:red; height: 15px;"><?=$error['description'] ?? ' '?></p>
                </div>


                <div class="form-group">
                    <label for="exampleFormControlFile1">Image:  </label>
                    <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                    <p style="color:red; height: 15px;"><?=$error['image'] ?? ' '?></p>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block  mt-2">Create</button>
            </form>
        </div>
    </main>
</div>