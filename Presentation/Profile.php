<?php

// Presentation/profile.php
// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';
echo '<pre>';
var_dump($_POST);
var_dump($_SESSION);
echo '</pre>'
    ?>

<div class="flex flex-column">
    <div class="flex flex-row wrap-mobile">
        <div class="account-item"><span>Gegevens</span>

            <span id="edit-button-account" style="display:block; ">
                <a href="#" onclick="showUserChangeForm()">(Edit) </a>
            </span>
            <span id="close-button-account" style="display:none;">
                <a href="#" onclick="hideUserChangeForm()">(Close) </a></span>


            <div id="User">
                <?php echo ('<p class="error">' . $errorBtw . '</p>') ?>
                <p>
                    <span>Naam:</span><strong>
                        <?php print($person->getFirstName()); ?>
                        <?php print($person->getLastName()); ?>

                    </strong>
                </p>
                <p>
                    <span>Email:</span>
                    <?php print($person->getUserAccount()->getEmail()); ?>
                </p>

                <?php if (isset($_SESSION['company'])) { ?>

                    <p><span>Bedrijf:</span>
                        <?php print($company->getCompanyName()); ?>
                    </p>
                    <p> <span>BTW nummer:</span>
                        <?php print($company->getBtwNumber()); ?>
                    </p>
                <?php } ?>
            </div>
            <div id="UserChangeForm" style="display:none;">
                <?php if (isset($_SESSION['company'])) {
                    include_once("./Presentation/Forms/DataPersonChangeForm.php");
                    ?><br><br>
                    <?php
                    include_once("./Presentation/Forms/DataCompanyChangeForm.php");
                } else {
                    include_once("./Presentation/Forms/DataPersonChangeForm.php");
                } ?>
            </div>
        </div>



        <div class="account-item"><span>Bestellingen</span>

            <p><strong> <a href="">Kijk bestelingen</a></strong> </p>

        </div>
    </div>
    <div class="flex flex-row">
        <div class="account-item"><span>Leveringadres</span><br>
            <?php print $placeError ?>
            <span id="edit-button-delivery" style="display:block;"><a href="#" onclick="showDeliveryChangeForm()">(Edit)
                </a></span>
            <span id="close-button-delivery" style="display:none;"><a href="#"
                    onclick="hideDeliveryChangeForm()">(Close)
                </a></span>
            <div id="Delivery">
                <p><strong>
                        <?php print($person->getFirstName()); ?>
                        <?php print($person->getLastName()); ?>
                    </strong>
                <p>
                    <?php print($person->getClient()->getShippingAddress()->getStreet()); ?>,&nbsp
                    <?php print($person->getClient()->getShippingAddress()->getNumber()); ?>&nbsp
                    <?php print($person->getClient()->getShippingAddress()->getBox()); ?>
                </p>
                <p>
                    <?php print($person->getClient()->getShippingAddress()->getPlace()->getZip()); ?>,&nbsp
                    <?php print($person->getClient()->getShippingAddress()->getPlace()->getName()); ?>
                </p>
            </div>
            <div id="DeliveryChangeForm" style="display:none;">
                <?php include_once("./Presentation/Forms/ShippingAdressChangeForm.php"); ?>
            </div>
        </div>

        <div class="account-item">
            <span>Facturatieadres</span>
            <span id="edit-button-invoice" style="display:block;">
                <a href="#" onclick="showInvoiceChangeForm()">(Edit)</a>
            </span>
            <span id="close-button-invoice" style="display:none;">
                <a href="#" onclick="hideInvoiceChangeForm()">(Close)</a>
            </span>

            <div id="Invoice">
                <p><strong>
                        <?php print($person->getFirstName()); ?>
                        <?php print($person->getLastName()); ?>
                    </strong>
                <p>
                    <?php print($person->getClient()->getBillingAddress()->getStreet()); ?>,&nbsp
                    <?php print($person->getClient()->getBillingAddress()->getNumber()); ?>&nbsp
                    <?php print($person->getClient()->getBillingAddress()->getBox()); ?>
                </p>
                <p>
                    <?php print($person->getClient()->getBillingAddress()->getPlace()->getZip()); ?>,&nbsp
                    <?php print($person->getClient()->getBillingAddress()->getPlace()->getName()); ?>
                </p>
            </div>
            <div id="InvoiceChangeForm" style="display:none;">
                <?php include_once("./Presentation/Forms/InvoiceAdressChangeForm.php"); ?>
            </div>
        </div>
    </div>
