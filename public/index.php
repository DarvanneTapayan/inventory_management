<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include_once '../templates/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Management</title>
</head>
<body>
    <main>
        <section>
            <div>
                <h1>
                    Welcome to our inventory management system
                </h1>
            </div>
        </section>
        <section>
            <div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur doloremque consequuntur eos iure architecto harum ullam eligendi nobis temporibus enim repudiandae voluptas necessitatibus repellat, consectetur impedit, inventore aperiam omnis eveniet!</p>
            </div>
        </section>
    </main>
</body>
</html>
<?php
// Include the footer from the templates folder
include_once '../templates/footer.php';
?>