<?php
require(__DIR__ . "/../../partials/nav.php");
reset_session();
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3>Register</h3>
            <form onsubmit="return validate(this)" method="POST">
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" type="email" name="email" placeholder="name@example.com" required />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="username">Username</label>
                    <input class="form-control" type="text" name="username" required maxlength="30" />
                    <div id="emailHelp" class="form-text">Username cannot be larger than 30 characters.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="pw">Password</label>
                    <input class="form-control" type="password" id="pw" name="password" required minlength="8" />
                    <div id="passwordlHelp" class="form-text">Password must be atleast 8 characters.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="confirm">Confirm</label>
                    <input class="form-control" type="password" name="confirm" required minlength="8" />
                </div>
                <input type="submit" class="mt-3 btn btn-primary" value="Register" />
            </form>
        </div>
    </div>
</div>
<script>
    function validate(form) {
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success
        let email = form.email.value;
        let pw = form.password.value;
        let user = form.username.value;
        let con = form.confirm.value;
        let isValid = true;
        if(email.length === 0 ) {
            flash("Please provide email", "danger");
            isValid = false;
        }
        else{
            const pattern = /^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})*$/;
            if(!pattern.test(email)) {
                flash("Email is invalid", "danger");
                isValid = false;
            }
        }

        if(user.length === 0) {
            flash("Please provide username", "danger");
            isValid = false;
        }
        else {
            const pattern = /^[a-z0-9_-]{3,16}$/;
            if (!pattern.test(user)) {
                flash("Username is invalid", "danger");
                isValid = false;
            }
        }

        if(pw.length === 0) {
            flash("Please provide a password", "danger");
            isValid = false;
        }
        else {
            const pattern = /.{8,}/;
            if(!pattern.test(pw)) {
                flash("Password is too short", "danger");
                isValid = false;
            }
            if (pw !== con) {
                flash("Password and Confrim password must match", "danger");
                isValid = false;
            }
        }
        return isValid;
    }
</script>
<?php
//TODO 2: add PHP Code
if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm"]) && isset($_POST["username"])) {
    $email = se($_POST, "email", "", false);
    $password = se($_POST, "password", "", false);
    $confirm = se($_POST, "confirm", "", false);
    $username = se($_POST, "username", "", false);
    //TODO 3
    $hasError = false;
    if (empty($email)) {
        flash("Email must not be empty", "danger");
        $hasError = true;
    }
    //sanitize
    $email = sanitize_email($email);
    //validate
    if (!is_valid_email($email)) {
        flash("Invalid email address", "danger");
        $hasError = true;
    }
    if (!is_valid_username($username)) {
        flash("Username must only contain 3-16 characters a-z, 0-9, _, or -", "danger");
        $hasError = true;
    }
    if (empty($password)) {
        flash("password must not be empty", "danger");
        $hasError = true;
    }
    if (empty($confirm)) {
        flash("Confirm password must not be empty", "danger");
        $hasError = true;
    }
    if (!is_valid_password($password)) {
        flash("Password too short", "danger");
        $hasError = true;
    }
    if (
        strlen($password) > 0 && $password !== $confirm
    ) {
        flash("Passwords must match", "danger");
        $hasError = true;
    }
    if (!$hasError) {
        //TODO 4
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Users (email, password, username) VALUES(:email, :password, :username)");
        try {
            $stmt->execute([":email" => $email, ":password" => $hash, ":username" => $username]);
            flash("Successfully registered!", "success");
        } catch (PDOException $e) {
            users_check_duplicate($e->errorInfo);
        }
    }
}
?>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>