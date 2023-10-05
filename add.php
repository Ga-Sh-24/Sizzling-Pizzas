<?php
    include('db_connect.php');
    //isset() function checks whether the specified value is set or not
    //$_ is the way to declare a global array
    //since here, we are using the GET method, so, the global array will be $_GET and the email, title and the ingredients that the user passes go into this GET array
    //we will access these values using the name attribute that we provided in the form as the key

    //with GET request--
    // if(isset($_GET['submit'])){
    //     echo $_GET['email'].'<br>';
    //     echo $_GET['title'].'<br>';
    //     echo $_GET['ingredients'].'<br>';
    // }

    //with POST request--
    // if(isset($_POST['submit'])){
    //         echo $_POST['email'].'<br>';
    //         echo $_POST['title'].'<br>';
    //         echo $_POST['ingredients'].'<br>';
    // }

    //sometimes, some malicious users can inject some harmful and corrupted code into our website that can be prone to viruses
    //for example, in the email field above, they can inject some js code which can contain viruses
    //this is called XSS attacks(Cross Site Scripting)
    //to prevent this, we will use the function htmlspecialchars() before rendering any user data into the server--
    //this function when encounters some code elements like </>/;, etc, will convert it into the html entities rather than taking them as the actual code

    //instead of showing the errors at the top of the page, we need to show the errors beneath the relevant field only--   
    $email=$title=$ingredients='';
    $errors = array('email'=>'', 'title'=>'', 'ingredients'=>'');
    if(isset($_POST['submit'])){
        //form validation and filters--
        //check email--
        if(empty($_POST['email'])){
            $errors['email']='Email is required<br>';
        }else{
            $email=$_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){      //first argument is the value to be applied the filter to and second argument is the type of filter to apply and here, we have used the inbuilt filter
                $errors['email'] = 'Enter a valid Email address<br>';
            }
        }
        //check title--
        //since we don't have any inbuilt filter to apply to the title and ingredients, so, here we have to use the regex
        if(empty($_POST['title'])){
            $errors['title']='Title is required<br>';
        }else{
            $title=$_POST['title'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)){        //^ means starting and $ means ending and + is the closure that the regex has to come atleast (it cannot be empty string) and \s means space
                $errors['title']='Not a valid title<br>';
            }
        }

        if(empty($_POST['ingredients'])){
            $errors['ingredients'] = 'Atleast one ingredient is required<br>';
        }else{
            $ingredients=$_POST['ingredients'];
           if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
            $errors['ingredients']='Ingredients must be comma-separated list.<br>';
           }
        }

        //if there are no errors, then, redirect the user to the home page--
        //array_filter() function cycles through the elements of the array and executes some callback function which we define on each of them but if we don't define any callback function then, by default, it checks the elements to be empty, if all of them evaluate to false(empty string), then, this function returns false otherwise true
        if(array_filter($errors)){
            // echo 'There are errors in the form.<br>';
        }else{
            // echo 'The form is valid.<br>';
            //here, we first have to save the user data into the database and then, redirect it to the index.php page
            $email=mysqli_real_escape_string($conn, $_POST['email']);    //this function is similar to htmlspecialchars() but that is for displaying the real values onto the browser and this is for saving the real values(not malicious ones) into the database
            $title=mysqli_real_escape_string($conn, $_POST['title']);
            $ingredients=mysqli_real_escape_string($conn, $_POST['ingredients']);

            //creating sql query--
            $sql="INSERT INTO pizzas(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";   //since the id field is auto-incrementing, so, we don't have to write that

            //save to db and check--
            if(mysqli_query($conn, $sql)){
                //success-->redirect to index.php page
                header('Location: index.php');
            }else{
                //error
                echo 'Query Error: '. mysqli_error($conn);
            }
        }

        
}
?>

<!DOCTYPE html>
<html lang="en">

    <?php include('header.php');   ?>
    <section class="container grey-text">
        <h4 class="center">Add your Pizza</h4>
        <form action="add.php" class="white" method="POST">      <!--GET request sends the user data into the URl server of the page/file that we specify in the action attribute and then, it looks for the php defined at the top of this page whether we have to do something with this data or not-->
        <!-- POST request does not send the user data into the URL. That's why it is more useful than the GET request -->
            <label for="email">Your Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <div class="red-text"><?php echo $errors['email']; ?></div>
            <label for="title">Pizza Title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
            <div class="red-text"><?php echo $errors['title']; ?></div>
            <label for="ingredients">Ingredients (comma separated):</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients); ?>">
            <div class="red-text"><?php echo $errors['ingredients']; ?></div>
            <div class="center">
                <input type="submit" name="submit" value="Submit Now" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
    <?php include('footer.php');   ?>
    
</body>
</html>