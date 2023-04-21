<?php 

require(__DIR__. "/../../../partials/nav.php");
$TABLE_NAME = "Products";
if(!has_role("Admin") && !has_role("Shop Owner")) {
    //Redirect non admin or shop owner
    flash("You don't have permission to view this page", "warning");
    die(header("Location: $BASE_PATH/home.php"));
}

$results = [];
if(isset($_POST["name"])) {
    $db = getDB();
    $stmt = $db->prepare("SELECT id, name, description, category, stock, created, modified, unit_price, visibility from $TABLE_NAME WHERE name like :name LIMIT 10");
    try {
        $stmt->execute([":name" => "%" . $_POST["name"] . "%"]);
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($r) {
            $results = $r;
        }
    } catch (PDOException $e) {
        error_log(var_export($e, true));
        flash("Error fetching records", "danger");
    }
}
?>
<div class="container-fluid">
    <h1>List Products</h1>
    <form method="POST" class="row row-cols-lg-auto g-3 align-items-center">
        <div class="input-group mb-3">
            <input class="form-control" type="search" name="name" placeholder="Product Filter" value="<?php se($_POST, 'name');?>" />
            <input class="btn btn-primary" type="submit" value="Search" />
        </div>
    </form>
    <?php if (count($results) == 0) : ?>
        <p>No results to show</p>
    <?php else : ?>
        <table class="table">
            <?php foreach ($results as $index => $record) : ?>
                <?php if ($index == 0) : ?>
                    <thead>
                        <?php foreach ($record as $column => $value) : ?>
                            <th><?php se($column); ?></th>
                        <?php endforeach; ?>
                        <th>Actions</th>
                    </thead>
                <?php endif; ?>
                <tr>
                    <?php foreach ($record as $column => $value) : ?>
                        <td><?php se($value, null, "N/A"); ?></td>
                    <?php endforeach; ?>


                    <td>
                        <a href="edit_products.php?id=<?php se($record, "id"); ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
<?php
//note we need to go up 1 more directory
//require_once(__DIR__ . "/../../../partials/footer.php");