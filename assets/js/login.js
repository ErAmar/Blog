$(function(){
	
    $("#login-form-id").submit(function(e){
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:$("#login-form-id").prop('action'),
            dataType:"json",
            data:$("#login-form-id").serialize(),
            beforeSend:function(){
                $("#login-submit-id").prop("disabled",true);
            },
            success:function(response){
                if(response.status == true) {
                    $("#login_resp").removeClass("animated fadeInUp alert-danger d-none");
                    $("#login_resp").show().addClass("animated fadeInUp alert-success").html(response.message);
                    setTimeout(function() {
                        window.location.href = response.link
                    }, 1000);
                }
                else {
                    $("#login_resp").removeClass('d-none').addClass("animated fadeInUp alert-danger").html(response.message).fadeIn();
                    setTimeout(function() {
                        $("#login_resp").fadeOut();
                    }, 1000);
                }
                $("#login-submit-id").prop("disabled",false);
            },
            error:function(data){
                $("#login_resp").removeClass('d-none').addClass("animated fadeInUp alert-danger").html('Internal server error please try again after some time');
                setTimeout(function() {
                    $("#login_resp").fadeOut();
                }, 3000);
                $("#login-submit-id").prop("disabled",false);
            }
        });
        return false; 
    });

});
