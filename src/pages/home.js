// $( "#myInput" ).keyup(function() {
//     while (document.getElementById("myDropdown").childNodes.length != num) {
//         document.getElementById("myDropdown").childNodes.item(num).remove();
//     }
//     var input_text = document.getElementById("myInput").value;
//     if (input_text != "") {
//         var mysql = require('mysql');
//
//         var con = mysql.createConnection({
//             host: "localhost",
//             user: "root",
//             password: "mysql",
//         });
//
//         con.connect(function(err) {
//             if (err) throw err;
//             console.log("Connected!");
//         });
//         document.getElementById("myDropdown").insertAdjacentHTML("beforeend", "<a>No Events Find</a>");
//     }
// });

function showResult(keyword) {

    if (keyword.toString() == "") {
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
            }
        }
        xmlhttp.open("GET", "home.php?keywords=" + keyword, true);
        xmlhttp.send();
    }
}


document.getElementById("myDropdown").classList.toggle("show");

console.log("Ready");