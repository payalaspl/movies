 import $ from 'jquery';
var $country = $('#users_country');
var $password = $('#users_password_first');
var $token = $('#users__token');
$country.change(function() {
 
  var $form = $(this).closest('form');
 
  var data = {};
  data[$country.attr('name')] = $country.val();
  data[$password.attr('name')] = $password.val();
  data[$token.attr('name')] = $token.val();
  console.log(data);

  $.ajax({
    url : $form.attr('action'),
    type: $form.attr('method'),
    data : data,
    success: function(html) {
    	console.log(html);
      
      $('#users_state').replaceWith(
        
        $(html).find('#users_state')
      );
      
    },
    // error:function(xhr){
    //                     console.log(xhr.responseText);
    //               }
  });
});
