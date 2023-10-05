<?php
 include('db_connect.php');

    //write queries--
    $sql='SELECT title, ingredients, id FROM pizzas';

    //make query and get the result--
    $result=mysqli_query($conn, $sql);    

    //fetch the resulting rows as an array--
    $pizzas=mysqli_fetch_all($result, MYSQLI_ASSOC);

    //$result variable is no longer required, so, free the result from the memory--
    mysqli_free_result($result);

    //close the connection--
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

    <?php include('header.php');   ?>
    <h4 class="center grey-text">Available Pizzas!</h4>
    <div class="container">
        <div class="row">
            <?php foreach($pizzas as $pizza): ?>
                <div class="col s6 md3">       
                    <div class="card z-depth-0">
                        <img src="pizza.webp" alt="" class="pizza">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($pizza['title']);   ?></h6>
                            <div>
                                <ul>
                                    <?php foreach(explode(',', $pizza['ingredients']) as $ing):   ?>
                                        <li><?php echo htmlspecialchars($ing);  ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="card-action right-align">
                            <a href="details.php?id=<?php echo $pizza['id']  ?>" class="brand-text">More Info...</a>    
                        </div>
                    </div>
                </div>
            <?php endforeach;  ?>
            <?php if(count($pizzas)>=2):  ?>
                <p>There are 2 or more pizzas in your cart!</p>
            <?php else: ?>
                <p>There are less than 2 pizzas in your cart!</p>
            <?php endif; ?>

        </div>
    </div>
    <?php include('footer.php');   ?>
    
</body>
</html>