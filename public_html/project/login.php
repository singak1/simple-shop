<?php
require(__DIR__ . "/../../partials/nav.php");
?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <form onsubmit="return validate(this)" method="POST">
                <div class="mb-3">
                    <label class="form-label" for="email">Email/Username</label>
                    <input class="form-control" type="text" id="email" name="email" placeholder="name@example.com/username" required />
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="pw">Password</label>
                    <input class="form-control" type="password" id="pw" name="password" required minlength="8" />
                </div>
                <input type="submit" class="mt-3 btn btn-primary" value="Login" id=login />
            </form>
        </div>
    </div>
</div>
<script>
    function validate(form) {
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success
        let pw = form.password.value;
        let em_un = form.email.value;

        if(em_un.length === 0 ) {
            flash("Please provide email/username", "info");
            return false;
        }

        if(em_un.includes("@")){
            const pattern = /^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})*$/;
            if(!pattern.test(em_un)) {
                flash("Email is invalid", "info");
                return false;
            }
        }
        else {
            const pattern = /^[a-z0-9_-]{3,16}$/;
            if (!pattern.test(em_un)) {
                flash("Username is invalid", "info");
                return false;
            }
        }

        if(pw.length === 0) {
            flash("Please provide a password", "info");
            return false;
        }
        else {
            const pattern = /.{8,}/;
            if(!pattern.test(pw)) {
                flash("Password is too short", "info");
                return false;
            }
        }
        //TODO update clientside validation to check if it should
        //valid email or username
        return true;
    }
</script>
<?php
//TODO 2: add PHP Code
if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = se($_POST, "email", "", false);
    $password = se($_POST, "password", "", false);

    //TODO 3
    $hasError = false;
    if (empty($email)) {
        flash("Email must not be empty");
        $hasError = true;
    }
    if (str_contains($email, "@")) {
        //sanitize
        //$email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = sanitize_email($email);
        //validate
        /*if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            flash("Invalid email address");
            $hasError = true;
        }*/
        if (!is_valid_email($email)) {
            flash("Invalid email address");
            $hasError = true;
        }
    } else {
        if (!is_valid_username($email)) {
            flash("Invalid username");
            $hasError = true;
        }
    }
    if (empty($password)) {
        flash("password must not be empty");
        $hasError = true;
    }
    if (!is_valid_password($password)) {
        flash("Password too short");
        $hasError = true;
    }
    if (!$hasError) {
        //flash("Welcome, $email");
        //TODO 4
        $db = getDB();
        $stmt = $db->prepare("SELECT id, email, username, password from Users 
        where email = :email or username = :email");
        try {
            $r = $stmt->execute([":email" => $email]);
            if ($r) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user) {
                    $hash = $user["password"];
                    unset($user["password"]);
                    if (password_verify($password, $hash)) {
                        //flash("Weclome $email");
                        $_SESSION["user"] = $user; //sets our session data from db
                        //lookup potential roles
                        $stmt = $db->prepare("SELECT Roles.name FROM Roles 
                        JOIN UserRoles on Roles.id = UserRoles.role_id 
                        where UserRoles.user_id = :user_id and Roles.is_active = 1 and UserRoles.is_active = 1");
                        $stmt->execute([":user_id" => $user["id"]]);
                        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetch all since we'll want multiple
                        //save roles or empty array
                        if ($roles) {
                            $_SESSION["user"]["roles"] = $roles; //at least 1 role
                        } else {
                            $_SESSION["user"]["roles"] = []; //no roles
                        }
                        flash("Welcome, " . get_username());
                        die(header("Location: home.php"));
                    } else {
                        flash("Invalid password");
                    }
                } else {
                    flash("Email not found");
                }
            }
        } catch (Exception $e) {
            flash("<pre>" . var_export($e, true) . "</pre>");
        }
    }
}
?>
<?php
require(__DIR__ . "/../../partials/flash.php");