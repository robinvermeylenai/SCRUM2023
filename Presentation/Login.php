<?php
if(!isset($activePage)) {
    $activePage = '';
}
/*
if an error occured during login, the get variable ShowLogin is present in URL
in that case we dont want to stop the default behavior of the link
so that after a close of this login section
the error message is no longer present
otherwise you see an error message when you open the login section again
this is not an issue but seems cleaner not to have that errormessage after reopening 
and will prevent a redirect in case no errors occured yet
*/
$returnString = 'return false;';
if(isset($_GET['showLogin']))
    $returnString = '';
?>

<a href="<?php echo strtok($_SERVER["REQUEST_URI"], '?'); ?>" class="closeLink closeLinkLogin" onClick="closeLoginPopupContainer();<?php echo $returnString; ?>"></a>

<h3>Aanmelden</h3>

<form method="post" action="loginController.php?action=login" class="flex flex-column">
    <input type="hidden" name="activePage" value="<?php echo $activePage; ?>" />
    <label for="emailadres">Emailadres<span>*</span></label>
    <input type="email" id="emailadres" name="email" required>

    <label for="wachtwoord">Wachtwoord<span>*</span></label>
    <input type="password" id="wachtwoord" name="password" required>
    <?php if(isset($_SESSION['error']) AND $_SESSION['error'] !== '') { ?>
        <div class="error">
            <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            ?>
        </div>
    <?php } ?>
    <button name="login" type="submit">Aanmelden</button>
</form>

<p>Nog niet geregistreerd? Klik dan <a href="RegistrationController.php">hier</a></p>