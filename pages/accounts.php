<?php
require('../pages/header.php');
require_once('../database/AccountsDB.php');
$accountDB = new AccountsDB();
if (!isset($_SESSION['user'])) {
    exit();
}
$accounts = $accountDB->getAll($_SESSION['user']);
?>

<body>
    <main class='container' id='column'>
        <?php foreach ($accounts as $account) : ?>
            <div class='blue-box' id='account'>
                <div class='blue-box-text'>
                    <p><?php echo $account['name']; ?></p>
                    <h1><?php echo $account['balance']; ?> Kč</h1>
                    <p><?php echo $account['account_id']; ?> / 1100</p>
                </div>
                <div class='blue-box-btns'>
                    <a class='login-btn' id='account-btn' href='../pages/history.php'>
                        History
                    </a>
                    <a class='login-btn' id='account-btn' href='../pages/newPayment.php?id=<?php echo $account['account_id']; ?>' style='margin-top: 45px'>
                        Pay
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
        <a class='add-account' href='../pages/newAccount.php'>+</a>
    </main>
</body>