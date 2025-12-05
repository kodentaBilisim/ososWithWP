async function login() {

    var bilgi = {
        usercode: $('#kullaniciadi').val(),
        password: $('#sifre').val(),
    }

    var email1 = bilgi["email"];
    var password1 = bilgi["password"];
    var token = bilgi["token"];


   await $.ajax({
        type: 'post',
        url: 'api/login/APILogin.php',
        data: {query: bilgi},
        success: function (result) {

            console.log(result);
            if(result == 0){

                $('#danger').show();
                $('#loading').hide();
                $('#success').hide();

            }else{


                if(result == '-1'){
                    $('#danger').show();
                    $('#loading').hide();
                    $('#success').hide();
                    alert('Kullanım süreniz doldu!')
                }
                if(result > 0){
                    $('#danger').hide();
                    $('#loading').hide();
                    $('#success').show();
                    window.location.assign('/panel');

                }



            }

        }

    });


}

async function aidat() {

    var bilgi = {
        tckno: $('#tckn').val(),
        tel: $('#telefon').val(),
    }


   await $.ajax({
        type: 'post',
        url: 'api/login/APIAidat.php',
        data: {query: bilgi},
        success: function (result) {

            console.log(result);
            if(result == 0){

                $('#danger').show();
                $('#loading').hide();
                $('#success').hide();

            }else{


                if(result == '-1'){
                    $('#danger').show();
                    $('#loading').hide();
                    $('#success').hide();
                    alert('Kullanım süreniz doldu!')
                }
                if(result > 0){
                    $('#danger').hide();
                    $('#loading').hide();
                    $('#success').show();
                    window.location.assign('/panel');

                }



            }

        }

    });


}

async function reset() {

    var bilgi = {
        usercode: $('#kullaniciadi').val(),
        emailortel: $('#emailortel').val(),
    }

    await $.ajax({
        type: 'post',
        url: 'api/login/APIReset.php',
        data: {query: bilgi},
        success: function (result) {

            console.log(result);
            if (result == 0) {

                $('#danger').show();
                $('#loading').hide();
                $('#success').hide();

            } else {


                $('#danger').hide();
                $('#loading').hide();
                $('#success').show();
                window.location.assign('login?reset');


            }

        }

    });


}
