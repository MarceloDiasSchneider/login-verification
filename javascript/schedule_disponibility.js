/* Verify with hours are disponible */
document.querySelector("#date_search").addEventListener('click', () => { searchHoursAvalible()})
function searchHoursAvalible() {
    let date = document.querySelector("#date").value

    let selectedDate = {
        d : date,
    }
    
    // document.querySelector("#hours_available").style.display = "initial";

    $.post('schedule_disponibility.php', selectedDate, function(phpReturns, state){
        if(state == 'success'){

            let object = JSON.parse(phpReturns)
            // console.log(phpReturns);

            let select = document.querySelector("#hour")
            
            /* Clean options before add news options */
            let length = select.options.length;
            for (i = length-1; i >= 0; i--) {
                select.options[i] = null;
            }

            object.forEach(myFunction);
            function myFunction(item, index) {
                console.log(object[index])
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


