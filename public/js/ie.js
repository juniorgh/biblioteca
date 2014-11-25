function hoverTextIE(elementId) {
    var input = document.getElementById(elementId);
    if(input.value == '') {
        alert('oi');
    } else {
        alert('tchau');
    }
}

hoverTextIE('query');