</div>
<script>
    /* Show and hide account form*/
    function showUserChangeForm() {
        document.getElementById("UserChangeForm").style.display = "block";
        document.getElementById("User").style.display = "none";
        document.getElementById("edit-button-account").style.display = "none";
        document.getElementById("close-button-account").style.display = "block";
    }

    function hideUserChangeForm() {
        document.getElementById("UserChangeForm").style.display = "none";
        document.getElementById("User").style.display = "block";
        document.getElementById("edit-button-account").style.display = "block";
        document.getElementById("close-button-account").style.display = "none";
    }

    /* Show delivery form*/
    function showDeliveryChangeForm() {
        document.getElementById("DeliveryChangeForm").style.display = "block";
        document.getElementById("Delivery").style.display = "none";
        document.getElementById("edit-button-delivery").style.display = "none";
        document.getElementById("close-button-delivery").style.display = "block";
    }

    /* Hide delivery form*/
    function hideDeliveryChangeForm() {
        document.getElementById("DeliveryChangeForm").style.display = "none";
        document.getElementById("Delivery").style.display = "block";
        document.getElementById("edit-button-delivery").style.display = "block";
        document.getElementById("close-button-delivery").style.display = "none";
    }

    /* Show invoice form*/
    function showInvoiceChangeForm() {
        document.getElementById("InvoiceChangeForm").style.display = "block";
        document.getElementById("Invoice").style.display = "none";
        document.getElementById("edit-button-invoice").style.display = "none";
        document.getElementById("close-button-invoice").style.display = "block";
    }

    /* Hide invoice form*/
    function hideInvoiceChangeForm() {
        document.getElementById("InvoiceChangeForm").style.display = "none";
        document.getElementById("Invoice").style.display = "block";
        document.getElementById("edit-button-invoice").style.display = "block";
        document.getElementById("close-button-invoice").style.display = "none";
    }

    /* PHP POSTCODES ARRAY TO JS */
    <?php
    $js_places = json_encode($allPlaces);
    echo "var places_js_array = " . $js_places . ";\n";

    // Getting Place name from php $_Session
    $js_existingPlace = json_encode($existingPlace);
    echo "var existingPlace = " . $js_existingPlace . ";\n";
    ?>

    // Inserting existing Place Name in form field  

    var onlyOneOption = '';
    onlyOneOption += `<option value="${existingPlace}" id="${existingPlace}" ">${existingPlace}</option>`
    document.getElementById("arrayDropdown-delivery").innerHTML = onlyOneOption;
    document.getElementById("arrayDropdown-invoice").innerHTML = onlyOneOption;


    // Delivery
    //  postcodes give list of Place Names START
    let selectedPlacesArray = [] // this is final array with Names of all Places with that postcode

    function trackChange(value) {
        let code = parseInt(value); // our postcode

        if (value.toString().length == 4) { // if postcode is 4 numbers
            selectedPlacesArray = [];
            selectedPlacesArrayWithIds = [];

            for (let i = 0; i < places_js_array.length; i++) {
                if (places_js_array[i][0] == code) {
                    selectedPlacesArray.push(places_js_array[i][1]);
                    selectedPlacesArrayWithIds.push(places_js_array[i][1], (places_js_array[i][2]))
                };

            }


            for (const element of places_js_array) {
                if (element[0] === code) {
                    console.log(element[0]);
                }
            }



            if (selectedPlacesArray.length < 1) { // if code is 4 symbols but there no such postcode -> error
                selectedPlacesArray.push('Gelieve het formaat van uw postcode te respecteren.')
            }

            var options = ""; // adding names from final array to select options
            selectedPlacesArray.map((op, i) => {
                options += `<option value="${op}" id="${i}" ">${op}</option>`
            })
            document.getElementById("arrayDropdown-delivery").innerHTML = options;
        } else {
            var select = document.getElementById("arrayDropdown-delivery");
            selectedPlacesArray = [];
            selectedPlacesArray.push('Gelieve het formaat van uw postcode te respecteren.');
            for (var i = 0; i < 10; i++) {
                select.remove(i);
            }
        }
    }

    // If i choose Place name in select Dropdown - wright Place ID is filed in hidden input PlaceID;

    function trackListChange(value) {
        places_js_array.forEach(element => {
            if (element[1] === value) {
                document.getElementById("delivery-placeID").value = element[2];
            }
        });
    }



    // Delivery postcodes END


    //     // Invoice postcodes START

    // Delivery
    //  postcodes give list of Place Names START

    function trackChangeInvoice(value) {
        let code = parseInt(value); // our postcode

        if (value.toString().length == 4) { // if postcode is 4 numbers
            selectedPlacesArray = [];
            selectedPlacesArrayWithIds = [];

            for (let i = 0; i < places_js_array.length; i++) {
                if (places_js_array[i][0] == code) {
                    selectedPlacesArray.push(places_js_array[i][1]);
                    selectedPlacesArrayWithIds.push(places_js_array[i][1], (places_js_array[i][2]))
                };

            }


            for (const element of places_js_array) {
                if (element[0] === code) {
                    console.log(element[0]);
                }
            }



            if (selectedPlacesArray.length < 1) { // if code is 4 symbols but there no such postcode -> error
                selectedPlacesArray.push('Gelieve het formaat van uw postcode te respecteren.')
            }

            var options = ""; // adding names from final array to select options
            selectedPlacesArray.map((op, i) => {
                options += `<option value="${op}" id="${i}" ">${op}</option>`
            })
            document.getElementById("arrayDropdown-invoice").innerHTML = options;
        } else {
            var select = document.getElementById("arrayDropdown-invoice");
            selectedPlacesArray = [];
            selectedPlacesArray.push('Gelieve het formaat van uw postcode te respecteren.');
            for (var i = 0; i < 10; i++) {
                select.remove(i);
            }
        }
    }


