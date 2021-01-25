$(document).ready(function(){
    $("#update_adderss").submit(function( event ){
        update_adderss()
      event.preventDefault();
    });
});

function update_adderss(){
    let id = document.querySelector('#id').value
    let country = document.querySelector('#country').value
    let region = document.querySelector('#region').value
    let city = document.querySelector('#city').value
    let postcode = document.querySelector('#postcode').value
    let address1 = document.querySelector('#address1').value
    let address2 = document.querySelector('#address2').value

    let dataToUpdate = {
        i : id,
        co : country,
        re : region,
        ci : city,
        po : postcode,
        a1 : address1,
        a2 : address2
    }
    /* using jQuery to comunicate with PHP */
    $.post('update_address.php', dataToUpdate, function(phpReturns, state){
        if(state == 'success'){
            let address_message = document.querySelector("#address-message")
            address_message.innerHTML = phpReturns
            address_message.classList.add('alert','alert-success')
            setTimeout(function(){ 
                address_message.innerHTML = ''
                address_message.classList.remove('alert','alert-success')
            }, 3000);
        } else {
            document.querySelector("#address-message").innerHTML = 'We had a problem to connect with PHP'
        }
    })
}