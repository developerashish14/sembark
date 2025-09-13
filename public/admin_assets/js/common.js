//secound parameter check custom  result create -- 
async function commonAjax(form,customResult){
    var frm = $(form);
    var frm_id = frm.attr('id');
    //model id name and form id name same then form id close model
    var form_result_div = $(frm).find('#form-result');                                   // result show id  and error message show this id
    if(!frm_id || $(frm).find(form_result_div).length<1){                  //form id name and frm result id define (it is for developer alert )  
        alert('frm id and result id  not define');
        return;
    }else{
        var table_id = frm_id.split("-")[0];
    }
    var form_btn = $(frm).find('button[type="submit"]');            // button path check
    var form_btn_name = form_btn.html();                              // get button name then assign button old name again
    $(form_btn).html("Please Wait...").attr('disabled','disabled');   //button disable
    frm.find('.border-danger').removeClass('border-danger');         //remove input border error
    frm.find('.invalid-feedback').remove();                           //remove input field border
    //$('#toast-erromsg').html(null).hide();
    //$('.preloader').show();
    //--------
    await $.ajax({
        url: frm.attr('action'),
        data:  new FormData(form),
        type: 'post',
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        success: function(result){
            $(form_btn).html(form_btn_name).removeAttr("disabled");             //button enable
            if(result.success == true){
                if(customResult === null || customResult == undefined  || customResult <=0){

                   

                    if(result.rlink){                                               //page redirect and reload
                        window.location.href = result.rlink;
                    }else if(result.alert){  
                        $(form_result_div).addClass('alert alert-primary').html(result.alert).fadeIn('slow');
                        setTimeout(function(){ 
                            $(form_result_div).empty().removeClass();
                            $('#'+frm_id).modal('hide');                     //if model exit then close 2 secound
                         }, 2000);
                    }else if(result.alert1){                                //show message table message like table common message
                        frm[0].reset(); 
                        frm.find('img').remove();  
                        $('#'+frm_id).modal('hide');                     //if model exit then close 
                      
                        $('#'+table_id+'-message').addClass('alert alert-primary').html(result.alert1)
                        setTimeout(function(){ $('#'+table_id+'-message').empty().removeClass() }, 5000);
                    
                    }else{
                        location.reload();
                    }


                    if (frm.hasClass('resetAfterSubmit')) {
                        frm[0].reset(); 
                        frm.find('img').remove();  
                    }
                    if (frm.hasClass('closeModalAfterSubmit')) {
                        setTimeout(function(){
                            $('.modal, .modal-backdrop').fadeOut().remove();
                        }, 2000);
                    }
                    // if (typeof eval(table_id) !== "undefined"){  //table id name use as data table variable(reference variable)
                       
                    //     // var datatable = eval(table_id);
                        
                    //     eval(table_id).ajax.reload();  //datatable reload
                    // }
                }else{
                    customResult(result);
                }
            }
            else{
                $.each(result.message, function(key,value){
                    var inpt = frm.find('input[name='+key+'], textarea[name='+key+'], select[name='+key+']');
                    //if(value.length > 2){   //show input box error with message 
                        if(result.border == true){
                            inpt.addClass('border-danger is-invalid').after('<span id="bsValidation1-error" class="error invalid-feedback">'+value+'</span>');
                        }else{ // if border false then show only single error form bottom
                            $(form_result_div).addClass('alert alert-danger').html(result.message.refrence).fadeIn('slow');
                            setTimeout(function(){ $(form_result_div).empty().removeClass(); }, 6000);
                        }
                    //}
                });
                // setTimeout(function(){
                //     $('#toast-erromsg').fadeOut(600)
                // }, 3500);
            }
            $('.preloader').hide();
        }
    });
    return true;         //then function need return 
}

function isEmpty(val){
    return (val === undefined || val == null || val.length <= 0) ? false : true;
}

function filereader(file){
    var reader = new FileReader();
    var img = document.createElement("img");
    reader.onloadend = function() {
        img.style="padding:4px";
        img.width = 100;
        img.height = 100;
        img.src = reader.result;
        
    }
    reader.readAsDataURL(file)
    return img;
};



function image_preview(e,id){
    $("#"+id).empty()
    for (var i = 0; i < e.srcElement.files.length; i++) {
        var file = e.srcElement.files[i];
        var img =  filereader(file);
        $("#"+id).append(img);
    }
}




    /*
     * --------------------------
     * Set up all our required plugins
     * --------------------------
     */
    window.onload = function () {
        

        $(document.body).on('click', '.loadModal, [data-invoke~=modal]', function (e) {

            var alertmessage = $(this).data('alertmessage');
            if(alertmessage){
                if (!confirm(alertmessage)) {
                    return;
                }
            }
            
            var loadUrl = $(this).data('href'),
                cacheResult = $(this).data('cache') === 'on',
                $button = $(this);
    
            $('#'+modal_id).remove();
            // $('.modal-backdrop').remove();
            // $('html').addClass('working');
            var modal_id = $(this).data('modal-id');
            $.ajax({
                url: loadUrl,
                data: {},
                localCache: cacheResult,
                dataType: 'html',
                success: function (data) {
                    
                    $('body').append(data);
    
                    var $modal = $('#'+modal_id);
                    // $modal.modal({
                    //     'backdrop': 'static',
                    // });
    
                    $modal.modal('show');
    
                    $modal.on('hidden.bs.modal', function (e) {
                        // window
                        location.hash = '';
                    });
                    $('html').removeClass('working');
    
                }
            }).done().fail(function (data) {
                alert('Something went wrong!');
                // $('html').removeClass('working');
                // showMessage(lang("whoops_and_error", {"code": data.status, "error": data.statusText}));
            });
    
            e.preventDefault();
        });
    };

    
