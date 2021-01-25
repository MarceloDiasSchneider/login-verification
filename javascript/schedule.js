/* listiner a input submit to serach hours avelible on date base */
$(document).ready(function(){
    $("#schedule").submit(function( event ){
        alert("Ciao mondo!")
        event.preventDefault();
    });
});

/* Insert into  */

function searchHoursAvalible() {
    let date = document.querySelector("#date").value
    let selectedDate = {
        d : date,
    }
    
    document.querySelector("#hours_available").style.display = "initial";

    $.post('disponibility.php', selectedDate, function(phpReturns, state){
        if(state == 'success'){
            console.log(phpReturns)
            let myObj = JSON.parse(phpReturns)
            
            myObj.forEach(myFunction);
            
            function myFunction(item, index) {
                let select = document.querySelector("#select_hours_available")
                console.log(myObj[index])
                let option = document.createElement("option");
                option.setAttribute("value", item)
                option.text = item;
                select.options.add(option);
            }
            
        } else {
            document.querySelector("#password-message").innerHTML = 'We had a problem to connect with PHP'
        }
    })
}

/* create a datepicker with jQuery */
var dates = ["26/01/2021", "21/01/2021", "22/01/2021", "23/01/2021"];

function DisableDates(date) {
    var string = jQuery.datepicker.formatDate('dd/mm/yy', date);
    return [dates.indexOf(string) == -1];
}

$(function() {
    $("#date").datepicker({
    beforeShowDay: DisableDates,
    changeYear: false,
    changeMonth:false,
    dateFormat: 'mm/dd/yy',
    minDate: new Date(),
    maxDate: '+3m'
    });
});
