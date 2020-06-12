window.addEventListener("DOMContentLoaded", () => {
    // Je définie ici les éléments dont j'ai besoin
    var myFile = $('#file');
    var myButton = $('#sendButton');
    var loader = $('#loader');
    var alert = $('#alert');
    var select = $("#exampleFormControlSelect1");
    const barProgress = $('#progress-bar');

    // J'initialise un événement lorsque je click sur mon boutton 'Send'
    myButton.on("click", function (e) {
        var file = myFile[0].files[0];
        var reader = new FileReader();
        reader.readAsText(file, "UTF-8");
        reader.onload = function (evt){
            // Je filtre mes mails avec une Regex
            const emails = evt.target.result.match(/[a-zA-Z0-9_\-\+\.]+@[a-zA-Z0-9\-]+\.([a-zA-Z]{2,4})(?:\.[a-zA-Z]{2})?/g);
            const fileName = file.name;
            const fileSize = file.size;
            const fileType = file.type;
            const base = select.val();
            // J'execute ma fonction en lui donnant le nombre de mails total puis les mails dans un tableau
            sendMailsToServer(emails.length, emails)
        }
        reader.onerror = function (evt){
            console.log('Error reading file');
        }
    });

    const sendMailsToServer = (nbrMails, emails, progress = 40000) => {
        myButton.attr("disabled", true);
        alert.css({'display': 'none'});
        loader.css({'display': 'block'});
        var result = progress*100/nbrMails;
        var array = [];
        const sendNbr = 40000;
        barProgress.css({'width': result+'%'})
        for (let index = 0; index < sendNbr; index++) {
            array.push(emails[index]);
        }
        // Si il y a moins de 40000 mails j'enlève tous les éléments de mon tableau undefined
        array = array.filter(function(element){
            return element !== undefined;
        })
        // Puis j'envoie mes mails à mon serveur
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/liste/create',
            data: {
                emails: JSON.stringify(array),
            },
            success: function(res){
                if(!array.length > 0){
                    loader.css({'display': 'none'})
                    myButton.removeAttr('disabled');
                    alert.css({'display': 'block'});
                }else{
                    // Si il reste encore des éléments dans mon tableau je re execute ma fonction, donc un nouvelle envoie au serveur
                    sendMailsToServer(nbrMails, emails.slice(sendNbr, emails.length), progress+sendNbr);
                }
            }
        })
    }
})
