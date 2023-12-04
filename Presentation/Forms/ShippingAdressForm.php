<form method="post" action="#" class="flex flex-column">
    <label for="delivery-zip">Postcode<span>*</span></label>
    <input type="text" id="delivery-zip" name="delivery-zip" value="%current_value%" onkeyup="trackChange(this.value)"
        required><label for="delivery-city">Gemente<span>*</span></label>
    <select id="arrayDropdown-delivery">
        <option value="" disabled selected class="error">Please enter postcode...</option>
    </select>
    <!-- <input type="text" id="delivery-city" name="delivery-city" value="%current_value%" required> -->

    <label for="delivery-street">Straat<span>*</span></label>
    <input type="text" id="delivery-street" name="delivery-street" value="%current_value%" required>
    <label for="delivery-bus">Bus</label>
    <input type="text" id="delivery-bus" name="delivery-bus" value="%current_value%">
    <label for="delivery-house-number">Huisnummer<span>*</span></label>
    <input type="text" id="delivery-house-number" name="delivery-house-number" value="%current_value%" required>
    <div class="error">
        <?php echo 'Please fill out all required fields.' ?>
    </div>
    <button name="shipping-adress-change" type="submit">Aanpassen</button>

</form>