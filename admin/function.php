<script>
	var char = /^[a-zA-Z\s]+$/;
	var numregx = /^\+49(?=.{10})\d{10,15}$/;
	var mailregx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var noStartSpaceRegx = /^[^-\s][a-zA-Z0-9_\s-]+$/;
	var noSpaceRegex = /^\S*$/;
	var noSpecCharsRegx = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
	var atleast3CharRegx = /^([0-9a-zA-Z]){3,}$/;
	var atleast7CharRegx = /^([0-9a-zA-Z]){7,}$/;
	var upperCaseCharRegx = /(?=.*[A-Z])/;
	var apiUrl = '<?php echo APIURL;?>';

	/*Start: Validate Worker Details*/
	function validateWorkerDetails() {
		var fname = $('#fname').val().trim();
		var lname = $('#lname').val().trim();
		var email = $('#emailaddress').val().trim();
		var phone = $('#phone').val().trim();
		var username = $('#username').val().trim();
		var password = $('#password').val().trim();
		var confirmpass = $('#confirmpass').val().trim();

		if(fname == '') {
			errorMessage('First name is required');
		} else if(!char.test(fname)) {
			errorMessage('First name should be in proper format');
		} else if(lname == '') {
			errorMessage('Last name is required');
		} else if(!char.test(lname)) {
			errorMessage('Last name should be in proper format');
		} else if(email == '') {
			errorMessage('Email Address is required');
		} else if(!mailregx.test(email)) {
			errorMessage('Email Address should be in proper format');
		} else if(!noSpaceRegex.test(email)) {
			errorMessage('Email Address should not contain any space');
		} else if(phone == '') {
			errorMessage('Phone is required');
		} else if(!numregx.test(phone)) {
			errorMessage('Phone should be in proper format');
		} else if(username == '') {
			errorMessage('User name is required');
		} else if(!noSpaceRegex.test(username)) {
			errorMessage('User name should not contain any space');
		} else if(!atleast3CharRegx.test(username)) {
			errorMessage('User name should be at least 3 characters');
		} else if(username.length > 50) {
			errorMessage('User name should not be more than 50 characters');
		} else if(password == '') {
			errorMessage('Password is required');
		} else if(!noSpaceRegex.test(password)) {
			errorMessage('Password should not contain any space');
		} else if(!atleast7CharRegx.test(password)) {
			errorMessage('Password should be at least 7 characters');
		} else if(confirmpass !== password) {
			errorMessage('Password and confirm password did not match');
		} else {
			workerRegistration(fname,lname,email,phone,username,password);
		}
	}
	/*End: Validate Worker Details*/

	/*Start: Add Worker Registration Details*/
	function workerRegistration(fname,lname,email,phone,username,password) {
		showLoader();
		var dataObject = {};
		var workerRegistration={};
		var newObj = {};
		var myarray = Array(dataObject);

		/*JSON Arguments*/
		dataObject.fname = fname;
		dataObject.lname = lname;
		dataObject.email = email;
		dataObject.phone = phone;
		dataObject.username = username;
		dataObject.password = password;
		newObj.registration= myarray;
		
		var url = apiUrl+'process.php?action=workerRegistration';
		var data = ajaxCall(url,'POST',JSON.stringify(newObj));//Make AJAX Call For Registration
		
		setTimeout(function() {
			if(data.status != 200 || data.responseJSON.status != 200) {
				hideLoader();
				errorMessage(data.responseJSON.message);
			}
			else {
				hideLoader();
				successMessage(data.responseJSON.message);
				
				setTimeout(function() {
					window.location = 'workerlist.php';
					//location.reload();
				},1000);
			}	
		},1000);
	}
	/*End: Add Worker Registration Details*/	

	/*Start: Validate Worker Schedule*/
	function validateSchedule() {

		var workerid = $('#workerid').val().trim();
		var scheduledatenull = $('#scheduledate').datepicker('getDate');
		var scheduletime = $('#scheduletime').val().trim();
		
		if(scheduledatenull == null) {
			errorMessage('Schedule date is required');
		} else if(scheduletime == 0) {
			errorMessage('Schedule time is required');
		} else {
			var scheduledate = $('#scheduledate').val();
			addSchedule(workerid,scheduledate,scheduletime);
		}
	}
	/*End: Validate Worker Schedule*/

	/*Start: Add Worker Schedule*/
	function addSchedule(workerid,scheduledate,scheduletime) {
		showLoader();
		var dataObject = {};
		var addSchedule={};
		var newObj = {};
		var myarray = Array(dataObject);

		/*JSON Arguments*/
		dataObject.workerid = workerid;
		dataObject.scheduledate = scheduledate;
		dataObject.scheduletime = scheduletime;
		newObj.addSchedule= myarray;
		
		var url = apiUrl+'process.php?action=addSchedule';
		var data = ajaxCall(url,'POST',JSON.stringify(newObj));//Make AJAX Call For schedule work

		setTimeout(function() {
			if(data.status != 200 || data.responseJSON.status != 200) {
				hideLoader();
				errorMessage(data.responseJSON.message);
			}
			else {
				hideLoader();
				successMessage(data.responseJSON.message);
				
				setTimeout(function() {
					window.location = 'workerlist.php';
					//location.reload();
				},1000);
			}	
		},1000);
	}
	/*End: Add Worker Schedule*/

	/*Start: Check & Disable PreScheduled Days*/
	function disablePreScheduledDays() {
		var workerid = $('#workerid').val().trim();
		var dataObject = {};
		var preScheduleDays={};
		var newObj = {};
		var myarray = Array(dataObject);

		/*JSON Arguments*/
		dataObject.workerid = workerid;
		newObj.preScheduleDays= myarray;
		
		var url = apiUrl+'process.php?action=disablePreScheduledDays';
		var data = ajaxCall(url,'POST',JSON.stringify(newObj));//Make AJAX Call For schedule work

		//setTimeout(function() {
			if(data.status != 200 || data.responseJSON.status != 200) {
				//hideLoader();
				errorMessage(data.responseJSON.message);
			}
			else {
				//hideLoader();
				//successMessage(data.responseJSON.message);
				if(data.responseJSON.res !== null) {
					var dateArray = data.responseJSON.res;
					
					$('#scheduledate').datepicker({
						format: 'yyyy-mm-dd',
						daysOfWeekDisabled: [0,6],
						beforeShowDay: function(date){
			            	//Intl.DateTimeFormat will convert date timestamp into different format
			            	var newdt = new Intl.DateTimeFormat('en-GB').format(date);
			            	var newDate = newdt.split("/").reverse().join("-");

			            	if(dateArray.indexOf(newDate) != -1){ 
			            		return false; 
			            	} 
			            	else{ 
			            		return true; 
			            	}
			            }
			        });
				} else {
					$('#scheduledate').datepicker({
						format: 'yyyy-mm-dd',
						daysOfWeekDisabled: [0,6]
					});
				}
			}	
		//},1000);	
	}
	/*End: Check & Disable PreScheduled Days*/

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
		window.scrollTo(0, 0);
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
		window.scrollTo(0, 0);
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