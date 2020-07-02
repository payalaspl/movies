/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';
// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
import $ from 'jquery';
import 'bootstrap';


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