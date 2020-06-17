$(document).ready(function() {
    const myFile = $('#file');
    var loader = $('#loader');
    var alert = $('#alert');
    const myForm = $('#myForm');
    var barProgress = $('#progress-bar');
    var emails = [];
    var [emailsButton, hashButton, buttons] = [$('#emailsButton'), $('#hashButton'), $('.btn-primary')];

    myFile.on("change", function (e) {
        var file = myFile[0].files[0];
        var reader = new FileReader();
        reader.readAsText(file, "UTF-8");
        reader.onload = function (evt){
            // Je filtre mes hash en miniscule avec une Regex
            const formData = new FormData(myForm[0]);
            const result = evt.target.result;
            var md5 = result.toLocaleLowerCase().match(/[a-f0-9]{32}$/gm);
            var sha256 = result.toLocaleLowerCase().match(/[A-Fa-f0-9]{64}/g);
            if(sha256){
                var hash = 'SHA256';
                var toImport = 'MD5';
            }else{
                var hash = 'MD5';
                var toImport = 'SHA256';
            }
            hashButton.css({'display': 'flex'}).html(toImport);
            formData.append('hash', hash);
            if(!md5 && !sha256){
                // alert("Erreur ! Soit votre fichier ne contient ni de sha256 ou de md5, soit les hashs ne sont pas séparés par un retour à la ligne !");
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Erreur ! Soit votre fichier ne contient ni de sha256 ou de md5, soit les hashs ne sont pas séparés par un retour à la ligne !',
                    footer: '<a href>Why do I have this issue?</a>'
                })
            }else{
                storeFile(formData, sha256 || md5, hash, toImport);
            }
        }
        reader.onerror = function (evt){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: '<a href>Why do I have this issue?</a>'
            })
        }
    });    

    const storeFile = (file, elements, hash, toImport) => {
        hashButton.removeAttr("disabled");
        emailsButton.removeAttr("disabled");        
        alert.css({'display': 'none'});
        barProgress.css({'width': '0px'});
        loader.each(function(k, v){
            v.style.display = 'none';
        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            enctype: "multipart/form-data",
            method: 'POST',
            cache: false,
            url: '/repoussoir/store',
            data: file,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: (res) => {
                
                hashButton.one('click', function(event){
                    sendHashToServer(elements.length, elements, hash, toImport);
                    event.stopImmediatePropagation();
                });
                
                emailsButton.one('click', function(event){
                    sendHashToServer(elements.length, elements, hash, 'email');
                    event.stopImmediatePropagation();
                });
                
            }
        })
        
    }

    const sendHashToServer = (nbrHash, elements, hash, toImport, progress = 10000) => {
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
                url: '/repoussoir/create',
                data: {
                    elements: JSON.stringify(array),
                    hash: hash,
                    toImport: toImport
                },
                success: (res) => {
                    emails.push(res);
                    sendHashToServer(nbrHash, elements.slice(sendNbr, elements.length),hash, toImport, progress+sendNbr);
                }
            }) 
        }else{
            hashButton.removeAttr("disabled");
            emailsButton.removeAttr("disabled");
            alert.css({'display': 'block'});
            loader.each(function(k, v){
                v.style.display = 'none';
            });
            var blob = new Blob([emails[0].join('\n')], {type: "text/plain;charset=utf-8"});
            saveAs(blob, toImport+'.txt');
            emails = [];
        }
        
    }
});