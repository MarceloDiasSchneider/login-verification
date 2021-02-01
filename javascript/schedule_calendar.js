/* Load schedules from datebase */
let schedules = []
let ready = false

function schedule_load(){
    $.post('schedule_load.php', function(phpReturns, state){
        if(state == 'success'){
            var jSonObject = JSON.parse(phpReturns)
            // console.log(phpReturns)
            
            jSonObject.forEach(pushItem);
            function pushItem(item, index) {
                let schedule = []
                schedule['datetimeStart'] = item['datetimeStart']
                schedule['datetimeEnd'] = item['datetimeEnd']
                schedule['title'] = item['title']
                schedule['description'] = item['description']
                schedules[index] = schedule
                ready = true
                displayDays(month,year)
                console.log(schedules)  
            }
        } else {
            console.log('We had a problem to connect with PHP')
            alert('We had a problem to connect with PHP')
        }
    })
}
schedule_load()

/* display month on header and set button */
let month = new Date().getMonth()
let year = new Date().getFullYear()
let previous 
let next
displayMonth(month)

function displayMonth(month){
    const monthNames = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
    let current = month
    month == 0 ? previous = 11 : previous = month-1
    month == 11 ? next = 0 : next = month+1
    $("#previousMonth").html(monthNames[previous])
    $("#titleCurrentMonth").html(monthNames[current] +' '+ year)
    $("#nextMonth").html(monthNames[next])
    displayDays(month,year)
    }

/* navigate through the months */
$('#previousMonth').click( () =>{ 
    month == 0 ? month = 11 : month --
    month == 11 ? year -- : year = year
    displayMonth(month)
} )
$('#nextMonth').click( () =>{ 
    month == 11 ? month = 0 : month ++
    month == 0 ? year ++ : year = year
    displayMonth(month)
})  
/* return to present day */
$('#currentMonth').click( ()=>{
    month = new Date().getMonth()
    year = new Date().getFullYear()
    displayMonth(month)
})

