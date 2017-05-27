
  jQuery(document).ready(function(){
    jQuery('.open-share-window').on( 'click', function(e) {
        e.preventDefault();
        window.open(jQuery(this).attr('href'), 'share_window', 'left=20, top=20, width=500, height=500, toolbar=1, resizable=0');
        return false;
    });
  });