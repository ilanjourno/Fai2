$(document).ready(function() {
    const myButton = $('#sendButton');
    const myFile = $('#file');
    const myForm = $('#myForm');

    myButton.on("click", function (e) {
        var file = myFile[0].files[0];
        var reader = new FileReader();
        reader.readAsText(file, "UTF-8");
        reader.onload = function (evt){
            // Je filtre mes hash en miniscule avec une Regex
            const formData = new FormData(myForm[0]);
            const result = evt.target.result;
            const md5 = result.toLocaleLowerCase().match(/^[a-f0-9]{32}$/gm);
            const sha = result.toLocaleLowerCase().match(/^[a-f0-9]{40}$/gm);
            if(sha){
                var hash = 'sha';
            }else{
                var hash = 'md5';
            }
            storeFile(formData, sha || md5, hash)
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

    const sendHashToServer = (nbrHash, elements, hash) => {
        var array = [];
        const sendNbr = 20000;
        for (let index = 0; index < sendNbr; index++) {
            array.push(elements[index]);
        }
        // Si il y a moins de 40000 mails j'enlève tous les éléments de mon tableau undefined
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
                success: function(res){
                    if(array.length > 0){
                        sendHashToServer(nbrHash, elements.slice(sendNbr, nbrHash));
                    }
                    if(res){
                        var blob = new Blob(res, {type: "text/plain;charset=utf-8"});
                        saveAs(blob, hash+'.txt');
                    }
                }
            }) 
        }
        
    }
});