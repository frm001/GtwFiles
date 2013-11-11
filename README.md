# File management for CakePHP

PLUGIN AND DOC UNDER DEVELOPMENT

This plugin wraps the nasty iframe-upload process into a clean and reusable interface. The result is 
a file upload that looks clean to the users, and is also clean code-wise.

## Installation

This plugin depends on GtwUi, BoostCake and Needs some auth enabled. //TODO remove gtw_users dependency

Copy this plugin in a folder named `app/Plugin/GtwFiles`
    
Create a symlink from this plugin's webroot to the application webroot by running `Console/cake symlink` or the lines below

    # On windows
    mklink /J app\webroot\GtwFiles app\Plugin\GtwFiles\webroot

    # On linux
    ln -s app/Plugin/GtwFiles/webroot app/webroot/GtwFiles

Load the plugin by adding this line to `app/Config/bootstrap.php`

    CakePlugin::load('GtwFiles');
    
Load this plugin's less file in your own theme file using this line:

    @import "../GtwFiles/less/files.less";
    
## Adding file upload function to one of your existing page

At this time, AJAX upload is still not widely supported. The best we have to mimic an ajax upload is using 
Iframe to upload files, and using the response to load a global javascript function from inside the 
iframe. ([More here](http://www.ajaxf1.com/tutorial/ajax-file-upload-tutorial.html)). 
This plugin is meant to simplify this nasty process.


### Step 1: Load the filepicker module by adding these lines at the top of  your file

    <?php 
        $this->Helpers->load('GtwRequire.GtwRequire');
        echo $this->GtwRequire->req('files/filepicker');
    ?>

### Step 2: Create a javascript callback module

After the upload, this module will trigger a javascript callback of your choice. This callback will
recieve the file id and path of the file as parameters.. You can use that callback to trigger an alert
or to update anything you want via an AJAX call. 
[Here is an example](https://github.com/Phillaf/GtwFiles/blob/master/webroot/js/default.js)


### Step 3: Add placeholders to your existing page

Add these two lines to somewhere in the page

    <div id="upload-alert"></div>
    <div id="modal-loader"></div>
    
### Step 4: Add the add file button to your page
    
You can add this button anywhere in your page. The upload class inform this plugin that it needs to
trigger the add modal. the data-upload-callback attribute defines which js module is called upon 
upload completion

    <button type="button" class="btn upload" data-loading-text="Loading..." data-upload-callback="files/default">Upload file</button>

## Copyright and license   
Author: Philippe Lafrance   
Copyright 2013 [Gintonic Web](http://gintonicweb.com)  
Licensed under the [Apache 2.0 license](http://www.apache.org/licenses/LICENSE-2.0.html)
