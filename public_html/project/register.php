<?php
    require_once(__DIR__."/../../lib/functions.php");
?>
<form onsubmit="return validate(this)" method="POST">
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" required />
    </div>
    <div>
        <label for="pw">Password</label>
        <input type="password" id="pw" name="password" required minlength="8" />
    </div>
    <div>
        <label for="confirm">Confirm</label>
        <input type="password" name="confirm" required minlength="8" />
    </div>
    <input type="submit" value="Register" />
</form>
<script>
    function validate(form) {
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success

        return true;
    }
</script>
<?php
 //TODO 2: add PHP Code
 if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm"])) {
    $email = se($_POST, "email", "", false); //$_POST["email"];
    $password = se($_POST, "password", "", false); // $_POST["password"];
    $confirm = se($_POST, "confirm", "", false); //$_POST["confirm"];
    //TODO 3
    $hasError = false;
    if(empty($email)) {
        $hasError = true;
        echo "Email must be provided <br>";
    }
    //sanitize email input
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    //validate the sanitized email input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please enter a valid email address <br>";
        $hasError = true;
    }
    if(empty($password)) {
        $hasError = true;
        echo "Password must be provided <br>";
    }
    if(empty($confirm)) {
        $hasError = true;
        echo "Confirm password must be provided <br>";
    }
    if(strlen($password) < 8){
        $hasError = true;
        echo "Password must be atleast 8 characters long <br>";
    }
    if(strlen($password) > 0 && $password !== $confirm) {
        $hasError = true;
        echo "Passwords must match <br>";
    }
    if(!$hasError) {
        //echo "Welcome, $email";
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Users(email, password) VALUES (:email, :password)");
        try{
            $r = $stmt->execute([":email"=>$email, ":password"=>$hash]);
            echo "Successfully registered";
        }
        catch(Exception $e) {
            echo "There was an error registering<br>";
            echo "<pre>" . var_export($e, true) . "</pre>";
        }
    }
 }
?>