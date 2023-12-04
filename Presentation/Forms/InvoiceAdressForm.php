<form method="post" action="#" class="flex flex-column">
    <label for="invoice-zip">Postcode<span>*</span></label>
    <input type="text" id="invoice-zip" name="invoice-zip" value="%current_value%"
        onkeyup="trackChangeInvoice(this.value)" required>

    <label for="invoice-city">Gemente<span>*</span></label>
    <!-- <input type="text" id="invoice-city" name="invoice-city" value="%current_value%" required> -->
    <select id="arrayDropdown-invoice"></select>
    <label for="invoice-street">Straat<span>*</span></label>
    <input type="text" id="invoice-street" name="invoice-street" value="%current_value%" required>
    <label for="invoice-bus">Bus</label>
    <input type="text" id="invoice-bus" name="invoice-bus" value="%current_value%">
    <label for="invoice-house-number">Huisnummer<span>*</span></label>
    <input type="text" id="invoice-house-number" name="invoice-house-number" value="%current_value%" required>
    <div class="error">
        <?php echo 'Please fill out all required fields.' ?>
    </div>
    <button name="invoice-adress-change" type="submit">Aanpassen</button>

</form>