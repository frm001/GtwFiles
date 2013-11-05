require(['jquery'], function ($) {
    
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });
    
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        $('#filename').val(label);
        $(this).closest('form').find("input[type='submit']").prop('disabled', false);
    });
   
});