$( document ).ready(function(){

	////////////// image uploader //////////////

	var flag = false;
	$('.username span').click(function() {
		if (flag == false) {
			$('.drop-menu').css('opacity', 1);
			flag = true;
		} else if (flag == true){
			$('.drop-menu').css('opacity', 0);
			flag = false;
		}
	});


	/////////////////  POP  ///////////////////

	$("#show").click(function(){
		$('.drop-menu').css('opacity', 0);
		$("#wrapper").show();
		$(".main").show();
		$("#close").show();
		$("#error").html('');
	    $('input[type="submit"]').removeAttr('disabled');
	    $('body').css('overflow', 'hidden');

	});

	///////////////////////////////////////////


	/////////////////  Close  /////////////////

	var tag = document.getElementById('close');

	$("#wrapper").click(function(event){

		if (event.target == tag) {
	        $("#wrapper").hide();
	        $('body').css('overflow-y', 'auto');

			flag = false;

	       let locat = window.location;

	       if (/home/.test(locat))
	       		showPublicImages();
	       else
	       		showPrivateImages();
		}

	});

	///////////////////////////////////////////

	$("#file").click(function(){
		$("#error").html('');
	    $('input[type="submit"]').removeAttr('disabled');

	});

	$('form').submit(function (e) {
	    let data = new FormData($(this)[0]);
		$.ajax({
			url: "site/validationImage.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				$('#wrapper').show();
				$("#error").html(data);
				$("input[type=submit]").attr("disabled", "disabled");

			},
            error: function(data){
                alert(data);
            }
		});

		e.preventDefault();

	});

	////////////////////////////////////////////
});
