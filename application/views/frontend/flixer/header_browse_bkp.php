<!-- TOP HEADING SECTION -->
<style>
	.nav_transparent {
	padding: 10px 0px 10px; border: 1px;
	background: rgba(0,0,0,0.8); 
	}
	.nav_dark {
	background-color: #000;
	padding: 10px;
	}
</style>
<?php 
	if ($page_name == 'home' || $page_name == 'playmovie') 
		$nav_type = 'nav_transparent';
	else 
		$nav_type = 'nav_dark';
	?>
<div class="navbar navbar-default navbar-fixed-top <?php echo $nav_type;?>" >
	<div class="container-fluid">
		<div class="navbar-header">
			<a href="<?php echo base_url();?>" class="navbar-brand">
				<img src="<?php echo base_url();?>/assets/global/logo.png" style="height: 32px;" />
			</a>
			<button class="navbar-toggle" type="button" id="menu" data-toggle="collapse" data-target="#navbar-main">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="navbar-collapse collapse" id="navbar-main">
			<!-- PROFILE, enenii urd menu bsn ACCOUNT SECTION -->
			<?php
				if($this->session != null){
					$userdata	=	$this->db->get_where('user', array('user_id'=>$this->session->userdata('user_id')))->row();
					$subscription_validation = false;
					if($userdata != null){
						// by deault, email & general thumb shown at top
						$bar_text	=	$this->db->get_where('user', array('user_id'=>$this->session->userdata('user_id')))->row()->email;
						$bar_thumb	=	'thumb1.png';
						// check if there is active subscription
						$subscription_validation	=	$this->crud_model->validate_subscription();
						if ($subscription_validation != false)
						{
							$active_user	=	$this->session->userdata('active_user');
							$bar_text 	=	$this->crud_model->get_username_of_user('user1');
							$bar_thumb	=	'thumb1.png';
						}
					}
				}
			?>
			<?php if($userdata != null){ ?>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown" style="padding-top:7px">
					<p style="text-align:center;">
						<a href="<?php echo base_url();?>index.php?browse/youraccount" class="pro-btn">
							<img src="<?php echo base_url();?>assets/global/<?php echo $bar_thumb;?>" style="height:30px;margin-right:10px;" />
							<span><?php echo $userdata->name;?></span>
						</a>
						<?php if($this->session->userdata('login_type') == 1): ?>
							<a href="<?php echo base_url();?>index.php?admin/dashboard" class="pro-btn" style="float:none;display:inline-block;margin-top:3px">Admin</a>
						<?php endif;?>
						<span style="padding:3px;float:right"><a href="<?php echo base_url();?>index.php?home/signout" class="btn btn-danger" style="border-radius:10px;">??????????</a></span>
					</p>
				</li>
			</ul>
			<?php } else { ?>
				<div class="login-btn-container">
					<!-- <button class="btn btn-danger" type="button" onclick="fbLogin()">??????????????</button> -->
					<button class="btn btn-danger" type="button" onclick="openLoginModal()">??????????????</button>
				</div>
			<?php } ?>
			<!-- SEARCH FORM -->
			<form class="navbar-form navbar-right <?php if($userdata != null){ echo 'w-100'; }?>" method="post" action="<?php echo base_url();?>index.php?browse/search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="????????????, ????????????????, ????????" 
						style="background-color: #000; border: 1px solid #808080;" name="search_key">
				</div>
				<button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
			</form>
		</div>
	</div>
</div>
<?php 
	if ($page_name == 'home' || $page_name == 'playmovie' || $page_name == 'playseries' || $page_name == 'landing2' || $page_name == 'landing')
		$padding_amount = '0px';
	else
		$padding_amount = '50px';
	?>
