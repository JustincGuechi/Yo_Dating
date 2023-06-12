function displayPopup(aletmsg) {
// Display the pop-up (e.g., change its style or show it)
    var popupContainer = document.getElementById('alert');
    var text = document.getElementById('alert-msg');
    popupContainer.setAttribute('open', true);
    text.innerHTML = aletmsg;
    isPopupDisplayed = true; // Set the flag to indicate that the pop-up is displayed
}

function hidePopup() {
// Hide the pop-up (e.g., change its style or hide it)
    var popupContainer = document.getElementById('alert');
    popupContainer.removeAttribute('open');

    isPopupDisplayed = false; // Set the flag to indicate that the pop-up is hidden
}