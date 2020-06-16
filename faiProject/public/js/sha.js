$(document).ready(function() {
    const myButton = $('#sendButton');
    const myFile = $('#file');
    var loader = $('#loader');
    var alert = $('#alert');
    const myForm = $('#myForm');
    var barProgress = $('#progress-bar');
    var emails = [];

    myButton.on("click", function (e) {
        var file = myFile[0].files[0];
        var reader = new FileReader();
        reader.readAsText(file, "UTF-8");
        reader.onload = function (evt){
            // Je filtre mes hash en miniscule avec une Regex
            const formData = new FormData(myForm[0]);
            const result = evt.target.result;
            const md5 = result.toLocaleLowerCase().match(/[a-f0-9]{32}$/gm);
            const sha256 = result.toLocaleLowerCase().match(/[A-Fa-f0-9]{64}/g);
            if(md5){
                var hash = 'md5';
            }else{
                var hash = 'sha256';
            }
            formData.append('hash', hash);
            if(!md5 && !sha){
                alert('Erreur ! Soit votre fichier ne contient ni de sha256 ou de md5, soit les hashs ne sont pas séparés par un retour à la ligne !');
            }else{
                storeFile(formData, md5 || sha256, hash);
            }
        }
        reader.onerror = function (evt){
            alert('Error reading file');
        }
    });

    const storeFile = (file, elements, hash) => {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            enctype: "multipart/form-data",
            method: 'POST',
            cache: false,
            url: '/sha/store',
            data: file,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(res){
                // Une fois finie, j'execute la fonction qui envoie les mails au serveur
                sendHashToServer(elements.length, elements, hash);
            }
        })
    }

    const sendHashToServer = (nbrHash, elements, hash, progress = 10000) => {
        myButton.attr("disabled", true);
        alert.css({'display': 'none'});
        loader.css({'display': 'block'});
        var array = [];
        var result = progress*100/nbrHash;
        const sendNbr = 10000;
        barProgress.css({'width': result+'%'});
        array = elements.slice(0, sendNbr);
        array = array.filter(function(element){
            return element !== undefined;
        })
        if(array.length > 0){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                enctype: "multipart/form-data",
                method: 'POST',
                url: '/sha',
                data: {
                    elements: JSON.stringify(array),
                    hash: hash,
                },
                success: (res) => {
                    emails.push(res);
                    sendHashToServer(nbrHash, elements.slice(sendNbr, elements.length),hash, progress+sendNbr);
                }
            }) 
        }else{
            loader.css({'display': 'none'})
            myButton.removeAttr('disabled');
            alert.css({'display': 'block'});
            var blob = new Blob([emails[0].join('\n')], {type: "text/plain;charset=utf-8"});
            saveAs(blob, hash+'.txt');
        }
        
    }
});