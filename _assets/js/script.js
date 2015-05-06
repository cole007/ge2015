$(document).ready(function () {
    
  $('table').find('tr').each(function() {
    // console.log($(this).css());
    console.log($(this).attr('data-maj'));
  });
});