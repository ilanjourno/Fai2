window.addEventListener("DOMContentLoaded", () => {
    var myFile = $('#file');
    var myButton = $('#sendButton');
    var submitButton = $('submitButton');
    var loader = $('#loader');
    var alert = $('#alert');
    var select = $("#exampleFormControlSelect1");
    const barProgress = $('#progress-bar');

    myButton.on("click", function (e) {
        var file = myFile[0].files[0];
        var reader = new FileReader();
        reader.readAsText(file, "UTF-8");
        reader.onload = function (evt){
            const emails = evt.target.result.match(/[a-zA-Z0-9_\-\+\.]+@[a-zA-Z0-9\-]+\.([a-zA-Z]{2,4})(?:\.[a-zA-Z]{2})?/g);
            const fileName = file.name;
            const fileSize = file.size;
            const fileType = file.type;
            const base = select.val();
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
        barProgress.html(Math.round(result)+'%')
        for (let index = 0; index < 40000; index++) {
            array.push(emails[index]);
        }
        array = array.filter(function(element){
            return element !== undefined;
        })
        console.log(array)
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
                if(!res){
                    loader.css({'display': 'none'})
                    myButton.removeAttr('disabled');
                    alert.css({'display': 'block'});
                    myButton.prop("type", "submit");;
                    submitButton.trigger('click');
                }else{
                    sendMailsToServer(nbrMails, emails.slice(sendNbr, emails.length), progress+40000);
                }
            }
        })
    }
})
