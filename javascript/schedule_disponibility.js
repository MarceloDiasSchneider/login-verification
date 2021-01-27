/* Verify with hours are disponible */
let load = true

document.querySelector("#date").addEventListener('click', () => { 
    /* Clean options before add news options */
    let select = document.querySelector("#hour")
    let length = select.options.length;
    for (i = length-1; i >= 0; i--) {
        select.options[i] = null;
    }
    load = true
})
document.querySelector("#date_search").addEventListener('click', () => { 
    let date = document.querySelector("#date").value
    if (date != '' && load == true){
        searchHoursAvalible()
        load = false
    }
})
document.querySelector("#hour").addEventListener('click', () => { 
    let date = document.querySelector("#date").value
    if (date != '' && load == true){
        searchHoursAvalible()
        load = false
    }
})

function searchHoursAvalible() {
    let date = document.querySelector("#date").value
    let id_user = document.querySelector("#id").value

    let selectedDate = {
        i : id_user,
        d : date
    }
    
    // document.querySelector("#hours_available").style.display = "initial";

    $.post('schedule_disponibility.php', selectedDate, function(phpReturns, state){
        if(state == 'success'){
            let object = JSON.parse(phpReturns)
            
            /* Get the select to manipulate */
            let select = document.querySelector("#hour")
            
            /* Clean options before add news options */
            let length = select.options.length;
            for (i = length-1; i >= 0; i--) {
                select.options[i] = null;
            }

            /* Set options to select */
            object.forEach(settingOptions);
            function settingOptions(item, index) {
                
                let option = document.createElement("option");
                option.setAttribute("value", item)
                option.text = item;
                select.options.add(option);
            }
            
        } else {
            console.log('We had a problem to connect with PHP')
            alert('We had a problem to connect with PHP')
        }
    })
}


