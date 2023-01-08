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
						}
					}
				}
			?>
			<?php if($userdata != null){ ?>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown" style="padding-top:7px">
					<p style="text-align:center;">
						<a href="<?php echo base_url();?>index.php?browse/youraccount" class="pro-btn">
							<img id='userThumb' src="<?php echo base_url();?>assets/global/<?php echo $bar_thumb;?>" style="height:30px;margin-right:10px;" />
							<span><?php echo $userdata->name;?></span>
						</a>
						<?php if($this->session->userdata('login_type') == 1): ?>
							<a href="<?php echo base_url();?>index.php?admin/dashboard" class="pro-btn" style="float:none;display:inline-block;margin-top:3px">Admin</a>
						<?php endif;?>
						<span style="padding:3px;float:right"><button class="btn btn-danger" style="border-radius:10px;" onclick='fbLogout()'>Гарах</button></span>
					</p>
				</li>
			</ul>
			<?php } else { ?>
				<div class="login-btn-container">
					<!-- <button class="btn btn-danger" type="button" onclick="fbLogin()">Нэвтрэх</button> -->
					<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#auth">Нэвтрэх</button>
				</div>
			<?php } ?>
			<!-- SEARCH FORM -->
			<form class="navbar-form navbar-right <?php // if($userdata != null){ echo 'w-100'; }?>" method="post" action="<?php echo base_url();?>index.php?browse/search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Гарчиг, жүжигчин, жанр" 
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
<!-- Modal -->
<div id="auth" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content bg-light">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Нэвтрэх / Бүртгүүлэх</h4>
      </div>
      <div class="modal-body">
        <button type='button' class='btn btn-primary w-100 facebook-btn' onclick="fbLogin()"><i class='fa fa-facebook'></i> Фейсбүүкээр нэвтрэх</button>
		<div id="g_id_onload"
			data-client_id="401890577875-5q7t2qo61m9bhan3mg24h7ku7ma8ncm3.apps.googleusercontent.com"
			data-context="signup"
			data-ux_mode="popup"
			data-login_uri="https://neontoon.mn"
			data-callback="handleCredentialResponse"
			data-auto_prompt="false">
		</div>

		<div class="g_id_signin"
			data-type="standard"
			data-shape="rectangular"
			data-theme="outline"
			data-text="signup_with"
			data-size="large"
			data-callback="handleCredentialResponse"
			data-locale="mn"
			data-logo_alignment="left">
		</div>
      </div>
    </div>

  </div>
</div>

<script>

	/* window.onload = function () {
		google.accounts.id.initialize({
		client_id: '401890577875-5q7t2qo61m9bhan3mg24h7ku7ma8ncm3.apps.googleusercontent.com',
		callback: handleCredentialResponse
		});
		google.accounts.id.prompt();
	}; */

	function handleCredentialResponse(data){
		console.log('handleCredentialResponse', data)
	}
	
	$(function() {
		console.log(window.location.hash);
		if(window.location.hash == '#login'){
			openLoginModal();
		}
	})

	function openRegModal(){
		showForm1();
		$('#customModal').addClass('show');
	}

	function closeModal(){
		console.log('closing');
		$('#customModal').removeClass('show');
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
		loginbtn.innerText = 'Нэвтрэх';
		p.appendChild(loginbtn);

		let regbtn = document.createElement('a');
		regbtn.setAttribute('href', '#');
		regbtn.setAttribute('onclick', 'openRegModal()');
		regbtn.innerText = 'Бүртгүүлэх';
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

	function openLoginModal(){
		showLoginForm();
		$('#customModal').addClass('show');
	}

</script>
<?php } ?>

<script>
	$(function() {
		var thumb = localStorage.getItem('fbthumb');
		if(thumb){
			$('#userThumb').attr('src', thumb);
		}
	})
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
					localStorage.setItem('token', response.authResponse.accessToken)
					// Get and display the user profile data
					onLogin();
				} 
			}, {scope: 'email'});
		}

		function onLogin(){
			FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
			function (response) {
				console.log('Login user data', response)
				const { email, first_name, id, last_name } = response
				const picture = response.picture.data.url
				const query = { email, name: `${first_name} ${last_name}`, id }
				localStorage.setItem('fbthumb', picture)
				console.log('query', query)
				axios.post('/index.php?home/authfb', JSON.stringify(query))
					.then(res => {
						console.log('res', res);
						if(res.data == 'success'){
							window.location.reload();
						}else{
							showMessage(res.data);
						}
					}).catch(err => showMessage(err.res.data));
			});
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
			FB.getLoginStatus(function(response) {
				FB.logout(function(res) {
					console.log('logout res', res)
					// document.getElementById('fbLink').setAttribute("onclick","fbLogin()");
				});
			})
			axios.get('/index.php?home/signout')
				.then(res => {
					if(res.data == 'success'){
						window.location.href = '/';
					}else{
						showMessage(res.data);
					}
				}).catch(err => showMessage(err.res.data));
		}
</script>
<?php 
	if ($page_name !== 'home' && $page_name !== 'landing2' && $page_name !== 'landing'){
		include 'sidebar.php';
	}
?>