
function showSearchResult(keyword) {

    if (keyword.toString().length < 3) {
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
                // document.getElementById("myDropdown").classList.toggle("show");
            }
        }
        xmlhttp.open("GET", "home.php?keywords=" + keyword, true);
        xmlhttp.send();
    }
}

function openWin() {
    //opens in new tab cannot figure out how to open it in the same one. Everything I tried did not work.
    document.getElementById("input").textContent;
    window.open( "search_results.php?searched=");
    return false;
}

/*function printSearchResults(){
    window.location.href(search_results.php)
    var x = document.getElementById("myInput");
    document.getElementById("demo").innerHTML = "You are searching for: " + x.value;
}*/


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

var showButtons = document.getElementsByClassName("btn-primary");
for (var i=0; i < showButtons.length; i++){
    var button = showButtons.item(i);
    button.addEventListener("click", function(){
        if (this.innerHTML == "Show less"){
            this.innerHTML = "Show more";
        } else {
            this.innerHTML = "Show less";
        }

    });
}


document.getElementById("myDropdown").classList.toggle("show");





