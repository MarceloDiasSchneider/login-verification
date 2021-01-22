//document.querySelector('#personal-information').addEventListener('click', () => { update_paswword()})
$(document).ready(function(){
    $("#test").submit(function( event ){
      alert("Submitted");
      event.preventDefault();
    });
});

/*
function update_paswword(){

    let id = document.querySelector('#id').value
    let name = document.querySelector('#name').value
    let email = document.querySelector('#email').value
    let phone = document.querySelector('#phone').value
    let codice_fiscale = document.querySelector('#codice-fiscale').value

    let dataToUpdate = {
        i : id,
        n : name,
        e : email,
        p : phone,
        c : codice_fiscale
    }
    
    /* using jQuery to comunicate with PHP */
    /*
    $.post('update_personal_information.php', dataToUpdate, function(phpReturns, state){
        if(state == 'success'){
            if( phpReturns !== 'error'){
                let personal_information_message = document.querySelector("#personal-information-message")
                personal_information_message.innerHTML = phpReturns
                personal_information_message.classList.add('alert','alert-primary')
                setTimeout(function(){ 
                    personal_information_message.innerHTML = ''
                    personal_information_message.classList.remove('alert','alert-primary')
                }, 3000);
            }
        } else {
            document.querySelector("#personal-information-message").innerHTML = 'We had a problem to connect with PHP'
        }
    })
}
*/