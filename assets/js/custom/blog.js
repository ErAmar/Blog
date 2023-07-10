$(function(){

	$('#create-blog-form').submit(function(e){
		e.preventDefault();
		$(".error-message").text("").hide();
		$.ajax({
            type:"POST",
            url:$("#create-blog-form").prop('action'),
            dataType:"json",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
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
                    }, 3000);
				}
				else{
					$.each(response.data, function(k, v) {
					    $("#"+k).text(v).show();
					});
					$("#user-registration-submit").prop("disabled",false);
					$("#resp").show().addClass("animated fadeInUp alert-danger").html(response.message);
					setTimeout(function() {
                        $("#resp").fadeOut();
                    }, 5000);
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
