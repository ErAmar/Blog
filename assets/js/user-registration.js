$(function(){

	$('#user-registration-form').submit(function(e){
		e.preventDefault();
		$(".error-message").text("").hide();
		$.ajax({
			type:"POST",
			url:$("#user-registration-form").prop('action'),
			dataType:"json",
			data:$("#user-registration-form").serialize(),
			beforeSend:function(){
				$("#user-registration-submit").prop("disabled",true);
			},
			success:function(response){
				if(response.status == true){
					$("#resp").removeClass("animated fadeInUp alert-danger");
                    $("#resp").show().addClass("animated fadeInUp alert-success").html(response.message);
                    console.log(response.link);
                    setTimeout(function() {
                        window.location.href=response.link;
                    }, 1000);
				}
				else{
					$("#user-registration-submit").prop("disabled",false);
					$("#resp").show().addClass("animated fadeInUp alert-danger").html(response.message);
					setTimeout(function() {
                        $("#resp").fadeOut();
                    }, 2000);
				}
			},
			error:function(data){
				$("#resp").show().addClass("animated fadeInUp alert-danger").html("Internal server error");
				setTimeout(function() {
                    $("#resp").fadeOut();
                }, 5000);
				$("#user-registration-submit").prop("disabled",false);
			}
		});
	});

	
});
