function toggleMenu() {
    var menu = document.getElementById("menuPopup");
    if (menu.style.display === "block") {
        menu.style.display = "none";
    } else {
        menu.style.display = "block";
    }
}

function showReceived() {
    document.getElementById('receivedRequests').style.display = 'block';
    document.getElementById('sentRequests').style.display = 'none';
}

function showSent() {
    document.getElementById('receivedRequests').style.display = 'none';
    document.getElementById('sentRequests').style.display = 'block';
}
