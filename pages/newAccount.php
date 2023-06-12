<?php
require('../pages/header.php');
require_once('../Utils.php');
require_once('../database/TypesDB.php');
$utils = new Utils();
$submittedForm = !empty($_POST);
if ($submittedForm) {
    $accountDB = new AccountsDB();
    $type_id = htmlspecialchars(trim($_POST['type']));
    var_dump($type_id, $_POST['type']);
    $accountDB->create(
        substr(htmlspecialchars(trim($_POST['number'])), 0, 8),
        htmlspecialchars(trim($_POST['name'])),
        $_SESSION['user'],
        htmlspecialchars(trim($_POST['type']))
    );
    header('Location: ../pages/accounts.php');
    exit();
}
$typesDB = new TypesDB();
$options = $typesDB -> getAll();
?>

<body>
    <main class='container'>
        <a class='login-btn' id='back' href='../pages/accounts.php'>
            <p>Back</p>
        </a>
        <form class='blue-box' method='POST' action='../pages/newAccount.php'>
            <h2>New account</h2>
            <div class='input-field'>
                <p>Name</p>
                <input type='text' class='input' name='name'>
            </div>
            <div class='input-field' name='type'>
                <p>Account type</p>
                <select class='input' style='color: white; height: 30px;' name='type'>
                    <?php foreach($options as $option): ?>
                        <option value=<?php echo $option['type_id']; ?>>
                            <?php echo $option['name']; ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class='input-field'>
                <p>Account Number</p>
                <input type='text' class='input' name='number' value='<?php echo $utils->generateNumber(); ?>/1100' style='background-color: grey;' readonly>
            </div>
            <input type='submit' value='Create an account' id='submit'>
        </form>
    </main>
</body>