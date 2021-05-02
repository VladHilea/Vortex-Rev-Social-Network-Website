$(document).ready(function() {

	//On click signup, hide login and show registration form
	$("#signup").click(function() {
		$("#first").slideUp("slow", function(){
			$("#second").slideDown("slow");
		});
	});

	//On click signup, hide registration and show login form
	$("#signin").click(function() {
		$("#second").slideUp("slow", function(){
			$("#first").slideDown("slow");
		});
	});


});

let loginPwdStatus = false;

function changePwdView() {
  let getLoginInput = document.getElementById('loginPwdChange');

  if(loginPwdStatus === false) {

    getLoginInput.setAttribute("type", "text");
    loginPwdStatus = true;

  } else if(loginPwdStatus === true) {

    getLoginInput.setAttribute("type", "password");
    loginPwdStatus = false;

  }
}