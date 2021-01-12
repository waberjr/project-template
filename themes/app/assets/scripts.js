$(function(){$("form:not('.ajax_off')").submit(function(e){e.preventDefault();let form=$(this);let load=$(".ajax_load");let flash=$(".ajax_response");let modal=$(".ajax_response_modal")
form.ajaxSubmit({url:form.attr("action"),type:"POST",dataType:"json",beforeSend:function(){load.fadeIn(200).css("display","flex")},success:function(response){if(response.redirect){window.location.href=response.redirect}else{load.fadeOut(200)}
if(response.reload){window.location.reload()}else{load.fadeOut(200)}
if(response.message){M.toast({html:renderHtmlToast(response.message.text),classes:response.message.classes,displayLength:5000})}},complete:function(){if(form.data("reset")===!0){form.trigger("reset")}}})})});function renderHtmlToast(text){return `${text} 
            <button onclick="M.Toast.getInstance(this.parentElement).dismiss();" class="btn-flat toast-action">
                <i id="dismiss-toast" class="material-icons white-text">close
            </button>`}
function flash(response){if(response){M.toast({html:renderHtmlToast(response.message.text),classes:response.message.classes,displayLength:5000})}}