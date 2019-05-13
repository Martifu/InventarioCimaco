// Initialize Firebase
var config = {
    apiKey: "AIzaSyDaWkiwgxNyn6PuOVKgo3n3jICxt2NT32M",
    authDomain: "limpi-f52da.firebaseapp.com",
    databaseURL: "https://limpi-f52da.firebaseio.com",
    projectId: "limpi-f52da",
    storageBucket: "limpi-f52da.appspot.com",
    messagingSenderId: "559812347088"
};
firebase.initializeApp(config);
firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
        $('#usuario').text(user.email);
        $('#info').text(user.emailVerified);
    } else {

    }
});

$(document).ready(function () {
    $('#btn-in').click(function () {
        var correo = $('#inputcorreo').val();
        var contra = $('#inputpass').val();


        firebase.auth().signInWithEmailAndPassword(correo, contra).then(function (user) {
            $('.mensaje').append('<div class="alert alert-success" role="alert"> Iniciaste correctamente</div>');

        }).catch(function(error) {
            // Handle Errors here.
            var errorCode = error.code;
            var errorMessage = error.message;
            if (error.message = 'INVALID_PASSWORD')
            {
                $('.mensaje').append('<div class="alert alert-danger" role="alert"> Contraseña incorrecta</div>');
            }

            // ...
        });
    });

    $('.btn-registro').click(function () {

        var correo = $('#correoR').val();
        var pass1 = $('#contraR').val();
        var pass2 = $('#contraR2').val();
        if (pass1 == pass2)
        {
            firebase.auth().createUserWithEmailAndPassword(correo, pass1).then(function (user) {

                var user = firebase.auth().currentUser;

                user.sendEmailVerification().then(function() {
                    console.log("Enviado");
                    window.location.replace('/inicio');
                }).catch(function(error) {
                    // An error happened.
                });


                console.log("Registrado")
            }).catch(function(error) {
                // Handle Errors here.
                var errorCode = error.code;
                var errorMessage = error.message;
                // ...
            });


        }
        else {
            alert('Las contraseñas no coinciden')
        }


    });

    $('.btn-recovery').click(function () {
        var contenido = $('#recoveryContenido');

        var auth = firebase.auth();
        var emailAddress =   $('#correoRecovery').val();

        auth.sendPasswordResetEmail(emailAddress).then(function() {
            contenido.html('');
            contenido.append('<div class="alert alert-success" role="alert"> Enviado. Verifica tu correo</div>')
        }).catch(function(error) {
            // An error happened.
        });

    });

    $('.btn-cerrarsesion').click(function () {
        firebase.auth().signOut().then(function() {
            window.location.reload();
        }).catch(function(error) {
            // An error happened.
        });
    })
});