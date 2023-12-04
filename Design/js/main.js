function showLoginPopup() {
    document.getElementById('darkOverlay').style.display = 'block';
    document.getElementById('loginPopupContainer').style.display = 'block';
}
function closeLoginPopupContainer() {
    document.getElementById('darkOverlay').style.display = 'none';
    document.getElementById('loginPopupContainer').style.display = 'none';
}
function setUserTypeListeners() {

    document.getElementById('formContainer_natuurlijkepersoon').style.display = 'none';
    document.getElementById('formContainer_rechtspersoon').style.display = 'none';

    if(document.getElementById('userType_natuurlijkepersoon').checked == true) {
        document.getElementById('formContainer_natuurlijkepersoon').style.display = 'block';
    }
    if(document.getElementById('userType_rechtspersoon').checked == true) {
        document.getElementById('formContainer_rechtspersoon').style.display = 'block';
    }
    
    document.getElementById('userType_natuurlijkepersoon').addEventListener('click', function (event) {
        document.getElementById('formContainer_natuurlijkepersoon').style.display = 'block';
        document.getElementById('formContainer_rechtspersoon').style.display = 'none';
    });
    document.getElementById('userType_rechtspersoon').addEventListener('click', function (event) {
        document.getElementById('formContainer_rechtspersoon').style.display = 'block';
        document.getElementById('formContainer_natuurlijkepersoon').style.display = 'none';
    });
}