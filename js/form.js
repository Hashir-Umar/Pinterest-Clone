function hideLogin() {
    let login = document.querySelector('.login-top:nth-child(odd)');
    let signup = document.querySelector('.login-top:nth-child(even)');

    login.style.opacity = 0;
    signup.style.opacity = 1;
    signup.style.zIndex = "1";
    login.style.zIndex = "-1";

    document.querySelector('.loginTab span').classList.add('active');
    document.querySelector('.signupTab span').classList.remove('active');
}

function hideSignup() {
    let login = document.querySelector('.login-top:nth-child(odd)');
    let signup = document.querySelector('.login-top:nth-child(even)');

    login.style.zIndex = "1";
    signup.style.zIndex = "-1";
    login.style.opacity =1;
    signup.style.opacity = 0;

    document.querySelector('.loginTab span').classList.remove('active');
    document.querySelector('.signupTab span').classList.add('active');
}

function validateLogin() {

    let email = document.getElementById('userLoginEmail').value;

    	if(!/^.+@.+(\.[a-zA-Z]{2,3})+$/.test(email) ){
    	myAlert.pop('Email is Invalid');
    	return false;
    }

    return true;
}

function validateSignup() {

	let name = document.getElementById('userName').value;
	let email = document.getElementById('userEmail').value;


    if(/[0-9]+/.test(name)){
    	myAlert.pop("User name shouldn't contain any number");
    	return false;
    }

		if(!/^.+@.+(\.[a-zA-Z]{2,3})+$/.test(email) ){
			myAlert.pop('Email is Invalid');
    	return false;
    }

	return true;

}
