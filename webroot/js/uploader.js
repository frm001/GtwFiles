define(function (require) {

    // Loads both modals    
    loadModals();
    function loadModals(){
        $.get("/files/add", function(data){
            $('#modal-loader').html(data);
            $.get("/files/browse", function(data2){
                $('#modal-loader').append(data2);
                modalLoaded();
            });
        });
    };
    
    // When the user choses to use an existing image, we save the NewsFileId
    // in the hidden input #NewsFileId of the parent page.
    function modalLoaded(){
        $('.fileChoice').click( function(){
            var id = $(this).next().val();
            var path = $(this).next().next().val();
            
            $('#NewsFileId').val(id);
            $('#preview').attr('src', path);
            
            $('#browseFileModal').modal('hide');
        });
    };
    
    // Function called when an image is added. id is the file id in the database
    function uploadComplete(id, path){
        $('#addFileModal').modal('hide');
        $('#NewsFileId').val(id);
        $('#preview').attr('src', path);
        loadModals();
    };
    
    // Global so it can be called outside of require.js
    window.uploadComplete = uploadComplete;
    
});