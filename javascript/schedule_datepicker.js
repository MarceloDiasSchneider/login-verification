/* Verifying dates to disable if does not have hour disponible  */
function loadDesabledDate(){

    let id_user = document.querySelector("#id").value

    let initial = new Date();
    let initialMileseconds = initial.getTime();
    let ninetyDays = (1000*60*60*24*90)
    let finalMileseconds = initialMileseconds+ninetyDays;
    let final = new Date(finalMileseconds)

    initial = `${initial.getFullYear()}-${initial.getMonth()+1}-${initial.getDate()}`    
    final = `${final.getFullYear()}-${final.getMonth()+1}-${final.getDate()}`    
    // console.log(initial)
    // console.log(final)
    // console.log(id_user)
    
    let datesToVerify = {
        id : id_user,
        i : initial,
        f : final
    }
    
    $.post('schedule_disable_dates.php', datesToVerify, function(phpReturns, state){
        if(state == 'success'){
            let object = JSON.parse(phpReturns)
            // console.log(phpReturns)
            
            /* Disable date that php returned */
            object.forEach(disablingDates);
            function disablingDates(item, index) {
                dates.push(item['date'])
            }
        } else{
            console.log('We had a problem to connect with PHP')
            alert('We had a problem to connect with PHP')            
        }
    })
    
}
let dates = []
loadDesabledDate()




function DisableDates(date) {
    var string = jQuery.datepicker.formatDate('dd/mm/yy', date);
    return [dates.indexOf(string) == -1];
}

/* create a datepicker with jQuery */
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