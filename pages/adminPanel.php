<?php
require('../pages/header.php');
require_once('../Utils.php');
require_once('../database/AccountsDB.php');
require_once('../database/TypesDB.php');
if (!$isAdmin) {
    header('Location: ../index.php');
    exit();
}

$accountDB = new AccountsDB();
$sumbittedForm = !empty($_POST);
$errors = [];
if ($sumbittedForm) {
    $utils = new Utils();
    $accountID = htmlspecialchars(trim($_POST['accountID']));
    $errors = $utils->validateChanging();
    if (!count($errors)) {
        $accountDB -> updateAccount(
        [
            'name' => htmlspecialchars(trim($_POST['name'])),
            'balance' => htmlspecialchars(trim($_POST['amount'])),
            'owner_id' => htmlspecialchars(trim($_POST['owner'])),
            'account_type' => $_POST['type']
        ],
        $accountID);
    }
}
$value = '';
$typesDB = new TypesDB();
$types = $typesDB -> getAll();
?>

<body>
    <main class='container'>
        <form class='blue-box' method='POST' action='../pages/adminPanel.php'>
            <h2>Change account</h2>
            <div class='input-field'>
                <p>Account ID</p>
                <input 
                    type='number' 
                    class='input' 
                    name='accountID' 
                    placeholder="Input account number"
                    value=
                        <?php 
                            if (isset($_POST['accountID'])) {
                                $value = $_POST['accountID'];
                            }
                            echo $value;
                        ?>
                >
                <?php if (isset($errors['accountID'])) : ?>
                    <div class='error'>
                        <p><?php echo $errors['accountID']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class='input-field'>
                <p>Account name</p>
                <input 
                    type='text' 
                    class='input' 
                    name='name' 
                    placeholder="Input account name"
                    value="<?php 
                            if (isset($_POST['name'])) {
                                $value = $_POST['name'];
                            } else if (isset($_POST['accountID']) && !isset($errors['accountID'])) {                                
                                $value = $accountDB -> getOne('account_id', $accountID)['name'];
                            }
                            echo $value;
                        ?>"
                >
            </div>
            <div class='input-field'>
                <p>Money amount</p>
                <input 
                    type='number' 
                    class='input' 
                    name='amount'
                    value="<?php 
                            if (isset($_POST['amount'])) {
                                $value = $_POST['amount'];
                            } else if (isset($_POST['accountID']) && !isset($errors['accountID'])) {                                
                                $value = $accountDB -> getOne('account_id', $accountID)['balance'];
                            }
                            echo $value;
                        ?>"
                >
                <?php if (isset($errors['amount'])) : ?>
                    <div class='error'>
                        <p><?php echo $errors['amount']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class='input-field' name='type'>
                <p>Account type</p>
                <select class='input' style='color: white; height: 30px;' name='type'>
                <?php 
                    $type = '';
                    if (isset($_POST['accountID']) && !isset($errors['accountID'])) {
                        $type = $accountDB -> getOne('account_id', $accountID)['account_type'];
                    }
                ?>
                <?php foreach($types as $atype): ?>
                    <option value = <?php echo $atype['type_id']; ?> <?php echo $atype['name'] == $type ? 'selected' : '' ?>><?php echo $atype['name']; ?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class='input-field'>
                <p>Owner ID</p>
                <input 
                    type='text' 
                    class='input' 
                    name='owner'
                    value="<?php 
                            if (isset($_POST['owner'])) {
                                $value = $_POST['owner'];
                            } else if (isset($_POST['accountID']) && !isset($errors['accountID'])) {                                
                                $value = $accountDB -> getOne('account_id', $accountID)['owner_id'];
                            }
                            echo $value;
                        ?>"
                >
                <?php if (isset($errors['owner'])) : ?>
                    <div class='error'>
                        <p><?php echo $errors['owner']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <input type='submit' value='Change account' id='submit'>
        </form>
    </main>
</body>