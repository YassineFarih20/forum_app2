import "./bootstrap";

$(document).ready(function () {
  $('#stars li').on('mouseover', function () {
      var onStar = parseInt($(this).data('value'), 10);

      $(this)
          .parent()
          .children('li.star')
          .each(function (e) {
              if (e < onStar) {
                  $(this).addClass('hover');
              } else {
                  $(this).removeClass('hover');
              }
          });
  }).on('mouseout', function () {
      $(this)
          .parent()
          .children('li.star')
          .each(function (e) {
              $(this).removeClass('hover');
          });
  });

  $('#stars li').on('click', function () {
      var onStar = parseInt($(this).data('value'), 10);
      var title = $(this).attr('title'); 

      $('#note_posture_input').val(title)


      var stars = $(this).parent().children('li.star');

      for (var i = 0; i < stars.length; i++) {
          $(stars[i]).removeClass('selected');
      }

      for (var i = 0; i < onStar; i++) {
          $(stars[i]).addClass('selected');
      }

      var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
      var msg = '';

      $.ajax({
          type: 'POST',
          url: '{{ route("remarques.enregistrer") }}',
          data: {
              note_posture: ratingValue,
              _token: '{{ csrf_token() }}'
          },
          success: function (data) {
              
              responseMessage(data);
          },
          error: function () {
          
              responseMessage('Erreur lors de l\'enregistrement.');
          }
      });
  });
});

function responseMessage(msg) {
  $('.success-box').fadeIn(200);
  $('.success-box div.text-message').html('<span>' + msg + '</span>');
}
$(document).ready(function () {
  $('#communication-stars li').on('mouseover', function () { // Utilisez #communication-stars
      var onStar = parseInt($(this).data('value'), 10);

      $(this)
          .parent()
          .children('li.star')
          .each(function (e) {
              if (e < onStar) {
                  $(this).addClass('hover');
              } else {
                  $(this).removeClass('hover');
              }
          });
  }).on('mouseout', function () {
      $(this)
          .parent()
          .children('li.star')
          .each(function (e) {
              $(this).removeClass('hover');
          });
  });

  $('#communication-stars li').on('click', function () { 
      var onStar = parseInt($(this).data('value'), 10);
      var title = $(this).attr('title');

      $('#note_communication_input').val(title); 

      var stars = $(this).parent().children('li.star');

      for (var i = 0; i < stars.length; i++) {
          $(stars[i]).removeClass('selected');
      }

      for (var i = 0; i < onStar; i++) {
          $(stars[i]).addClass('selected');
      }

      var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
      var msg = '';

     
      $.ajax({
          type: 'POST',
          url: '{{ route("remarques.enregistrer") }}',
          data: {
              note_communication: ratingValue,
              _token: '{{ csrf_token() }}'
          },
          success: function (data) {
             
              responseMessage(data);
          },
          error: function () {
              responseMessage('Erreur lors de l\'enregistrement.');
          }
      });
  });
});
