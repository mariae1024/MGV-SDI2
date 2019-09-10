


    function emailregular(){
        var email=$('#loginMail').val();
        if(email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)){
             $('#loginMail').css('border','2px green solid');
        }
           else{
               $('#loginMail').css('border','2px red solid');
           }
    }
 