<form method="post" action="#" class="flex flex-column">
    <label for="voornaam">Voornaam<span>*</span></label>
    <input type="text" id="voornaam" name="voornaam" value="%current_value%" required>
    <label for="familienaam">Familienaam<span>*</span></label>
    <input type="text" id="familienaam" name="familienaam" value="%current_value%" required>
    <label for="emailadres">Emailadres<span>*</span></label>
    <input type="email" id="emailadres" name="emailadres" value="%current_value%" required>
    <label for="wachtwoord">Wachtwoord<span>*</span></label>
    <input type="password" id="wachtwoord" name="wachtwoord" required>
    <label for="herhaalwachtwoord">Herhaal wachtwoord<span>*</span></label>
    <input type="password" id="herhaalwachtwoord" name="herhaalwachtwoord" required>
    <label for="company">Bedrijf<span>*</span></label>
    <input type="text" id="company" name="company" value="%current_value%" required value="%current_value%">
    <label for="btw">BTW nummer <span>*</span></label>
    <input type="text" id="btw" name="btw" required value="%current_value%">
    <label for="function">Functie</label>
    <input type="text" id="function" name="function" value="%current_value%">
    <div class="error">
        <?php echo 'Please fill out all required fields.' ?>
    </div>
    <button name="company-data-change" type="submit">Aanpassen</button>
</form>