<div style="padding: 0"></div>
<?php if($userdata == null){ ?>
<div id="customModal"  class="modal-bg">
	<div id="authmodal" class="modal modal-sm auth-modal">
		<button class="close" onclick="closeRegModal()">&times;</button>
		<div class="modal-body"></div>
	</div>
</div>
<script>
	let phoneNumber = '';
	let regType = 'phone';
	$(function() {
		console.log(window.location.hash);
		if(window.location.hash == '#login'){
			openLoginModal();
		}
		setTimeout(function(){
			$('#authmodal input').val('');
		}, 500);
	})

	function openRegModal(){
		showForm1();
		$('#customModal').addClass('show');
	}

	function closeRegModal(){
		console.log('closing');
		$('#customModal').removeClass('show');
	}

	function phoneOrEmail(id){
		console.log('phoneOrEmail', id)
		$('.option-btn').removeClass('btn-success');
		$(id).addClass('btn-success');
		if(id == '#byphone'){
			regType = 'phone';
			$('#smsform').show();
			$('#mailform').hide();
		}else{
			regType = 'email';
			$('#smsform').hide();
			$('#mailform').show();
		}
	}

	function showForm1(){
		let frm = document.createElement('form');
		frm.setAttribute('method', 'post');
		frm.setAttribute('id', 'regform1');
		frm.onsubmit = regStepOne;

		let signupOptions = document.createElement('div');
		// label.setAttribute('class', 'text-purple auth-label');
		// label.innerText = '???????????? ????????????, ?????????? ??????????';
		let phoneBtn = document.createElement('button');
		phoneBtn.setAttribute('class', 'btn btn-success btn-sm option-btn');
		phoneBtn.setAttribute('type', 'button');
		phoneBtn.setAttribute('id', 'byphone');
		phoneBtn.innerText = '???????????? ??????????????????';
		phoneBtn.onclick = () => phoneOrEmail('#byphone');

		let emailBtn = document.createElement('button');
		emailBtn.setAttribute('class', 'btn btn-sm option-btn');
		emailBtn.setAttribute('type', 'button');
		emailBtn.setAttribute('id', 'bymail');
		emailBtn.innerText = '????????????????';
		emailBtn.onclick = () => phoneOrEmail('#bymail');

		signupOptions.appendChild(phoneBtn);
		signupOptions.appendChild(emailBtn);

		frm.appendChild(signupOptions);
		//frm.appendChild(label);
		let dv = document.createElement('div');
		dv.setAttribute('id', 'smsform');
		let input = document.createElement('input');
		input.setAttribute('type', 'number')
		input.setAttribute('name', 'phone')
		input.setAttribute('placeholder', '???????????? ????????????...')
		input.setAttribute('autocomplete', 'off');
		dv.appendChild(input);
		frm.appendChild(dv);

		let dv2 = document.createElement('div');
		dv2.setAttribute('id', 'mailform');
		dv2.setAttribute('style', 'display:none');
		let email = document.createElement('input');
		email.setAttribute('name', 'email')
		email.setAttribute('type', 'email')
		email.setAttribute('placeholder', '?????????? ????????...')
		email.setAttribute('autocomplete', 'off');
		dv2.appendChild(email);

		let pass = document.createElement('input');
		pass.setAttribute('name', 'password')
		pass.setAttribute('placeholder', '???????? ????...')
		pass.setAttribute('autocomplete', 'off');
		pass.setAttribute('id', 'pass');
		pass.setAttribute('type', 'password')
		dv2.appendChild(pass);

		frm.appendChild(dv2);
		let btn = document.createElement('button');
		btn.setAttribute('type', 'submit')
		btn.setAttribute('class', 'btn btn-purple')
		btn.innerText = '????????????????????';
		let p = document.createElement('p');
		p.setAttribute('class', 'text-center');
		let a = document.createElement('a');
		a.setAttribute('href', '#');
		a.setAttribute('onclick', 'showLoginForm()');
		a.innerText = '??????????????';
		p.appendChild(a);

		frm.appendChild(btn);
		frm.appendChild(p);
		$('#authmodal .modal-body').html(frm);
	}

	function reset(e){
		e.preventDefault();
		let phone = e.target.phone ? e.target.phone.value : ''
		if(regType == 'phone' && phone.length != 8){
			alert('???????????? ???????????????? ?????? ?????????????? ????!')
			return false;
		}
		if(regType == 'email' && !validateEmail(phone)){
			alert('?????????? ???????? ?????????? ??????????!')
			return false;
		}
		let query = {
			"phone":phone,
			"email":phone
		}
		phoneNumber = phone;
		showLoader();
		let url = regType == 'phone' ? '/index.php?home/signupx' : '/index.php?home/forget'
		axios.post(url, JSON.stringify(query))
			.then(res => {
				console.log('res', res);
				if(res.data == 'success'){
					showForm2();
				}else{
					showMessage(res.data);
				}
			}).catch(err => showMessage(err.res.data));
	}

	function regStepOne(e){
		e.preventDefault();
		let phone = e.target.phone ? e.target.phone.value : ''
		let email = e.target.email ? e.target.email.value : ''
		let password = e.target.password ? e.target.password.value : ''
		if(regType == 'phone' && phone.length != 8){
			alert('???????????? ???????????????? ?????? ?????????????? ????!')
			return false;
		}
		if(regType == 'email' && !validateEmail(email)){
			alert('?????????? ???????? ?????????? ??????????!')
			return false;
		}
		let query = {}
		if(regType == 'phone'){
			phoneNumber = phone;
			query = {
				"phone":phone,
				"password":password
			}
		}else{
			query = {
				"email":email,
				"password":password
			}
		}
		showLoader();
		let url = regType == 'phone' ? '/index.php?home/signupx' : '/index.php?home/signup'
		axios.post(url, JSON.stringify(query))
			.then(res => {
				console.log('res', res);
				if(res.data == 'success'){
					showForm2();
				}else{
					showMessage(res.data);
				}
			}).catch(err => showMessage(err.res.data));
	}

	function showForm2(){
		let frm = document.createElement('form');
		frm.setAttribute('method', 'post');
		frm.setAttribute('id', 'regform2');
		frm.onsubmit = regStepTwo;
		let label = document.createElement('div');
		label.setAttribute('class', 'text-purple auth-label');
		label.innerText = '?????????????????? ???????????????? ?????????? ?????????????? ????!';
		frm.appendChild(label);
		let dv = document.createElement('div');
		dv.setAttribute('class', 'black_text');
		let input = document.createElement('input');
		input.setAttribute('type', 'number')
		input.setAttribute('name', 'otp')
		input.setAttribute('autocomplete', 'off');
		dv.appendChild(input);
		frm.appendChild(dv);
		let btn = document.createElement('button');
		btn.setAttribute('type', 'submit')
		btn.setAttribute('class', 'btn btn-purple')
		btn.innerText = '????????????';
		frm.appendChild(btn);
		$('#authmodal .modal-body').html(frm);
	}

	function regStepTwo(e){
		e.preventDefault();
		showLoader();
		let otp = e.target.otp.value
		if(otp.length !== 4){
			alert('???????????????????????????? ?????? ?????????? ??????????!')
			return false;
		}
		axios.post('/index.php?home/checkotp', JSON.stringify({"otp":otp, "phone": phoneNumber}))
			.then(res => {
				if(res.data == 'success'){
					showForm3();
				}else{
					showMessage(res.data);
					// $('#regform2 .auth-label').addClass('text-danger').text(res.data);
				}
			}).catch(err => showMessage(err.res.data));
	}
	
	function showForm3(){
		let frm = document.createElement('form');
		frm.setAttribute('method', 'post');
		frm.setAttribute('id', 'regform3');
		frm.onsubmit = regStepThree;

		let label = document.createElement('div');
		label.setAttribute('class', 'text-purple auth-label');
		label.innerText = '???????????????????????? ??????????????????. ?????? ?????????? ???????? ???????? ?????????????? ????!';
		frm.appendChild(label);
		// Name
		let labelName = document.createElement('div');
		labelName.setAttribute('class', 'text-purple auth-label');
		labelName.innerText = '??????';
		frm.appendChild(labelName);

		let dv = document.createElement('div');
		dv.setAttribute('class', 'black_text');
		let input = document.createElement('input');
		input.setAttribute('type', 'text')
		input.setAttribute('name', 'name')
		input.setAttribute('autocomplete', 'off');
		dv.appendChild(input);
		frm.appendChild(dv);
		// Password
		let labelPass = document.createElement('div');
		labelPass.setAttribute('class', 'text-purple auth-label');
		labelPass.innerText = '???????? ????';
		frm.appendChild(labelPass);

		let dv2 = document.createElement('div');
		dv2.setAttribute('class', 'black_text');
		let input2 = document.createElement('input');
		input2.setAttribute('type', 'password')
		input2.setAttribute('name', 'password')
		input2.setAttribute('autocomplete', 'off');
		dv2.appendChild(input2);
		frm.appendChild(dv2);
		// Password confirm
		let labelPass2 = document.createElement('div');
		labelPass2.setAttribute('class', 'text-purple auth-label');
		labelPass2.innerText = '???????? ???? ???????????? ??????????????';
		frm.appendChild(labelPass2);

		let dv3 = document.createElement('div');
		dv3.setAttribute('class', 'black_text');
		let input3 = document.createElement('input');
		input3.setAttribute('type', 'password')
		input3.setAttribute('name', 'confirm')
		input3.setAttribute('autocomplete', 'off');
		dv3.appendChild(input3);
		frm.appendChild(dv3);
		// Button
		let btn = document.createElement('button');
		btn.setAttribute('type', 'submit')
		btn.setAttribute('class', 'btn btn-purple')
		btn.innerText = '????????????';
		frm.appendChild(btn);
		$('#authmodal .modal-body').html(frm);
		setTimeout(function(){
			$('#authmodal input').val('');
		}, 500);
	}

	function regStepThree(e){
		e.preventDefault();
		let name = e.target.name.value
		let password = e.target.password.value
		let confirm = e.target.confirm.value

		if(name.length == 0){
			alert('?????????? ?????????????? ????!')
			return false;
		}
		if(password.length < 6){
			alert('???????? ???? 6 ?????????? ?????????????? ???????? ?????????????? ?????????????? ????!')
			return false;
		}
		if(password != confirm){
			alert('???????? ???? ???????????? ???????????????????? ?????? ??????????!')
			return false;
		}
		showLoader();
		axios.post('/index.php?home/register', JSON.stringify({"phone": phoneNumber, "name": name, "password": password}))
			.then(res => {
				if(res.data == 'success'){
					showMessage('?????????????? ??????????????????. ???? ???????? ???????????? ???????????? ?????????? ???????? ?????????????? ?????????????? ??????????.');
				}else{
					showMessage(res.data);
				}
				
			}).catch(err => showMessage(err.res.data));
	}

	function showMessage(msg){
		let label = document.createElement('div');
		label.setAttribute('class', 'text-purple auth-label text-center');
		label.innerText = msg;
		let p = document.createElement('p');
		p.setAttribute('class', 'text-center');
		let loginbtn = document.createElement('a');
		loginbtn.setAttribute('href', '#');
		loginbtn.setAttribute('onclick', 'openLoginModal()');
		loginbtn.innerText = '??????????????';
		p.appendChild(loginbtn);

		let regbtn = document.createElement('a');
		regbtn.setAttribute('href', '#');
		regbtn.setAttribute('onclick', 'openRegModal()');
		regbtn.innerText = '????????????????????';
		p.appendChild(regbtn);
		label.appendChild(p);
		$('#authmodal .modal-body').html(label);
	}

	function showLoader(){
		let img = document.createElement('img');
		img.setAttribute('src', '/assets/global/loader_neon.gif');
		img.setAttribute('class', 'loader');
		$('#authmodal .modal-body').html(img);
	}

	function showLoginForm(){
		let frm = document.createElement('form');
		frm.setAttribute('method', 'post');
		frm.setAttribute('id', 'loginForm');
		frm.onsubmit = login;

		let label = document.createElement('div');
		label.setAttribute('class', 'text-purple auth-label');
		label.innerText = '??????????????';
		frm.appendChild(label);
		// Name
		let labelName = document.createElement('div');
		labelName.setAttribute('class', 'text-purple auth-label');
		labelName.innerText = '???????????? ????????????, ?????????? ?????????? ????????';
		frm.appendChild(labelName);

		let dv = document.createElement('div');
		//dv.setAttribute('class', 'black_text');
		let input = document.createElement('input');
		// input.setAttribute('type', 'number');
		input.setAttribute('name', 'phone');
		input.setAttribute('required', 'true');
		input.setAttribute('autocomplete', 'off');
		dv.appendChild(input);
		frm.appendChild(dv);

		// Password
		let labelPass = document.createElement('div');
		labelPass.setAttribute('class', 'text-purple auth-label');
		labelPass.innerText = '???????? ????';
		frm.appendChild(labelPass);

		let dv2 = document.createElement('div');
		// dv2.setAttribute('class', 'black_text');
		let input2 = document.createElement('input');
		input2.setAttribute('type', 'password');
		input2.setAttribute('name', 'password');
		input.setAttribute('required', 'true');
		input2.setAttribute('autocomplete', 'off');
		dv2.appendChild(input2);
		frm.appendChild(dv2);

		// Button
		let btn = document.createElement('button');
		btn.setAttribute('type', 'submit')
		btn.setAttribute('class', 'btn btn-purple')
		btn.innerText = '??????????????';
		frm.appendChild(btn);
		let p = document.createElement('p');
		p.setAttribute('class', 'text-center');
		let a = document.createElement('a');
		a.setAttribute('href', '#');
		a.setAttribute('onclick', 'showResetForm()');
		a.innerText = '???????? ???? ??????????????';
		p.appendChild(a);
		
		let a2 = document.createElement('a');
		a2.setAttribute('href', '#');
		a2.setAttribute('onclick', 'openRegModal()');
		a2.innerText = '????????????????????';
		p.appendChild(a2);
		
		frm.appendChild(p);
		
		$('#authmodal .modal-body').html(frm);
		setTimeout(function(){
			$('#authmodal input').val('');
		}, 500);
	}

	function showResetForm(){
		let frm = document.createElement('form');
		frm.setAttribute('method', 'post');
		frm.setAttribute('id', 'regform1');
		frm.onsubmit = reset;
		let label = document.createElement('div');
		label.setAttribute('class', 'text-purple auth-label');
		label.innerText = '???????????? ????????????';
		frm.appendChild(label);

		let signupOptions = document.createElement('div');
		// label.setAttribute('class', 'text-purple auth-label');
		// label.innerText = '???????????? ????????????, ?????????? ??????????';
		let phoneBtn = document.createElement('button');
		phoneBtn.setAttribute('class', 'btn btn-success btn-sm option-btn');
		phoneBtn.setAttribute('type', 'button');
		phoneBtn.setAttribute('id', 'byphone');
		phoneBtn.innerText = '???????????? ??????????????????';
		phoneBtn.onclick = () => phoneOrEmail('#byphone');

		let emailBtn = document.createElement('button');
		emailBtn.setAttribute('class', 'btn btn-sm option-btn');
		emailBtn.setAttribute('type', 'button');
		emailBtn.setAttribute('id', 'bymail');
		emailBtn.innerText = '????????????????';
		emailBtn.onclick = () => phoneOrEmail('#bymail');

		signupOptions.appendChild(phoneBtn);
		signupOptions.appendChild(emailBtn);

		frm.appendChild(signupOptions);

		let dv = document.createElement('div');
		// dv.setAttribute('class', 'black_text');
		let input = document.createElement('input');
		// input.setAttribute('type', 'number')
		input.setAttribute('name', 'phone')
		input.setAttribute('autocomplete', 'off');
		dv.appendChild(input);
		frm.appendChild(dv);
		let btn = document.createElement('button');
		btn.setAttribute('type', 'submit')
		btn.setAttribute('class', 'btn btn-purple')
		btn.innerText = '????????????';
		let p = document.createElement('p');
		p.setAttribute('class', 'text-center');
		let a = document.createElement('a');
		a.setAttribute('href', '#');
		a.setAttribute('onclick', 'showLoginForm()');
		a.innerText = '??????????????';
		p.appendChild(a);

		frm.appendChild(btn);
		frm.appendChild(p);
		$('#authmodal .modal-body').html(frm);
	}

	function resetRequest(e){
		e.preventDefault();
		let phone = e.target.phone.value
		if(phone.length == 0){
			alert('???????????? ???????????????? ?????????????? ????!')
			return false;
		}
		if(phone.length !== 8){
			alert('???????????? ???????????? ?????????? ??????????!')
			return false;
		}
		phoneNumber = phone;
		showLoader();
		axios.post('/index.php?home/reset', JSON.stringify({"phone":phone}))
			.then(res => {
				console.log('res', res);
				if(res.data == 'success'){
					showForm2();
				}else{
					showMessage(res.data);
				}
			}).catch(err => showMessage(err.res.data));
	}

	function openLoginModal(){
		showLoginForm();
		$('#customModal').addClass('show');
	}

	function login(e){
		e.preventDefault();
		showLoader();
		let phone = e.target.phone.value;
		let password = e.target.password.value;
		axios.post('/index.php?home/signinx', JSON.stringify({"phone": phone, "password": password}))
			.then(res => {
				console.log(res.data);
				if(res.data == 'error'){
					showMessage('?????????????? ???????????????? ?????????????????? ??????????.');
				}else{
					if(res.data == 'success'){
						window.location.reload();	
					}else{
						window.location.href = res.data;
					}
				}
			}).catch(err => showMessage(err.res.data));
	}

	const validateEmail = (email) => {
		return String(email)
			.toLowerCase()
			.match(
			/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
			);
	};

</script>
<?php } ?>

