$(document).ready(function(){
    $("#update_password").submit(function( event ){
        update_paswword()
      event.preventDefault();
    });
});

function update_paswword(){
    let id = document.querySelector('#id').value
    let last_password = document.querySelector('#last-password').value
    let new_password = document.querySelector('#new-password').value
    let repeat_new_password = document.querySelector('#repeat-new-password').value

    let dataToUpdate = {
        i : id,
        l : last_password,
        n : new_password,
        r : repeat_new_password
    }
    
    /* using jQuery to comunicate with PHP */
    $.post('update_password.php', dataToUpdate, function(phpReturns, state){
        if(state == 'success'){
            if( phpReturns !== 'error'){
                let password_message = document.querySelector("#password-message")
                password_message.innerHTML = phpReturns
                password_message.classList.add('alert','alert-primary')
                setTimeout(function(){ 
                    password_message.innerHTML = ''
                    password_message.classList.remove('alert','alert-primary')
                }, 3000);
            }
        } else {
            document.querySelector("#password-message").innerHTML = 'We had a problem to connect with PHP'
        }
    })
}