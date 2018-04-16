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

// Add Blog Start Here
$("#add_blog").submit(function(e)
{
    $('#add_blogs').html('Adding...');
    $('#add_blogs').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions2.php?sadd_blog=add',
            type: 'POST',
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus, jqXHR)
            {
             console.log(data);
                 $('#add_blogs').removeAttr('disabled','disabled');
                $('#add_blogs').html('Add');
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('Blog Added Successfully');
                    $('#alertify-ok').click(function(){
                    window.location.href="view_blogs.php";
                    });

                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Add Blog');
                }
                else if(data == 'empty')
                {
                    alertify.error('Fill all Fields');
                }
                else if(data == 'choose image')
                {
                      alertify.error('Choose Image');
                }
                 else if(data == 'wrong extension')
                {
                      alertify.error('Please Choose Images with Jpg/Jpeg/Gif/PNG Extension');
                }
              // $('.alert').fadeOut(3000);

          
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
// Add Blog End Here


// Blog Update Start Here
$("#edit_blog").submit(function(e)
{
    $('#portfolio-btn').html('Updating...');
    $('#portfolio-btn').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions2.php?blog_edit=add',
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
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('Blog Updated Successfully');
                    $('#alertify-ok').click(function(){
                       window.location.href="view_blogs.php";
                    });

                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Update Blog');
                }
                else if(data == 'all required')
                {
                    alertify.error('Fill all Fields');
                }
                else if(data == 'wrong extension')
                {
                      alertify.error('Please Choose Images with Jpg/Jpeg/Gif/PNG Extension');
                }
                
              // $('.alert').fadeOut(3000);

          
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
// Blog Update End Here 


// Edit Home Icons Start Here 
$("#edit_icons").submit(function(e)
{
    $('#portfolio-btn').html('Updating...');
    $('#portfolio-btn').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions2.php?icon_edit=edit',
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
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('Home Icon Updated Successfully');
                    $('#alertify-ok').click(function(){
                    window.location.href="all_icons.php";
                    });

                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Update Icon');
                }
                else if(data == 'all required')
                {
                    alertify.error('Fill all Fields');
                }
                else if(data == 'wrong extension')
                {
                      alertify.error('Please Choose Images with Jpg/Jpeg/Gif/PNG Extension');
                }
                
              // $('.alert').fadeOut(3000);

          
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
// Edit Home Icons End Here 

// About Us Update Start Here 
$("#update_about").submit(function(e)
{
    $('#portfolio-btn').html('Updating...');
    $('#portfolio-btn').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions2.php?about_edit=edit',
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
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('Description Updated Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.reload();
                    });

                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Update Description');
                }
                else if(data == 'all_required')
                {
                    alertify.error('Fill all Fields');
                }
                else if(data == 'wrong1')
                {
                    alertify.error('Please Choose Images with Jpg/Jpeg/Gif/PNG Extension');
                }
                else if(data == 'wrong dimension')
                {
                    alertify.error('Please Choose Images of 2560*750 Dimension');
                }  
                else if(data == 'wrong2')
                {
                    alertify.error('Please Choose Images with Jpg/Jpeg/Gif/PNG Extension');
                }                
              // $('.alert').fadeOut(3000);
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
// About Us Data End Here 


// Newsletter Start Here
$("#newsletter").submit(function(e)
{
    $('#portfolio-btn').html('Subscribing...');
    $('#portfolio-btn').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'admin/actions2.php?subscribe=add',
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
                $('#portfolio-btn').html('Subscribe');
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('Thanks For Subscribing');
                    $('#alertify-ok').click(function(){
                    $('#newsletter')[0].reset();
                    });
                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Subscribe');
                }
                else if(data == 'empty')
                {
                    alertify.error('Fill all Fields');
                }
                else if(data == 'already')
                {
                 alertify.alert('You are Already Subscribed');
                    $('#alertify-ok').click(function(){
                    $('#newsletter')[0].reset();
                    });
                }
               
                
              // $('.alert').fadeOut(3000);

          
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
// Newsletter End Here

//badge working goes here
$('.badge-work20').click(function(){
url = $(this).data('id');
var num = $('.number').html();
$.ajax({
    url: url,
    success: function(data, textStatus, jqXHR)
    {
      data = data.trim();
      if(data =='ok')
      {
        var next = num= num-1;
        if(next=='0')
        {
          $('.number').remove();
        }
        else {
            $('.number').html(next);
        }
      }
    },
});
});

//end here

// Edit Logo Start Here 
$("#edit_logo").submit(function(e)
{
    $('#portfolio-btn').html('Updating...');
    $('#portfolio-btn').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions2.php?logo_edit=edit',
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
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('Logo Updated Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.reload();
                    });

                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Update Logo');
                }
                else if(data == 'all required')
                {
                    alertify.error('Fill all Fields');
                }
                else if(data == 'wrong extension')
                {
                      alertify.error('Please Choose Images with Jpg/Jpeg/Gif/PNG Extension');
                }
                
              // $('.alert').fadeOut(3000);

          
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
// Edit Logo End Here 

//badge working goes here
$('.badge-work').click(function(){
url = $(this).data('id');
var num = $('.number2').html();
$.ajax({
    url: url,
    success: function(data, textStatus, jqXHR)
    {
      data = data.trim();
      if(data =='ok')
      {
        var next = num= num-1;
        if(next=='0')
        {
          $('.number2').remove();
        }
        else {
            $('.number2').html(next);
        }
      }
    },
});
});

//end here
// Contact Us Start Here
$("#contact").submit(function(e)
{
    $('#portfolio-btn').html('Sending...');
    $('#portfolio-btn').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'admin/actions2.php?contact=add',
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
                $('#portfolio-btn').html('Send');
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('Your Query Has Been Submitted');
                    $('#alertify-ok').click(function(){
                    $('#contact')[0].reset();
                    });
                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Submit');
                }
                else if(data == 'empty')
                {
                    alertify.error('Fill all Fields');
                }
            
               
                
              // $('.alert').fadeOut(3000);

          
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
// Contact End Here

// Contact Info Update Start Here 
$("#update_contact").submit(function(e)
{
    $('#portfolio-btn').html('Updating...');
    $('#portfolio-btn').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions2.php?contact_edit=change',
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
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('Address Updated Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.reload();
                    });

                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Update Address');
                }
                else if(data == 'all_required')
                {
                    alertify.error('Fill all Fields');
                }              
              // $('.alert').fadeOut(3000);
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
// Contact Info Update Data End Here 
// Delete Pic From Edit Platforms  Start Here 
  $(document).on('click','.cross-hover1',function(){

  // $('.cross-hover1').click(function(){
  $(this).css('display','none');
  $(this).prev().css("cssText", "display: none !important;");
  var pid1=$(this).data('pid1');
  var pg1=$('#pg1').val();
  $.ajax({
           url: 'actions2.php?delpic1=el_del1&pid1='+pid1+'&pg1='+pg1,
           success: function(data){
            data=data.trim();
            //console.log(data);
           if(data=="success")
           {  
             
                    alertify.alert('Logo Deleted Successfully');
                    $('#alertify-ok').click(function(){
                      $('.file-upload-div1').load(window.location+' .file-upload-div1');
                    });
               //location.reload();
           }
               else if(data == 'error')
                {
                    alertify.error('Unable to Delete');
                }
           },
           async: true,
           cache: false,
           contentType: false,
           processData: false
       });
 });
  // Delete Pic From Edit Platform  End Here
  // Platforms Update Start Here 
$("#edit_platform").submit(function(e)
{
    $('#portfolio-btn').html('Updating...');
    $('#portfolio-btn').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions2.php?platform_edit=change',
            type: 'POST',
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            async:true,
            success: function(data, textStatus, jqXHR)
            {
                //console.log(data);
                 $('#portfolio-btn').removeAttr('disabled','disabled');
                $('#portfolio-btn').html('Update');
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('PlatForm Updated Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.reload();
                    });

                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Update PlatForm');
                }
                else if(data == 'all_required')
                {
                    alertify.error('Fill all Fields');
                }  
                else if(data == 'wrong extension')
                {
                    alertify.error('Please Choose Images with Jpg/Jpeg/Gif/PNG Extension');
                }              
              // $('.alert').fadeOut(3000);
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
// Platform  Update Data End Here 
// Add Team Profile Start Here
$("#team").submit(function(e)
{
    $('#portfolio-btn').html('Adding...');
    $('#portfolio-btn').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions2.php?addteam=add',
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
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('Team Profile Added Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.href="viewteams.php"; 
                    });

                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Add Team Profile');
                }
                else if(data == 'empty')
                {
                    alertify.error('Fill all Fields');
                }
                else if(data == 'choose image')
                {
                      alertify.error('Choose Profile Image');
                }
                 else if(data == 'wrong extension')
                {
                      alertify.error('Please Choose Images with Jpg/Jpeg/Gif/PNG Extension');
                }
                
              // $('.alert').fadeOut(3000);

          
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
// Add Team profile End Here
// Team Update Start Here
$("#edit_team").submit(function(e)
{
    $('#portfolio-btn').html('Updating...');
    $('#portfolio-btn').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions2.php?team_edit=add',
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
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('Team Profile Updated Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.href="viewteams.php"; 
                    });

                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Update Profile');
                }
                else if(data == 'all required')
                {
                    alertify.error('Fill all Fields');
                }
                else if(data == 'wrong extension')
                {
                      alertify.error('Please Choose Images with Jpg/Jpeg/Gif/PNG Extension');
                }
                
              // $('.alert').fadeOut(3000);

          
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
// Team Update End Here 

// Add Testimonial Start Here
$("#test").submit(function(e)
{
    $('#portfolio-btn').html('Adding...');
    $('#portfolio-btn').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions2.php?addtest=add',
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
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('Testimonial Added Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.href="view_test.php"; 
                    });

                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Add Testimonial');
                }
                else if(data == 'empty')
                {
                    alertify.error('Fill all Fields');
                }
                else if(data == 'choose image')
                {
                      alertify.error('Choose Image');
                }
                 else if(data == 'wrong extension')
                {
                      alertify.error('Please Choose Images with Jpg/Jpeg/Gif/PNG Extension');
                }
                
              // $('.alert').fadeOut(3000);

          
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
// Add Testimonial End Here
// Testimonial Update Start Here
$("#edit_test").submit(function(e)
{
    $('#portfolio-btn').html('Updating...');
    $('#portfolio-btn').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions2.php?test_edit=add',
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
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('Testimonial Updated Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.href="view_test.php"; 
                    });

                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Update Testimonial');
                }
                else if(data == 'all required')
                {
                    alertify.error('Fill all Fields');
                }
                else if(data == 'wrong extension')
                {
                      alertify.error('Please Choose Images with Jpg/Jpeg/Gif/PNG Extension');
                }
                
              // $('.alert').fadeOut(3000);

          
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
// Testimonial Update End Here 
// Add Portfolio Start Here
$("#add_portfolio").submit(function(e)
{
    $('#portfolio-btn').html('Adding...');
    $('#portfolio-btn').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions2.php?addport=add',
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
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('PortFolio Added Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.href="viewportfolio.php"; 
                    });

                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Add PortFolio');
                }
                else if(data == 'empty')
                {
                    alertify.error('Fill all Fields');
                }
                else if(data == 'choose image')
                {
                      alertify.error('Choose PortFolio Image');
                }
                 else if(data == 'wrong extension')
                {
                      alertify.error('Please Choose Images with Jpg/Jpeg/Gif/PNG Extension');
                }
                
              // $('.alert').fadeOut(3000);

          
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
// Add PortFolio End Here
// PortFolio Update Start Here
$("#update_portfolio").submit(function(e)
{
    $('#portfolio-btn').html('Updating...');
    $('#portfolio-btn').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions2.php?port_edit=add',
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
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('PortFolio Updated Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.href="viewportfolio.php"; 
                    });

                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Update PortFolio');
                }
                else if(data == 'all required')
                {
                    alertify.error('Fill all Fields');
                }
                else if(data == 'wrong extension')
                {
                      alertify.error('Please Choose Images with Jpg/Jpeg/Gif/PNG Extension');
                }
                
              // $('.alert').fadeOut(3000);

          
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
// PortFolio Update End Here 

// Add Slide Start Here
$("#add_slider").submit(function(e)
{
    $('#portfolio-btn').html('Adding...');
    $('#portfolio-btn').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions2.php?slideradd=add',
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
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('Slider Added Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.href="viewslider.php"; 
                    });

                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Add Slider');
                }
                else if(data == 'empty')
                {
                    alertify.error('Fill all Fields');
                }
                else if(data == 'choose image')
                {
                      alertify.error('Choose Slider Image');
                }
                 else if(data == 'wrong extension')
                {
                      alertify.error('Please Choose Images with Jpg/Jpeg/Gif/PNG Extension');
                }
                
              // $('.alert').fadeOut(3000);

          
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
// Add Slider End Here

// Slider Update Start Here
$("#update_slider").submit(function(e)
{
    $('#portfolio-btn').html('Updating...');
    $('#portfolio-btn').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions2.php?slider_edit=add',
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
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('Sldier Updated Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.href="viewslider.php"; 
                    });

                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Update Slider');
                }
                else if(data == 'all required')
                {
                    alertify.error('Fill all Fields');
                }
                else if(data == 'wrong extension')
                {
                      alertify.error('Please Choose Images with Jpg/Jpeg/Gif/PNG Extension');
                }
                
              // $('.alert').fadeOut(3000);

          
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
// Slider Update End Here


// Add Blog Start Here
$("#add_events").submit(function(e)
{
    $('#portfolio-btn').html('Adding...');
    $('#portfolio-btn').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions2.php?eventadd=add',
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
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('Event Added Successfully');
                    $('#alertify-ok').click(function(){
                    window.location.href="view_events.php";
                    });

                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Add Event');
                }
                else if(data == 'empty')
                {
                    alertify.error('Fill all Fields');
                }
                else if(data == 'choose image')
                {
                      alertify.error('Choose Image');
                }
                 else if(data == 'wrong extension')
                {
                      alertify.error('Please Choose Images with Jpg/Jpeg/Gif/PNG Extension');
                }
              // $('.alert').fadeOut(3000);

          
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
// Add Event End Here

// Event Update Start Here
$("#update_event").submit(function(e)
{
    $('#portfolio-btn').html('Updating...');
    $('#portfolio-btn').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions2.php?event_edit=add',
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
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('Event Updated Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.href="view_events.php"; 
                    });

                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Update Event');
                }
                else if(data == 'all required')
                {
                    alertify.error('Fill all Fields');
                }
                else if(data == 'wrong extension')
                {
                      alertify.error('Please Choose Images with Jpg/Jpeg/Gif/PNG Extension');
                }
                
              // $('.alert').fadeOut(3000);

          
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
// Event Update End Here 

// Social Link Update Start Here
$("#update_social").submit(function(e)
{
    $('#edit').html('Updating...');
    $('#edit').attr('disabled','disabled');

    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'actions2.php?link_edit=add',
            type: 'POST',
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus, jqXHR)
            {
                 // console.log(data);
                 $('#edit').removeAttr('disabled','disabled');
                $('#edit').html('Update');
                data=data.trim();
               if(data == 'success')
                {
                    alertify.alert('Social Links Updated Successfully');
                    $('#alertify-ok').click(function(){
                      window.location.reload();
                    });

                }
                else if(data == 'error')
                {
                    alertify.error('Unable to Update Social Links');
                }
                else if(data == 'all required')
                {
                    alertify.error('Fill all Fields');
                }
         
                
              // $('.alert').fadeOut(3000);

          
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
// Social Link Update End Here 

});
//Document Ready Function End Here 