/* create the calendar day */
function displayDays(dmonth,dyear){
    const weekday= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]

    /* variables to controel calendar bliud */
    let dateInitial = new Date(dyear, dmonth,)
    // let lastDaypreviousMonth = new Date(year, month, 0).getDate();
    let lastDayCurrentMonth = new Date(year, month+1, 0).getDate();
    let weekDayInitial = dateInitial.getDay() 

    /* clear the body calendar to load a now month */
    $("#calendarBody").empty();
    
    /* creating single day to the calendar */
    let loopLastMonth = weekDayInitial
    let loopCurrentMonth = weekDayInitial + lastDayCurrentMonth
  
    let dateStartDay
    let actualMonth
    for (let index = 1; index <= 42; index ++) {
        if( loopLastMonth > 0){
            dateStartDay = new Date(dyear,dmonth,- loopLastMonth + 1)
            dateEndDay =  new Date(dyear,dmonth,- loopLastMonth + 2)
            actualMonth = false
            loopLastMonth --
        } else if (index > weekDayInitial && index <= loopCurrentMonth){ 
            dateStartDay = new Date(dyear,dmonth, index - weekDayInitial)
            dateEndDay =  new Date(dyear,dmonth, index - weekDayInitial + 1)
            actualMonth = true
        } else {
            dateStartDay = new Date(dyear,dmonth, index - weekDayInitial)
            dateEndDay =  new Date(dyear,dmonth, index - weekDayInitial + 1)
            actualMonth = false
        }
        /* create alementes DOm */
        let div = document.createElement("div")
        div.classList.add('day', 'col-sm', 'p-2', 'border', 'border-left-0', 'border-top-0', 'text-truncate')
        if(actualMonth == false){
            div.classList.add('d-none', 'd-sm-inline-block', 'bg-light', 'text-muted') // set conditions to hidden on display week
        } 
        let h5 = document.createElement("h5")
        h5.classList.add('row', 'align-items-center')
            /* those element it gonna be a children's of h5 */
            let span1 = document.createElement("span")
            span1.classList.add('date', 'col-1')
            span1.innerHTML = dateStartDay.getDate() // set days
            span1.setAttribute("onclick",'') // new task clicking on the day
            span1.setAttribute("data-bs-toggle","modal") // open modal to create new schedules
            span1.setAttribute("data-bs-target","#createSchedule")
            span1.setAttribute("value",dateStartDay)

            let small = document.createElement("small")
            small.classList.add('col', 'd-sm-none', 'text-center', 'text-muted')
            small.innerHTML = weekday[dateStartDay.getDay()] // set week day
            let span2 = document.createElement("span")
            span2.classList.add('col-1')
            
            /* load a schedule from date base */
            let p = document.createElement("p")
            p.classList.add('d-sm-none')
            p.innerHTML = 'No events'
            
            /* append elementes created to the DOM */
            // h5.append(input)
            h5.append(span1)
            h5.append(small)
            h5.append(span2)
            div.append(h5)
            
            
        /* setting schedules from database */
            if (ready){
                schedules.forEach(disablingDates)
                function disablingDates(item, index) {
                    /* formating dates */
                    scheduleStart = new Date(Date.parse(item['datetimeStart']))
                    scheduleEnd = new Date(Date.parse(item['datetimeEnd']))
                    title = item['title']
                    description = item['description']
                    /* verification to set each task on right day */
                    if( dateStartDay <= scheduleEnd && scheduleStart <= dateEndDay){
                        let a = document.createElement("a")
                        a.classList.add('event', 'd-block', 'p-1', 'pl-2', 'pr-2', 'mb-1', 'rounded', 'text-truncate', 'small', 'bg-info', 'text-white')
                        a.innerHTML = ''
                        if(dateStartDay <= scheduleStart && scheduleStart <= dateEndDay ){
                            a.innerText += formatHour(scheduleStart) + ' '                        }
                        a.innerText += title
                        if(dateStartDay <= scheduleEnd && scheduleEnd <= dateEndDay) {
                            a.innerText += ' ' + formatHour(scheduleEnd)
                        }
                        a.setAttribute("data-bs-toggle", "modal")
                        a.setAttribute("data-bs-target", "#showTask")
                        a.setAttribute('onclick',`showTaskModal(${index})`)
                        div.append(a)
                    }
                }
            } else{
                div.append(p)
            }

        $("#calendarBody").append(div)
              
        /* Create a row each 7 days */
        if(index == 7 || index == 14 || index == 21 || index == 28 || index == 35 ){
            let divRow = document.createElement("div")
            divRow.classList.add('w-100')
            $("#calendarBody").append(divRow)
        }
    }
}

/* add a zero to formater number */
function addZero(i) {
    if (i < 10) {
      i = "0" + i;
    }
    return i;
  }

 /* format hour to display */
function formatHour(hourToFormat) {
    var d = hourToFormat;
    var h = addZero(d.getHours());
    var m = addZero(d.getMinutes());
    var s = addZero(d.getSeconds());
    return h + ":" + m;
}

function setDateModal(dateToSet){
    console.log(dateToSet)
}
function showTaskModal(index){
    document.querySelector("#showtitle").innerHTML = schedules[index]['title']
    document.querySelector("#showDates").innerHTML = schedules[index]['datetimeStart']+' '+schedules[index]['datetimeEnd'] 
    document.querySelector("#showDescription").innerHTML = schedules[index]['description']
}

/* setting min to date end  */
document.querySelector("#dateStart").addEventListener("focusout", () =>{
    let dateMin = document.querySelector("#dateStart").value
    document.querySelector("#dateEnd").setAttribute("min",dateMin)
    document.querySelector("#dateEnd").setAttribute("value",dateMin)
})
/* setting max hour to hour start */
// desenvolver

/* setting max to date start */
document.querySelector("#dateEnd").addEventListener("focusout", () =>{
    let dateMax = document.querySelector("#dateEnd").value
    document.querySelector("#dateStart").setAttribute("max",dateMax)
})
/* setting min hour to hour end */
document.querySelector("#hourStart").addEventListener("focusout", () =>{
    let hourMin = document.querySelector("#hourStart").value
    document.querySelector("#hourEnd").setAttribute("min",hourMin)
    document.querySelector("#hourEnd").setAttribute("value",hourMin)
})
// desenvolver
