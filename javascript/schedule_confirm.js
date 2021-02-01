/* prevent send date to insert if html5 is not valid */ 
$(document).ready(function(){
    $("#schedule").submit(function( event ){
        confirmScheduels()
        event.preventDefault();
    });
});


function confirmScheduels(){
    /* get date from form to insert and create a new schedules */
    let id = document.querySelector("#id").value
    let dateStart = document.querySelector("#dateStart").value
    let hourStart = document.querySelector("#hourStart").value
    let dateEnd = document.querySelector("#dateEnd").value
    let hourEnd = document.querySelector("#hourEnd").value
    let title = document.querySelector("#title").value
    let description = document.querySelector("#description").value

    let dateToInsert = {
        id : id,
        ds : dateStart,
        hs : hourStart,
        de : dateEnd,
        he : hourEnd,
        t : title,
        d : description
    }
    
    $.post('schedule_calendar_confirm.php', dateToInsert, function(phpReturns, state){
        if(state == 'success'){
            /* set new task to the schwdules array */
            let schedule = []
            schedule['datetimeStart'] = dateStart + ' ' + hourStart+':00'
            schedule['datetimeEnd'] = dateEnd + ' ' + hourEnd+':00'
            schedule['title'] = title
            schedule['description'] = description
            schedules.push(schedule)
            /* call a function to show all tasks */
            displayDays(month,year)
            document.querySelector("#dateStart").value = ""
            document.querySelector("#hourStart").value = ""
            document.querySelector("#dateEnd").value = ""
            document.querySelector("#hourEnd").value = ""
            document.querySelector("#title").value = ""
            document.querySelector("#description").value = ""
        } else {
            console.log('We had a problem to connect with PHP')
            alert('We had a problem to connect with PHP')
        }
    })
}