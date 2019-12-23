$(document).ready( function() {
    if( $(".fileUpload").length > 0 ) {

        $(".fileUpload").change(function(e) {
            var $this = $(this);
            var val = $this.val().split("\\"); 
            // console.log($this);
            console.log(val);
            $this.siblings('label').text(val[val.length - 1]);
        })
    }
})