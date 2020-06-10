window.addEventListener("DOMContentLoaded", () => {
    var myFile = document.getElementById('file');
    var loader = document.getElementById('loader');
    var myButton = $('#sendButton');
    var alert = document.getElementById('alert');
    
    myFile.addEventListener('change', (evt) => {
        var f = myFile.files[0];
        if(f){
            var reader = new FileReader();
            reader.readAsText(f, "UTF-8");
            reader.onload = function (evt){
                const emails = evt.target.result.match(/[a-zA-Z0-9_\-\+\.]+@[a-zA-Z0-9\-]+\.([a-zA-Z]{2,4})(?:\.[a-zA-Z]{2})?/g);
                sendMailsToServer(emails);
            }
            reader.onerror = function (evt){
                console.log('Error reading file');
            }
        }
    })

    function sendMailsToServer(emails, array = []){
      myButton.attr("disabled", true);
      alert.style.display = "none";
      loader.style.display = "block";
      for (var i = 0; i < emails.length; i++) {
        array.push(emails[i])
      }
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          url: '/liste/create',
          data: {emails: JSON.stringify(array)},
          success: function(res){
              if(!res){
                loader.style.display = "none";
                myButton.removeAttr('disabled');
                alert.style.display = "block";
              }
          }
      })
    }
})
