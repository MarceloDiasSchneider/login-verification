/* create a datepicker with jQuery */

var dates = ["27/01/2021", "29/01/2021", "01/02/2021", "03/02/2021"];

function DisableDates(date) {
    var string = jQuery.datepicker.formatDate('dd/mm/yy', date);
    return [dates.indexOf(string) == -1];
}

$(function() {
    $("#date").datepicker({
        beforeShowDay: DisableDates,
        changeYear: false,
        changeMonth:false,
        dateFormat: 'dd/mm/yy',
        minDate: new Date(),
        maxDate: '+3m'
    });
});