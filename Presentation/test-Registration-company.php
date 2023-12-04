<?php if(count($errors_rechtspersoon) > 0) {

echo '<div class="error">';
    echo '<ul>';
        foreach($errors_rechtspersoon AS $error) {
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
            <input type="text" id="voornaam" name="voornaam" required>
            <label for="wachtwoord">Wachtwoord<span>*</span></label>
            <input type="password" id="wachtwoord" name="wachtwoord" required>
            <label for="emailadres">Emailadres<span>*</span></label>
            <input type="email" id="emailadres" name="emailadres" required>
            <label for="company">Bedrijf<span>*</span></label>
            <input type="text" id="company" name="company" required>
        </div>
        <div class="flex flex-column registration-form">
            <label for="familienaam">Familienaam<span>*</span></label>
            <input type="text" id="familienaam" name="familienaam" required>
            <label for="herhaalwachtwoord">Herhaal wachtwoord<span>*</span></label>
            <input type="password" id="herhaalwachtwoord" name="herhaalwachtwoord" required>
            <label for="btw">BTW nummer <span>*</span></label>
            <input type="text" id="btw" name="btwNummer" required>
            <label for="function">Functie</label>
            <input type="text" id="function" name="function">

        </div>
    </div>
    <h3>Leveradres</h3>
    <div class="flex flex-row">
        <div class="flex flex-column registration-form">
            <label for="delivery-city">Gemeente<span>*</span></label>
            <input type="text" id="delivery-city" name="delivery-city" required>

            <label for="delivery-street">Straat<span>*</span></label>
            <input type="text" id="delivery-street" name="delivery-street" required>



            <label for="delivery-bus">Bus</label>
            <input type="text" id="delivery-bus" name="delivery-bus">
        </div>
        <div class="flex flex-column registration-form">


            <label for="delivery-zip">Postcode<span>*</span> <span id="need4-1" style="display: none;">Postcode must be
                    from 1000 to 9992</span></label>
            <input type="number" min="1000" max="9999" id="delivery-zip" name="delivery-zip"
                onkeyup="trackChange(this.value)" required>

            <label for="delivery-house-number">Huisnummer<span>*</span></label>
            <input type="text" id="delivery-house-number" name="delivery-house-number" required>
        </div>
    </div>
    <h3>Facturatieadres</h3>
    <div class="flex flex-row">
        <div class="flex flex-column registration-form">
            <label for="billing-city">Gemeente <span>*</span></label>
            <input type="text" id="billing-city" name="billing-city" required>

            <label for="billing-street">Straat<span>*</span></label>
            <input type="text" id="billing-street" name="billing-street" required>

            <label for="billing-bus">Bus</label>
            <input type="text" id="billing-bus" name="billing-bus">
        </div>
        <div class="flex flex-column registration-form">

            <label for="billing-zip">Postcode<span>*</span></label>
            <input type="number" id="billing-zip" name="billing-zip" required>
            <label for="billing-house-number">Huisnummer<span>*</span></label>
            <input type="text" id="billing-house-number" name="billing-house-number" required>
        </div>
    </div>
    <input name="company-registration" type="submit" value="Registreer" />

</form>
<script>
    function trackChange(value) {
        if (value.toString().length == 4) {
            document.getElementById("need4-1").style.display = "none";
        }
        else {
            document.getElementById("need4-1").style.display = "block";
            console.log(value);
        }
    }

</script>