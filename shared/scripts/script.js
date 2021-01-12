$(function () {
    //ajax form
    $("form:not('.ajax_off')").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        let load = $(".ajax_load");
        let flash = $(".ajax_response");
        let modal = $(".ajax_response_modal")

        form.ajaxSubmit({
            url: form.attr("action"),
            type: "POST",
            dataType: "json",
            beforeSend: function () {
                load.fadeIn(200).css("display", "flex");
            },
            success: function (response) {
                //redirect
                if (response.redirect) {
                    window.location.href = response.redirect;
                }else{
                    load.fadeOut(200);
                }

                //reload
                if (response.reload) {
                    window.location.reload();
                } else {
                    load.fadeOut(200);
                }
                //message
                if (response.message) {
                    M.toast({
                        html: renderHtmlToast(response.message.text),
                        classes: response.message.classes,
                        displayLength: 5000
                    });
                }
            },
            complete: function () {
                if (form.data("reset") === true) {
                    form.trigger("reset");
                }
            }
        });
    });
});

/////////////// RENDER THE TOAST MESSAGE ///////////////
function renderHtmlToast(text){
    return `${text} 
            <button onclick="M.Toast.getInstance(this.parentElement).dismiss();" class="btn-flat toast-action">
                <i id="dismiss-toast" class="material-icons white-text">close
            </button>`;
}

/////////////// SHOWS THE FLASH MESSAGE ///////////////
function flash(response){
    if(response){
        M.toast({
            html: renderHtmlToast(response.message.text),
            classes: response.message.classes,
            displayLength: 5000
        });
    }
}