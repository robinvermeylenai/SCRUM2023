<?php if(count($errors_natuurlijkepersoon) > 0) {

echo '<div class="error">';
    echo '<ul>';
        foreach($errors_natuurlijkepersoon AS $error) {
            echo '<li>'.$error.'</li>';
        }
    echo '</ul>';
echo '</div>';

} ?>
<form method="post" action="RegistrationController.php" class="flex flex-column">
    <h3>Persoonlijke informatie</h3>
    <div class="flex flex-row">
        <div class="flex flex-column registration-form">
            <label for="voornaam">Voornaam<span>*</span></label>
            <input type="text" id="voornaam" name="voornaam" value="<?php echo $voornaam; ?>">
            <label for="wachtwoord">Wachtwoord<span>*</span></label>
            <input type="password" id="wachtwoord" name="wachtwoord" value="<?php echo $wachtwoord; ?>">
            <label for="emailadres">Emailadres<span>*</span></label>
            <input type="email" id="emailadres" name="emailadres" value="<?php echo $emailadres; ?>">
        </div>
        <div class="flex flex-column registration-form">
            <label for="familienaam">Familienaam<span>*</span></label>
            <input type="text" id="familienaam" name="familienaam" value="<?php echo $familienaam; ?>">
            <label for="herhaalwachtwoord">Herhaal wachtwoord<span>*</span></label>
            <input type="password" id="herhaalwachtwoord" name="herhaalwachtwoord" value="<?php echo $herhaalwachtwoord; ?>">

        </div>
    </div>
    <h3>Leveradres</h3>
    <div class="flex flex-row">
        <div class="flex flex-column registration-form">
            <label for="delivery-city">Gemeente<span>*</span></label>
            <input type="text" id="delivery-city" name="delivery-city" value="<?php echo $plaatsLevering; ?>" required>

            <label for="delivery-street">Straat<span>*</span></label>
            <input type="text" id="delivery-street" name="delivery-street" value="<?php echo $straatLevering; ?>" required>


            <label for="delivery-bus">Bus</label>
            <input type="text" id="delivery-bus" name="delivery-bus" value="<?php echo $busLevering; ?>">
        </div>
        <div class="flex flex-column registration-form">
            <label for="delivery-zip">Postcode<span>*</span></label>
            <input type="text" id="delivery-zip" name="delivery-zip" value="<?php echo $postcodeLevering; ?>" required>

            <label for="delivery-house-number">Huisnummer<span>*</span></label>
            <input type="text" id="delivery-house-number" name="delivery-house-number" value="<?php echo $huisNummerLevering; ?>" required>
        </div>
    </div>
    <h3>Facturatieadres</h3>
    <div class="flex flex-row">
        <div class="flex flex-column registration-form">
            <label for="billing-city">Gemeente <span>*</span></label>
            <input type="text" id="billing-city" name="billing-city" value="<?php echo $plaatsFacturatie; ?>" required>

            <label for="billing-street">Straat<span>*</span></label>
            <input type="text" id="billing-street" name="billing-street" value="<?php echo $straatFacturatie; ?>" required>

            <label for="billing-bus">Bus</label>
            <input type="text" id="billing-bus" name="billing-bus" value="<?php echo $busFacturatie; ?>">
        </div>
        <div class="flex flex-column registration-form">

            <label for="billing-zip">Postcode<span>*</span></label>
            <input type="text" id="billing-zip" name="billing-zip" value="<?php echo $postcodeFacturatie; ?>" required>
            <label for="billing-house-number">Huisnummer<span>*</span></label>
            <input type="text" id="billing-house-number" name="billing-house-number" value="<?php echo $huisNummerFacturatie; ?>" required>
        </div>
    </div>

    <input name="person-registration" type="submit" value="Registreer" />

</form>