<?php

require(__DIR__. "/../../partials/nav.php");
$results = [];
$db = getDB();
$categoryFilter = $_GET['category'] ?? '';
$nameFilter = $_GET['name'] ?? '';
$sort = $_GET['sort'] ?? ''; // Added sort parameter

// Updated query to include filter and sort
$stmt = $db->prepare("SELECT id, name, description, category, stock, unit_price FROM Products WHERE visibility = 'true'  AND stock > 0
                      AND (:categoryFilter = '' OR category = :categoryFilter) 
                      AND (:nameFilter = '' OR name LIKE :nameFilter) 
                      ORDER BY CASE
                        WHEN :sort = 'ASC' THEN unit_price
                        WHEN :sort = 'DESC' THEN unit_price * -1
                        ELSE modified * -1
                      END LIMIT 10"); // Added ORDER BY clause for sorting
$stmt->bindParam(':categoryFilter', $categoryFilter);
$stmt->bindParam(':nameFilter', $nameFilter);
$stmt->bindParam(':sort', $sort); // Bind sort parameter
$nameFilter = '%' . $nameFilter . '%'; // Add wildcards for partial matching
try {
    $stmt->execute();
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($r) {
        $results = $r;
    }
} catch(PDOException $e) {
    error_log(var_export($e, true));
    flash("Error fetching items", "danger");
}

?>
<script>
    //TODO ADD CART LOGIC HERE
</script>
<div class="container-fluid row justify-content-end col-md-4 ms-auto">
    <form method="GET" action="shop.php" class="row">
        <div class="col-md-4">
            <label for="category">Filter by Category:</label>
            <select id="category" name="category" onchange="this.form.submit()" class="form-control">
                <option value="">All</option>
                <!-- Fetch and display available categories dynamically -->
                <?php
                    $categories = array_unique(array_column($results, 'category'));
                    foreach ($categories as $category) {
                        $selected = ($_GET['category'] ?? '') === $category ? 'selected' : '';
                        echo "<option value='$category' $selected>$category</option>";
                    }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="name">Filter by Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $_GET['name'] ?? ''; ?>" class="form-control">
        </div>
        <div class="col-md-4">
            <label for="sort">Sort by Price:</label>
            <select id="sort" name="sort" onchange="this.form.submit()" class="form-control">
                <option value="">None</option>
                <option value="ASC" <?php echo ($_GET['sort'] ?? '') === 'ASC' ? 'selected' : ''; ?>>Low to High</option>
                <option value="DESC" <?php echo ($_GET['sort'] ?? '') === 'DESC' ? 'selected' : ''; ?>>High to Low</option>
            </select>
        </div>
        <div class="col-md-12 mt-3">
            <button type="submit" class="btn btn-primary">Apply Filters</button>
            <input type="reset" value="Clear Filter" class="btn btn-secondary" onclick="clearFilters()">
        </div>
    </form>
</div>

<script>
    function clearFilters() {
    document.getElementById('category').selectedIndex = 0; // Reset category filter
    document.getElementById('name').value = ''; // Reset name filter
    document.getElementById('sort').value = '';
    document.forms[0].submit(); // Submit the form
    }
</script>

<div class="container-fluid">
    <h1>Shop</h1>
    <div class="row row-cols-1 row-cols-md-5 g-4" >
        <?php foreach ($results as $item) : ?>
            <div class="col">
                <div class="card bg-light">
                    <div class="card-header">
                    <a href="product_details.php?id=<?php se($item, "id") ?>" class="stretched-link">Product Placeholder</a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Name: <?php se($item, "name"); ?></h5>
                        <p class="card-text">Description: <?php se($item, "description"); ?></p>
                    </div>
                    <div class="card-footer">
                    <?php 
                        $price = (int)se($item, "unit_price", 0, false);
                        $price = cost_to_float($price);
                    ?>
                        Cost: $<?php se($price, null, 0); ?>
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php se($item, "id");?>"/>
                            <input type="hidden" name="action" value="add"/>
                            <input type="number" class="quantity" name="desired_quantity" value="1" min="1" max="<?php se($item, "stock");?>"/>
                            <input type="submit" class="btn btn-primary" value="Add to Cart"/>
                            <?php if (has_role("Shop Owner") || has_role("Admin")) : ?>
                                <a class="btn btn-primary" href="admin/edit_products.php?id=<?php se($item, "id"); ?>">Edit</a>
                            <?php endif ?>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>