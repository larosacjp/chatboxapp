$(document).ready(function()
{
  var cont = document.getElementById("content");
  cont.scrollTop = cont.scrollHeight;

  chatUpdate();

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $("#content").scroll(function(){

    var scrollPos = $(this).scrollTop();

    var oldScroll= content.scrollHeight - content.clientHeight;

    if(scrollPos == 0)
    {

      var firstid = $('.chatid').first().val();

      $.get('chatRequest',{idFirst: firstid},function(data){

        $("#content").prepend(data);

      }).done(function(){
        var newScroll = content.scrollHeight - content.clientHeight;
        content.scrollTop = scrollPos + (newScroll - oldScroll);
      });



    }

  });

  $(document).on("click", "#chatsubmit", function(){

    var chatInput = $("#chatInput").val();
    var chatUser = $("#chatUsername").val();
    var chatlastID = $(".chatid").last().val();

    if(chatInput ==''){
      alert("Do not leave chat blank");
    }else{

      $.post("chatting", {inputChat: chatInput, userChat: chatUser, lastIDchat: chatlastID}, function(data){
        $("#content").append(data);
      }).done(function(){
        $("#chatInput").val('');
      });
    }


  });

  $(document).on("keyup", "#chatInput", function(e){
    if (e.key === 'Enter' || e.keyCode === 13) {

      var chatInput = $("#chatInput").val();
      var chatUser = $("#chatUsername").val();
      var chatlastID = $(".chatid").last().val();

      if(chatInput ==''){
        alert("Do not leave chat blank");
      }else{

        $.post("chatting", {inputChat: chatInput, userChat: chatUser, lastIDchat: chatlastID}, function(data){
          $("#content").append(data);
        }).done(function(){
          $("#chatInput").val('');
        });
      }

    }


  });

  function chatUpdate(){

    var lastid = $('.chatid').last().val();

    $.get('chatUpdate', {idLast: lastid}, function(data){

      $("#content").append(data);
      if(data == ''){

      }else{
        var cont = document.getElementById("content");
        cont.scrollTop = cont.scrollHeight
      }


      setTimeout(chatUpdate, 500);


    });
  }

});
