require(['jquery','basepath'], function ($, basepath) {
    
    $('.upload').click(function(){
        $('.upload').button('loading');
        var callback = $(this).attr('data-upload-callback');
        $.get( basepath+"gtw_files/files/add/"+callback, function(data){
            $('#modal-loader').html(data);
            $('#file-modal').modal('show');
            $('.upload').button('reset');
        });
    });
    
    // Function called when an image is added. id is the file id in the database
    function uploadComplete(id, path, callbackModule){
        $('#file-modal').modal('hide');
        require([callbackModule], function(callback){
            callback(id, path);
        });
    };
    
    // Global so it can be called outside of require.js
    window.uploadComplete = uploadComplete;
});