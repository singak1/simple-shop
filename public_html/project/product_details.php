<?php

require(__DIR__. "/../../partials/nav.php");
$TABLE_NAME = "Products";

// Fetch the product details from the database based on the product ID
$product=[];
if(isset($_GET["id"])) {
    $id = $_GET['id'];
    $db = getDB();
    $stmt = $db->prepare("SELECT id, name, description, category, stock, created, modified, unit_price, visibility from $TABLE_NAME WHERE id = :id AND visibility = 'true' ");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    try {
        $stmt->execute();
        $r = $stmt->fetch(PDO::FETCH_ASSOC);
        if($r) {
            $product = $r;
        }
        else{
            die(header("Location: $BASE_PATH/shop.php"));
        }
    } catch (PDOException $e) {
        error_log(var_export($e, true));
        flash("Error fetching records", "danger");
    }
}

?>

<div class="container-fluid bg-primary-subtle rounded col-md-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h1>Product Details</h1>
            <?php if (count($product) == 0) : ?>
                <p>No results to show</p>
            <?php else : ?>
            <div class="row">
                <div class="col row justify-content-center">
                    <h4 class="mt-2 mb-2"><?php echo $product['name']; ?></h4>
                    <p><strong>Description:</strong> <?php echo $product['description']; ?></p>
                    <p><strong>Category:</strong> <?php echo $product['category']; ?></p>
                    <p><strong>Stock:</strong> <?php echo $product['stock']; ?></p>
                    <p><strong>Unit Price:</strong> <?php echo $product['unit_price']; ?></p>
                    <p><a href="shop.php" class="btn btn-primary">Back to Shop</a></p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../partials/footer.php");
