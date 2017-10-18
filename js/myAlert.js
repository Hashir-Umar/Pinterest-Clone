function myAlert() {

	window.addEventListener('resize', function(){
		let back = document.querySelector('.overlay');
		back.style.height = window.innerHeight+'px';
		back.style.width = window.innerWidth+'px';

		document.querySelector('.myAlertBox').style.top = (window.innerHeight / 2) - 100 +'px';

	});

	this.pop = function(messege) {

		let back = document.querySelector('.overlay');
		back.style.height = window.innerHeight+'px';
		back.style.width = window.innerWidth+'px';

		back.style.display = 'block';

		let box = document.querySelector('.myAlertBox');
		box.style.top = (window.innerHeight / 2) - 100 +'px';
		box.classList.add("animate");

		let msg = document.querySelector('.msg');
		msg.innerHTML = messege;

		document.querySelector('html').style.overflowY = 'hidden';
	}

	this.ok = function(page) {

		document.querySelector('html').style.overflowY = 'auto';

		document.querySelector('.myAlertBox').remove("animate");

		let back = document.querySelector('.overlay');
		back.style.display = 'none';

		window.location = page;
	}

}

var myAlert = new myAlert;
