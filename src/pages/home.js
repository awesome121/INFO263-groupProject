


/**
 * A function to search suggestion using Ajax approach
 * The function will be called once the user's key is up, but it has to be at least 3 characters
 * @param string keyword
 *
 */
function showSearchResult(keyword) {
    if (keyword.toString().length < 3) {
        document.getElementById("hint").hidden = true;
        while (document.getElementById("hint").children.length != 0)
            document.getElementById("hint").children.item(0).remove();
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var parser = new DOMParser();
                var responseDoc = parser.parseFromString(this.responseText, "text/html")
                document.getElementById("hint").innerHTML = responseDoc.getElementById("hint").innerHTML;
                document.getElementById("hint").hidden = false;
            }
        }
        xmlhttp.open("GET", "home.php?keywords=" + keyword, true);
        xmlhttp.send();
    }
}



/**
 * A function to adjust calendar, left is true if the calendar is switching to the left, false otherwise
 * @param bool left
 *
 */
function calendarSwitch(left){
    var date = document.getElementById("currentDate").innerText.split(" - ");
    var startDate = new Date(date[0]);
    var endDate =  new Date(date[1]);
    if (left) { //minus a week
        startDate.setDate(startDate.getDate()-7);
        endDate.setDate(endDate.getDate()-7);

    } else { // plus a week
        startDate.setDate(startDate.getDate()+7);
        endDate.setDate(endDate.getDate()+7);
    }
    const dateTimeFormat = new Intl.DateTimeFormat();
    startDate = dateTimeFormat.format(startDate).split('/').reverse();
    endDate = dateTimeFormat.format(endDate).split('/').reverse();
    if (startDate[2].length == 1){
        startDate[2] = '0' + startDate[2];
    }
    if (endDate[2].length == 1){
        endDate[2] = '0' + endDate[2];
    }
    startDate = startDate.join('-');
    endDate = endDate.join('-');
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var parser = new DOMParser();
            var responseDoc = parser.parseFromString(this.responseText, "text/html")
            document.getElementById("mainFrame").innerHTML = responseDoc.getElementById("mainFrame").innerHTML;
            document.getElementById("currentDate").innerHTML = responseDoc.getElementById("currentDate").innerHTML;
        }
    }
    xmlhttp.open("GET", "home.php?startDate=" + startDate + "&endDate=" + endDate, true);
    xmlhttp.send();
}


/**
 * A function to initialise the toggling buttons' property
 *
 */
function init_button() {
    var showButtons = document.getElementsByClassName("btn-primary");
    for (var i = 0; i < showButtons.length; i++) {
        var button = showButtons.item(i);
        button.addEventListener("click", function () {
            if (this.innerHTML == "Show less") {
                this.innerHTML = "Show more";
            } else {
                this.innerHTML = "Show less";
            }

        });
    }
}


init_button();
document.getElementById("hint").hidden = true;







