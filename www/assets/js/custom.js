//document start here
$(document).ready(function(){
  function getDoc(frame) {
   var doc = null;

   // IE8 cascading access check
   try {
       if (frame.contentWindow) {
           doc = frame.contentWindow.document;
       }
   } catch(err) {
   }

   if (doc) { // successful getting content
       return doc;
   }

   try { // simply checking may throw in ie8 under ssl or mismatched protocol
       doc = frame.contentDocument ? frame.contentDocument : frame.document;
   } catch(err) {
       // last attempt
       doc = frame.document;
   }
   return doc;
}

// update admin profile

$("#form1").submit(function(e)
{
    $('#update_profile').html('Updating...');

    var img = $('.file-footer-caption').html();
    var formObj = $(this);

    if(window.FormData !== undefined)  // for HTML5 browsers
    {

        var formData = new FormData(this);
        $.ajax({
            url: 'actions.php?profile_update=update',
            type: 'POST',
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus, jqXHR)
            {
                console.log(data);
                $('#update_profile').html('Updated');

                if((data == 'without pic')||(data == 'with pic'))
                {
                    alertify.alert('Profile Updated Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.reload();
                    });

                }
                else if(data == 'wrong format')
                {
                    alertify.error('Wrong Image Extension');
                }
                else if(data == 'password mismatch')
                {
                    alertify.error('Password Mismatch');
                }
                else if(data == 'old password wrong')
                {
                      alertify.error('Old Password Not matched');
                }
                else if(data == 'please fill all required Fields')
                {
                  alertify.error('Enter Password to Update Profile');
                }
              // $('.alert').fadeOut(3000);

              $('#form1 input').keypress(function(){
                $('#update_profile').html('Update');
              });
            },
       });
        e.preventDefault();
        e.unbind();
   }
   else  //for olden browsers
    {
        //generate a random id
        var  iframeId = 'unique' + (new Date().getTime());

        //create an empty iframe
        var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');

        //hide it
        iframe.hide();

        //set form target to iframe
        formObj.attr('target',iframeId);

        //Add iframe to body
        iframe.appendTo('body');
        iframe.load(function(e)
        {
            var doc = getDoc(iframe[0]);
            var docRoot = doc.body ? doc.body : doc.documentElement;
            var data = docRoot.innerHTML;
            //data is returned from server.

        });

    }
});
//end here
// Add Link start here
$("#add_link").submit(function(e)
{
    $('#portfolio-btn').html('Adding...');
    $('#portfolio-btn').attr('disabled','disabled');

    var img = $('.file-footer-caption').html();
    var formObj = $(this);

    if(window.FormData !== undefined)  // for HTML5 browsers
    {

        var formData = new FormData(this);
        $.ajax({
            url: 'actions.php?link_add=update',
            type: 'POST',
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus, jqXHR)
            {
                console.log(data);
                 $('#portfolio-btn').removeAttr('disabled','disabled');
                $('#portfolio-btn').html('Add');

                if(data == 'success')
                {
                    alertify.alert('Menu Added Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.href="all_links.php";
                    });

                }                
                else if(data == 'error')
                {
                      alertify.error('Unable To Add Menu');
                }
                else if(data == 'wrong extension')
                {
                      alertify.error('Please Choose Image with Jpeg/Jpg/Png/Gif Formats');
                }
                else if(data == 'All fields are required')
                {
                  alertify.error('All fields are required');
                }
                else if(data == 'Special Character Not allowed in Name Field')
                {
                  alertify.error('Special Character Not allowed in Name Field');
                }
                 else if(data == 'wrong dimension')
                {
                      alertify.error('Please Choose Images of 2560 * 750 Dimension');
                }
                else if(data == 'The file exists')
                {
                    alertify.error('File Already Exists with Same Name ');
                }
            },
       });
        e.preventDefault();
        e.unbind();
   }
   else  //for olden browsers
    {
        //generate a random id
        var  iframeId = 'unique' + (new Date().getTime());

        //create an empty iframe
        var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');

        //hide it
        iframe.hide();

        //set form target to iframe
        formObj.attr('target',iframeId);

        //Add iframe to body
        iframe.appendTo('body');
        iframe.load(function(e)
        {
            var doc = getDoc(iframe[0]);
            var docRoot = doc.body ? doc.body : doc.documentElement;
            var data = docRoot.innerHTML;
            //data is returned from server.

        });

    }
});
//end here

//update Link Start here
$("#update_link").submit(function(e)
{
    $('#portfolio-btn').html('Updating...');
    $('#portfolio-btn').attr('disabled','disabled');

    var img = $('.file-footer-caption').html();
    var formObj = $(this);
    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions.php?link_edit=update',
            type: 'POST',
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus, jqXHR)
            {
                //console.log(data);
                 $('#portfolio-btn').removeAttr('disabled','disabled');
                $('#portfolio-btn').html('Update');

                if(data == 'addedsuccessfully')
                {
                    alertify.alert('Menu Updated Successfully');
                    $('#alertify-ok').click(function(){
                    window.location.href="all_links.php";
                    });

                }
                else if(data == 'unable to add')
                {
                      alertify.error('Unable To Update Menu');
                }
                else if(data == 'wrong extension')
                {
                      alertify.error('Please Choose Image with Jpeg/Jpg/Png/Gif Formats');
                }
                else if(data == 'All fields are required')
                {
                  alertify.error('All fields are required');
                }
                else if(data == 'The file exists')
                {
                    alertify.error('File Already Exists with Same Name');
                }
            },
       });
        e.preventDefault();
        e.unbind();
   }
   else  //for olden browsers
    {
        //generate a random id
        var  iframeId = 'unique' + (new Date().getTime());

        //create an empty iframe
        var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');

        //hide it
        iframe.hide();

        //set form target to iframe
        formObj.attr('target',iframeId);

        //Add iframe to body
        iframe.appendTo('body');
        iframe.load(function(e)
        {
            var doc = getDoc(iframe[0]);
            var docRoot = doc.body ? doc.body : doc.documentElement;
            var data = docRoot.innerHTML;
            //data is returned from server.

        });

    }
});
//end here

