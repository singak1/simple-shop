<?php

require(__DIR__. "/../../../partials/nav.php");
$TABLE_NAME = "Products";
if (!has_role("Admin") && !has_role("Shop Owner")) {
    flash("You do not have permission to view this page", "warning");
    die(header("Location: $BASE_PATH/home.php"));
}

if(isset($_POST["submit"])) {
    if(update_products($TABLE_NAME, $_GET["id"], $_POST)) {
        flash("Product updated successfully", "success");
    }
}

$result = [];
$columns = get_columns($TABLE_NAME);
$ignore = ["id", "modified", "created"];
$db = getDB();
$id = se($_GET, "id", -1, false);
$stmt = $db->prepare("SELECT * FROM $TABLE_NAME WHERE id = :id");
try {
    $stmt->execute([":id" => $id]);
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    if($r) {
        $result = $r;
    }
} catch(PDOException $e) {
    error_log(var_export($e, true));
    flash("Error looking up product", "danger");
}

function map_column($col)
{
    global $columns;
    foreach($columns as $c) {
        if ($c["Field"] === $col) {
            return input_map($c["Type"]);
        }
    }
    return "text";
}
?>
<div class="container-fluid">
    <h1>Edit Product</h1>
    <form method="POST">
        <?php foreach ($result as $column => $value) : ?>
            <?php /* Lazily ignoring fields via hardcoded array*/ ?>
            <?php if (!in_array($column, $ignore)) : ?>
                <div class="mb-4">
                    <label class="form-label" for="<?php se($column); ?>"><?php se($column); ?></label>
                    <input class="form-control" id="<?php se($column); ?>" type="<?php echo map_column($column); ?>" value="<?php se($value); ?>" name="<?php se($column); ?>" />
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <input class="btn btn-primary" type="submit" value="Update" name="submit" />
    </form>
</div>