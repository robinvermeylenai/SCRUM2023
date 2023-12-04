<?php

?>
<script>
    window.onload = setUserTypeListeners;
</script>

<h1>Registratieformulier</h1>
<p>Selecteer de optie "Bedrijf" als U een zakelijke klant bent.</p>
<div>
    <input type="radio" id="userType_natuurlijkepersoon" name="userType" value="natuurlijkepersoon" <?php echo $natuurlijkepersoonChecked; ?> />
    <label for="userType_natuurlijkepersoon">Natuurlijke persoon</label>
</div>
<div>
    <input type="radio" id="userType_rechtspersoon" name="userType" value="rechtspersoon" <?php echo $rechtspersoonChecked; ?> />
    <label for="userType_rechtspersoon">Bedrijf</label>
</div>

<div id="formContainer_natuurlijkepersoon">
    <?php include_once('./Presentation/test-Registration-person.php'); ?>
</div>

<div id="formContainer_rechtspersoon">
    <?php include_once('./Presentation/test-Registration-company.php'); ?>
</div>