<script>
	$('#menu').on('click', function() {
		if($('.sidebar').hasClass('show')){
			$('.sidebar').removeClass('show');
		}else{
			$('.sidebar').addClass('show');
		}
	});
</script>

<script>
	window.fbAsyncInit = function() {
			// FB JavaScript SDK configuration and setup
			FB.init({
			appId      : '1180670992661169', // FB App ID
			cookie     : true,  // enable cookies to allow the server to access the session
			xfbml      : true,  // parse social plugins on this page
			version    : 'v3.2' // use graph api version 2.8
			});
			
			// Check whether the user already logged in
			FB.getLoginStatus(function(response) {
				console.log('Login status', response.status)
				if (response.status === 'connected') {
					//display user data
					getFbUserData();
				}
			});
		};

		// Load the JavaScript SDK asynchronously
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

		// Facebook login with JavaScript SDK
		function fbLogin() {
			FB.login(function (response) {
				if (response.authResponse) {
					// Get and display the user profile data
					getFbUserData();
				} else {
					document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
				}
			}, {scope: 'email'});
		}

		// Fetch the user profile data from facebook
		function getFbUserData(){
			FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
			function (response) {
				console.log('Login user data', response)
				// document.getElementById('fbLink').setAttribute("onclick","fbLogout()");
				// document.getElementById('fbLink').innerHTML = 'Logout from Facebook';
				// document.getElementById('status').innerHTML = '<p>Thanks for logging in, ' + response.first_name + '!</p>';
				// document.getElementById('userData').innerHTML = '<h2>Facebook Profile Details</h2><p><img src="'+response.picture.data.url+'"/></p><p><b>FB ID:</b> '+response.id+'</p><p><b>Name:</b> '+response.first_name+' '+response.last_name+'</p><p><b>Email:</b> '+response.email+'</p><p><b>Gender:</b> '+response.gender+'</p><p><b>FB Profile:</b> <a target="_blank" href="'+response.link+'">click to view profile</a></p>';
			});
		}

		// Logout from facebook
		function fbLogout() {
			FB.logout(function() {
				document.getElementById('fbLink').setAttribute("onclick","fbLogin()");
				document.getElementById('fbLink').innerHTML = '<img src="images/fb-login-btn.png"/>';
				document.getElementById('userData').innerHTML = '';
				document.getElementById('status').innerHTML = '<p>You have successfully logout from Facebook.</p>';
			});
		}
</script>
<?php 
	if ($page_name !== 'home' && $page_name !== 'landing2' && $page_name !== 'landing'){
		include 'sidebar.php';
	}
?>