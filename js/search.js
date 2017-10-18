function search(){
	var words = document.querySelector('.search').value;

	let loc = window.location.href;

	if (/home/.test(loc))
		loc = 'public';
	else
		loc = 'private';

	if (/[^a-zA-Z0-9]+/.test(words) && /[^-,.]+/.test(words))
		 words = document.querySelector('.search').value = '';

	if (words == '')
	{
		if (loc == 'public')	showPublicImages();
		else	showPrivateImages();
	}
	else
	{
		$.ajax({
			url: "site/search.php", // Url to which the request is send
			type: 'GET',
			data: {'word':words,
					'url':loc},
			contentType: false,       // The content type used when sending data to the server.
			success: function(data)   // A function to be called if request succeeds
			{
				$(".content").html(data);
			}
		});
	}

}

function isEmpty(){
	var words = document.querySelector('.search').value;

	let loc = window.location.href;

	if (/home/.test(loc))
		loc = 'public';
	else
		loc = 'private';

	if (words == '')
	{
		if (loc == 'public')	showPublicImages();
		else	showPrivateImages();
	}
}

$(document).ready(function()
{
	////////////////  Search   //////////////////
	$('.searchIcon').click(search);
	$('.search').keyup(isEmpty);
	////////////////////////////////////////////



});