//     let invoiceZipIsFilled = document.getElementById("invoice-zip");
//     if (invoiceZipIsFilled.value.length == 4) {


//         for (var index in places_js_array) {
//             if (places_js_array[index] == invoiceZipIsFilled.value) {
//                 selectedPlacesArray.push(index);
//             };
//         }
//         var options = ""; // adding names from final array to select options
//         selectedPlacesArray.map((op, i) => {
//             options += `<option value="${op}" id="${i}" style="border-radius: 5px;"">${op}</option>`
//         })
//         document.getElementById("arrayDropdown-invoice").innerHTML = options;
//     }

//     function trackChangeInvoice(value) {
//         let code = parseInt(value); // our postcode

//         if (value.toString().length == 4) { // if postcode is 4 numbers
//             let selectedPlacesArray = [] // this is final array with Names of all Places with that postcode
//             for (var index in places_js_array) {
//                 if (places_js_array[index] == code) {
//                     selectedPlacesArray.push(index);
//                 };
//             }

//             if (selectedPlacesArray.length < 1) { // if code is 4 symbols but there no such postcode -> error
//                 selectedPlacesArray.push('Gelieve het formaat van uw postcode te respecteren.')
//             }

//             var options = ""; // adding names from final array to select options
//             selectedPlacesArray.map((op, i) => {
//                 options += `<option value="${op}" id="${i}" style="border-radius: 5px;"">${op}</option>`
//             })
//             document.getElementById("arrayDropdown-invoice").innerHTML = options;

//         } else {
//             var select = document.getElementById("arrayDropdown-invoice");
//             selectedPlacesArray = [];
//             selectedPlacesArray.push('Gelieve het formaat van uw postcode te respecteren.');
//             for (var i = 0; i < 10; i++) {
//                 select.remove(i);
//             }
//         }
//     }
// // Invoice postcodes END


</script>