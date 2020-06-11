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
            // const fileName = file.name;
            // const fileSize = file.size;
            // const fileType = file.type;
            // const base = select.val();
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
        const sendNbr = 20000;
        barProgress.css({'width': result+'%'})
        for (let index = 0; index < sendNbr; index++) {
            array.push(emails[index]);
        }
        array = array.filter(function(element){
            return element !== undefined;
        })
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
                    storeFile(myFile);
                }else{
                    sendMailsToServer(nbrMails, emails.slice(sendNbr, emails.length), progress+sendNbr);
                }
            }
        })

        const storeFile = files => {
            var formData = new FormData($('#test')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '/liste/upload',
                data: {
                    file: JSON.stringify([...formData])
                },
                success: function(res){
                    console.log(res)
                }
            })
        }
    }
})