//update Block Start here
$("#update_block").submit(function(e)
{
    $('#portfolio-btn').html('Updating...');
    $('#portfolio-btn').attr('disabled','disabled');

    var img = $('.file-footer-caption').html();
    var formObj = $(this);
    if(window.FormData !== undefined)  // for HTML5 browsers
    {

        var formData = new FormData(this);
        $.ajax({
            url: 'actions.php?block_edit=update',
            type: 'POST',
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus, jqXHR)
            {
             console.log(data);
                 $('#portfolio-btn').removeAttr('disabled','disabled');
                $('#portfolio-btn').html('Update');

                if(data == 'success')
                {
                    alertify.alert('Block Updated Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.reload();
                    });

                }
                else if(data == 'wrong extension')
                {
                    alertify.error('Please Choose Image with Jpeg/jpg/png/gif formats');
                }
                else if(data == 'error')
                {
                      alertify.error('Unable to Update');
                }
                else if(data == 'all_required')
                {
                  alertify.error('All fields are required');
                }
                 else if(data == 'The file exists')
                {
                  alertify.error('File Already Exist with Same Name');
                }
                else if(data == 'Special Character Not allowed in Name Field')
                {
                    alertify.error('Special Character Not allowed in Name Field');
                }
            },
       });
        e.preventDefault();
   }
   else  //for olden browsers
    {
        //generate a random id
        var  iframeId = 'unique' + (new Date().getTime());

        //create an empty iframe
        var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');

        //hide it
        iframe.hide();

        //set form target to iframe
        formObj.attr('target',iframeId);

        //Add iframe to body
        iframe.appendTo('body');
        iframe.load(function(e)
        {
            var doc = getDoc(iframe[0]);
            var docRoot = doc.body ? doc.body : doc.documentElement;
            var data = docRoot.innerHTML;
            //data is returned from server.

        });

    }
});
//end here

//update Block Start here
$("#submenus_form").submit(function(e)
{
    $('#portfolio-btn').html('Adding...');
    $('#portfolio-btn').attr('disabled','disabled');

    var img = $('.file-footer-caption').html();
    var formObj = $(this);
    if(window.FormData !== undefined)  // for HTML5 browsers
    {

        var formData = new FormData(this);
        $.ajax({
            url: 'actions.php?add_submenus=update',
            type: 'POST',
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus, jqXHR)
            {
                //console.log(data);
                 $('#portfolio-btn').removeAttr('disabled','disabled');
                $('#portfolio-btn').html('Add');

                if(data == 'success')
                {
                    alertify.alert('Sub Menu Updated Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.reload();
                    });

                }
                else if(data == 'wrong extension')
                {
                    alertify.error('Please Choose Image with Jpeg/jpg/png/gif formats');
                }
                else if(data == 'error')
                {
                      alertify.error('Unable to Update');
                }
                else if(data == 'all_required')
                {
                  alertify.error('All fields are required');
                }
                 else if(data == 'The file exists')
                {
                  alertify.error('File Already Exist with Same Name');
                }
                else if(data == 'Special Character Not allowed in Name Field')
                {
                    alertify.error('Special Character Not allowed in Name Field');
                }
            },
       });
        e.preventDefault();
   }
   else  //for olden browsers
    {
        //generate a random id
        var  iframeId = 'unique' + (new Date().getTime());

        //create an empty iframe
        var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');

        //hide it
        iframe.hide();

        //set form target to iframe
        formObj.attr('target',iframeId);

        //Add iframe to body
        iframe.appendTo('body');
        iframe.load(function(e)
        {
            var doc = getDoc(iframe[0]);
            var docRoot = doc.body ? doc.body : doc.documentElement;
            var data = docRoot.innerHTML;
            //data is returned from server.

        });

    }
});
//end here


//update sub menu Start here
$("#update_sub_menus").submit(function(e)
{
    $('#portfolio-btn').html('Updating...');
    $('#portfolio-btn').attr('disabled','disabled');
    var formObj = $(this);
    if(window.FormData !== undefined)  // for HTML5 browsers
    {

        var formData = new FormData(this);
        $.ajax({
            url: 'actions.php?edit_submenus=update',
            type: 'POST',
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus, jqXHR)
            {
               // console.log(data);
                 $('#portfolio-btn').removeAttr('disabled','disabled');
                $('#portfolio-btn').html('Update');

                if(data == 'success')
                {
                    alertify.alert('Sub Menu Updated Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.reload();
                    });

                }
                else if(data == 'wrong extension')
                {
                    alertify.error('Please Choose Image with Jpeg/jpg/png/gif formats');
                }
                else if(data == 'error')
                {
                      alertify.error('Unable to Update');
                }
                else if(data == 'all_required')
                {
                  alertify.error('All fields are required');
                }
            },
       });
        e.preventDefault();
   }
   else  //for olden browsers
    {
        //generate a random id
        var  iframeId = 'unique' + (new Date().getTime());

        //create an empty iframe
        var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');

        //hide it
        iframe.hide();

        //set form target to iframe
        formObj.attr('target',iframeId);

        //Add iframe to body
        iframe.appendTo('body');
        iframe.load(function(e)
        {
            var doc = getDoc(iframe[0]);
            var docRoot = doc.body ? doc.body : doc.documentElement;
            var data = docRoot.innerHTML;
            //data is returned from server.

        });

    }
});
//end here

});
//end here
