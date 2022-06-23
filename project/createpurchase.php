<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
################################################################################################################
// select roles . . . 
$sql1 = "select * from user_details";
$usersObj  = DoQuery($sql1);

$sql2 = "select * from products";
$producObj  = DoQuery($sql2);

$sql3 = "select * from vendors";
$vendorObj  = DoQuery($sql3);
$mytotal=0;
#################################################################

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['getprice'])) {

  $created_at = time();
  $user_id = (int)$_SESSION['user']['id'];

// SET SESSIONS
  $_SESSION['vendor_id']=(int)Clean($_POST['vendor_id']);
  $_SESSION['payment']=Clean($_POST['payment']);
  $_SESSION['product_id']=(int)Clean($_POST['product_id']);
  $_SESSION['qunty']=(int)Clean($_POST['qunty']);


// GET SESSIONS
  $vendor_id       = $_SESSION['vendor_id'];
  $payment         = $_SESSION['payment'];
  $product_id        =$_SESSION['product_id'];
  $qunty         = $_SESSION['qunty'];

  // get the price of chosen product
  $sql4 = "select price from products where id=$product_id";
  $productprice = DoQuery($sql4);
  $pr_price = mysqli_fetch_assoc($productprice);

  $lastprice =$pr_price['price'];

  function getTotal()
  {
    $mytotal=(int)$GLOBALS['lastprice'] * (int)$GLOBALS['qunty'];
    $_SESSION['mytotal']=$mytotal;
    return $mytotal;

  }
  $mytotals=$_SESSION['mytotal'];

  
  # Validate Input . . . 
  $errors = [];


  # Check if there are any errors . . .
  if (count($errors) > 0) {
    $_SESSION['Message'] = $errors;
  } elseif ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['insert'])) { 
    // code . . . 


    $sql5 = "INSERT INTO purchases_invoices (vendor_id,product_id,qunty,payment_status,total_price,created_at,user_id)VALUES ($vendor_id,$product_id,$qunty,'$payment',$mytotals,$created_at,$user_id)";
    $op5  = DoQuery($sql5);

    if ($op5) {
      $message = ['success' => 'Purchase invoice Added Successfully'];
    } else {
      $message = ['error' => '  Purchase invoice has not been added yet'];
    }
    //}
    

    $_SESSION['Message'] = $message;
  }
}


require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';
?>

<main>
  <div class="container-fluid">
    <h1 class="mt-4">Dashboard / Purchases</h1>
    <ol class="breadcrumb mb-4">
      <?php
      Message('Purchase/Create');
      ?>
    </ol>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id='product_form'>

      <div class="form-group">
        <label for="exampleInputPassword">Choose the Vendor</label>
        <select class="form-control" required name="vendor_id">

          <?php
          while ($data4 = mysqli_fetch_assoc($vendorObj)) {
          ?>

            <option value="<?php echo $data4['id']; ?>"><?php echo $data4['v_name'];   ?></option>

          <?php }  ?>

        </select>
      </div>

      <div class="form-group">
        <label for="exampleInputPassword">Payment Status:</label>
        <select class="form-control" required name="payment">

          <option value="Cash">Cash</option>
          <option value="Visa">Visa</option>

        </select>
      </div>


      <div class="form-group">
        <label for="exampleInputPassword">Choose Product</label>
        <select class="form-control" required name="product_id">

          <?php
          while ($data = mysqli_fetch_assoc($producObj)) {
          ?>

            <option value="<?php echo $data['id']; ?>"><?php echo $data['p_name'];   ?></option>

          <?php }  ?>

        </select>
      </div>

      <div class="form-group">
        <label for="exampleInputName">Quantity</label>
        <input type="number" class="form-control" required id="exampleInputName" name="qunty" placeholder="Enter the Quantity">
      </div>

      <button type="submit" name='getprice' class="btn btn-primary">Get Price and Total</button>
    </form>



<!------------------------- SECOND FORM INPUTS------------------------------------------>



    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

      <div class="form-group">

        <label for="exampleInputName">Product Price is :</label>
        <input type="text" class="form-control" required id="exampleInputName" name="product_price" disabled value="<?php if (isset($pr_price)) {
                                                                                                                      echo $pr_price['price'] . '$';
                                                                                                                    }  ?>">
      </div>

      <div class="form-group">

        <label for="exampleInputName">Total Price is :</label>
        <input type="text" class="form-control" required id="exampleInputName" name="total_price" disabled value="<?php if (isset($pr_price)) { echo getTotal(). '$';
               } ?>">
      </div>

      <button type="submit" name="insert" class="btn btn-primary">Submit</button>
    </form>



</main>



<?php
require '../layouts/footer.php';

?>
