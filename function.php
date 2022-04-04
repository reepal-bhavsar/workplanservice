<script>
	var apiUrl = '<?php echo APIURL;?>';

	/*Start: Validation for Sign-in*/
	function validateSignIn() {
		var username = $('#username').val().trim();
		var password = $('#password').val().trim();
		
		if(username == '') {
			errorMessage('Username is required');
		} else if(password == '') {
			errorMessage('Password is required');
		} else {
			signIn(username,password);
		}
	}
	/*End: Validation for Sign-in*/

	/*Start: Sign-in */
	function signIn(usernm,password) {
		showLoader();
		var dataObject = {};
		var signin={};
		var newObj = {};
		var myarray = Array(dataObject);

		/*JSON Arguments*/
		dataObject.username = usernm;
		dataObject.password = password;
		newObj.signin= myarray;
		
		//var url = apiUrl+'login.php';
		var url = apiUrl+'process.php?action=login';
		var data = ajaxCall(url,'GET',JSON.stringify(newObj));//Make AJAX Call For SignIn
		
		setTimeout(function() {
			if(data.status != 200 || data.responseJSON.status != 200) {
				hideLoader();
				errorMessage(data.responseJSON.message);
			}
			else {
				hideLoader();
				successMessage(data.responseJSON.message);
				
				setTimeout(function() {
					if(data.responseJSON.res == 1) {
						window.location = "admin/index.php";
					} else {
						window.location = "user/index.php";
					}
				},1000);
			}	
		},1000);					
	}
	/*End: Sign in*/

	/*Start: Ajax Call*/
	function ajaxCall(url,type,jsonData) {
		return $.ajax({
			async: false,
			type: type,
			url: url,
			data: {data: jsonData},
			dataType: 'json',
			//complete: function(data) {}
			success: function (data) {
				//alert(data);
			},
			error: function (error) {
				//jsonValue = jQuery.parseJSON(error.responseText);
				//alert("error" + error.responseText);
			}
		});
	}
	/*End: Ajex Call*/

	/*Start: Success Message*/
	function successMessage(msg) {
		$('#errorMsg').hide();
		document.getElementById('successMsg').innerHTML = msg;
		$('#successMsg').fadeIn('slow');
		setTimeout(function(){
			$('#successMsg').fadeOut('slow');
		},5000);
		//alert("Error");
	}
	/*End: Success Message*/

	/*Start: Error Message*/
	function errorMessage(msg) {
		$('#successMsg').hide();
		document.getElementById('errorMsg').innerHTML = msg;
		$('#errorMsg').fadeIn('slow');
		setTimeout(function(){
			$('#errorMsg').fadeOut('slow');
		},5000);
		//alert("Error");
	}
	/*End: Error Message*/

	/*Start: Show Loader*/
	function showLoader() {
		$('.loading').css('display','block');
		return;
	}
	/*End: Show Loader*/

	/*Start: Hide Loader*/
	function hideLoader() {
		$('.loading').css('display','none');
		return;
	}
	/*End: Hide Loader*/
</script>