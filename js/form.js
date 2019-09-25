$(document).ready(function(){
console.log('coucou');
    var spanPrenom = $('#erreurPrenom');

    function checkPrenom(champ) {

        var thisInput = champ.value;
        console.log(champ);
        console.log(thisInput);

        if (thisInput == "") {

            $('#erreurPrenom').text("Veuillez remplir ce champ");
            $('#prenom').css('background-color','#FA5858');

            return false;

            } else if (thisInput.length < 2 || thisInput.length > 30 || isNaN(thisInput) == false) {

                $('#erreurPrenom').text("Champ invalide");
                $('#prenom').css('background-color','#FA5858');

                return false;

                    } else {

                        console.log('Prénom correct');
                        $('#erreurPrenom').text('');
                        $('#prenom').css('background-color','')
                        return true;
                        
                    }

        }


    function checkNom(champ) {

        var thisInput = champ.value;
        console.log(thisInput);

        if (thisInput == "") {

            $('#erreurNom').text("Veuillez remplir ce champ");
            $('#nom').css('background-color','#FA5858');

            return false;

            } else if (thisInput.length < 2 || thisInput.length > 30 || isNaN(thisInput) == false) {

                $('#erreurNom').text("Champ invalide");
                $('#nom').css('background-color','#FA5858');

                return false;

                    } else {

                        console.log('Prénom correct');
                        $('#erreurNom').text('');
                        $('#nom').css('background-color','')
                        return true;
                        
                    }

        }


    function checkDate(champ) {

        var thisInput = champ.value;
        console.log(thisInput);

        if (thisInput == "") {

            $('#erreurDate').text("Veuillez remplir ce champ");
            $('#date').css('background-color','#FA5858');

            return false;

                } else {

                    $('#erreurDate').text('');
                    $('#date').css('background-color','')
                    return true;
                    
                }

        }

    function checkAddress(champ) {

        var thisInput = champ.value;
        console.log(thisInput);

        if (thisInput == "") {

            $('#erreurAdresse').text("Veuillez remplir ce champ");
            $('#adresse').css('background-color','#FA5858');
            return false;

        } else {

            $('#erreurAdresse').text('');
            $('#adresse').css('background-color','')
            return true;


        }

    }

    function checkPostalCode(champ) {

        var thisInput = champ.value;
        console.log(thisInput);

        if (thisInput == "") {

            $('#erreurCodePostal').text("Veuillez remplir ce champ");
            $('#codePostal').css('background-color','#FA5858');
            return false;

            } else if (isNaN(parseInt(thisInput)) || parseInt(thisInput).length > 13 ) {

                $('#erreurCodePostal').text("Numéro invalide");
                $('#codePostal').css('background-color','#FA5858');
                return false;

                } else {

                    $('#erreurCodePostal').text("");
                    $('#codePostal').css('background-color','');
                    return true;
                }

    }



    function checkForm() {

        if (checkPrenom($('#prenom')) == false || checkNom($('#nom')) == false) {

            return true;

            } else {

                return false;
            }

    } 

});

