jQuery(document).ready(function($) {
   jQuery(".loaderpost").slice(0, 1).show(); // select the first ten
    jQuery("#load").click(function(e){ // click event for load more
        e.preventDefault();
        jQuery(".loaderpost:hidden").slice(0, 1).show(); // select next 10 hidden divs and show them
        if(jQuery(".loaderpost:hidden").length == 0){ // check if any hidden divs still exist
          jQuery(this).html('No more posts');//  alert("No more loaderpost"); // alert if there are none left
        }
    });
});