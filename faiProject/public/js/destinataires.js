window.addEventListener("DOMContentLoaded", () => {
    var myFile = document.getElementById('file');
    var loader = document.getElementById('loader');
    var myButton = document.getElementById('sendButton');
    myFile.addEventListener('change', (evt) => {
        var f = myFile.files[0];
        if(f){
            var reader = new FileReader();
            reader.readAsText(f, "UTF-8");
            reader.onload = function (evt){
                const emails = evt.target.result.match(/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/g);
                sendMailsToServer(emails);
            }
            reader.onerror = function (evt){
                console.log('Error reading file');
            }
        }
    })

    function sendMailsToServer(emails, key = 0, array = []){
      loader.style.display = "block";
      myButton.addEventListener('click', () => {
        event.preventDefault();
      })
      for (var i = key; i < key+700; i++) {
        array.push(emails[i])
      }
      array = array.filter(function (element) {
        return element !== undefined;
      })
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          url: '/liste/create',
          data: {emails: JSON.stringify(array)},
          success: function(res){
              if(res){
                sendMailsToServer(emails.slice(700, emails.length));
              }else{
                loader.style.display = "none";
              }
          }
      })
    }
})
