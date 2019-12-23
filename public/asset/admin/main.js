$(document).ready( function() {
    tinymce.init({
        selector: '.tinyMCE'
    });

    if( $("#fileBanner").length > 0 ) {

        $("#fileBanner").change(function(e) {
            var $this = $(this);
            var val = $this.val().split("\\"); 
            // console.log($this);
            console.log(val);
            $this.siblings('label').text(val[val.length - 1]);
        })
    }

    $(".formDelete").on('submit', function() {
        return confirm("Do you want to delete this item?");
    })
})