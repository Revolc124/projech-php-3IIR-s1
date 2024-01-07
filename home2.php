
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <style>
        .gallery{
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        margin: 0px 5rem;
    }

    .gallery .image{
        display: block;
        height: 20rem;
        width: auto;
        max-width: 100%;
        border-radius: 15px;
        transition: .3s ease-in-out;
    }

    .cont{
        position: relative;
        height: 20rem;
        width: auto;
        max-width: 100%;
        margin: 1rem;
        padding: 0;
    }

    .cont .delete{
        position: absolute;
        top: 0;
        right: 0;
        background-color: red;
        color: white;
        cursor: pointer;
        opacity: 0.7;
        border: none;
        border-radius: 5px;
        font-size: 20px;
        margin: 10px;
    }

    .cont .update{
        position: absolute;
        top: 0;
        left: 0;
        background-color: green;
        color: white;
        cursor: pointer;
        opacity: 0.7;
        border: none;
        border-radius: 5px;
        font-size: 20px;
        margin: 10px;
    }


    .cont:hover img {
    filter: blur(8px);
}

.cont .overlay {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.5);
    transition: .3s ease;
    opacity: 0;
    border-radius: 15px;
}

.cont:hover .overlay {
    opacity: 1;
}
    
.overlay .desc {
    color: white;
    font-size: 20px;
    position: absolute;
    bottom: 10px;
    left: 10px;
    cursor: default;
}


.update-form {
  position: absolute;
  margin: 4rem 1rem;
  width: auto;
}

.update-form button{
    background-color: cyan;
    border-radius: 5px;
    border: none;
    margin-left: 5px;
}

.update-form input{
    border-radius: 5px;
    border: none;
    padding: 2px;
}


</style>
</head>
<body>
    <?php include("navbar.php"); ?>
    <?php include_once("db-images.php"); ?>
    <div class="gallery">
            

                <?php
                    if (isset($_POST['submit_update'])) {
                        // Get the new description and the id of the image
                        $new_description = $_POST['new_description'];
                        $id = $_POST['id'];
                    
                        // Create an instance of the Connection class
                        $connection = new Connection();
                    
                        // Select the database
                        $connection->selectDatabase('abdo2');
                    
                        // Update the description in the database
                        $sql = "UPDATE images SET description = '$new_description' WHERE id = $id";
                        if (mysqli_query($connection->conn, $sql)) {
                            echo '<script>document.getElementById("update").innerHTML = "Description updated successfully.";</script>';
                        } else {
                            echo "Error updating description: " . mysqli_error($connection->conn);
                        }
                    }
                    
                    
                ?>

                <?php
                    // Include the database connection file
                    include_once 'db-images.php';

                    if(isset($_POST['delete'])){
                        // Delete image from database
                        $id = $_POST['id'];
                        $delete = $connection->conn->query("DELETE FROM images WHERE id='$id'");
                        if($delete){
                            echo '<script>document.getElementById("del").innerHTML = "Image deleted successfully.";</script>';
                        }else{
                            echo "Image deletion failed, please try again.";
                        } 
                    }

                    // Get the images from the database
                    $result = $connection->conn->query("SELECT * FROM images ORDER BY id DESC");

                    if($result->num_rows > 0){
                        while($imgData = $result->fetch_assoc()){
                            // Render image
                            echo '<div class="cont">';
                                echo '<img class="image" src="data:image/jpeg;base64,'.$imgData['image_url'].'"/>';
                                echo'<div class="overlay">';
                                    echo '<p class="desc">'.$imgData['description'].'</p>';

                                    echo '<form method="POST">';
                                        echo '<input type="hidden" name="id" value="'.$imgData['id'].'"/>'; 
                                        echo '<button type="submit" class="delete" name="delete">Delete</button>';
                                        echo '<button type="submit" class="update" name="update">Update</button>';

                                        echo '<div class="update-form" style="display: none;">';
                                            echo '<input type="text" name="new_description" value="'.$imgData['description'].'"/>';
                                            echo '<button type="submit" name="submit_update">Valider</button>';
                                        echo '</div>';

                                    echo '</form>';
                                echo'</div>';
                            echo '</div>';
                        }
                    }else{
                        echo 'No image found...';
                    }
                ?>
            
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('.update').forEach((button) => {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                let form = event.target.parentNode.querySelector('.update-form');
                form.style.display = 'block';
            });
        });
    });
</script>




</html>
