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
			<a href="<?php echo base_url();?>index.php?home" class="navbar-brand">
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
				?>
			<?php if($userdata != null){ ?>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding:10px;">
					<img src="<?php echo base_url();?>assets/global/<?php echo $bar_thumb;?>" style="height:30px;" />
					<?php echo $userdata->name;?>
					<span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="themes">
						<?php 
							// user list shown only if there is active subscription 
							if ($subscription_validation != false):
							  $current_plan_id	=	$this->crud_model->get_current_plan_id();
							  ?>
						<li>
							<a href="<?php echo base_url();?>index.php?browse/doswitch/user1">
							<img src="<?php echo base_url();?>assets/global/thumb1.png" 
								style="height:30px; margin: 5px;" />
							</a>
						</li>
						
						<?php endif;?>
						<li class="divider"></li>
						<!-- SHOW ADMIN LINK IF ADMIN LOGGED IN -->
						<?php 
							if($this->session->userdata('login_type') == 1):
								?>
						<li><a href="<?php echo base_url();?>index.php?admin/dashboard">Admin</a></li>
						<?php endif;?>
						<li><a href="<?php echo base_url();?>index.php?browse/youraccount">Миний профайл</a></li>
						<li><a href="<?php echo base_url();?>index.php?home/signout">Гарах</a></li>
					</ul>
				</li>
			</ul>
			<?php } else { ?>
				<div class="login-btn-container">
					<button class="btn btn-danger" type="button" onclick="openLoginModal()">Нэвтрэх</button>
				</div>
			<?php } ?>
			<!-- SEARCH FORM -->
			<form class="navbar-form navbar-right" method="post" action="<?php echo base_url();?>index.php?browse/search">
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
<div id="customModal"  class="modal-bg">
	<div id="authmodal" class="modal modal-sm auth-modal">
		<button class="close" onclick="closeRegModal()">&times;</button>
		<div class="modal-body"></div>
	</div>
</div>
<script>
	let phoneNumber = '';
	$(function() {
		showForm1();
		setTimeout(function(){
			$('#authmodal input').val('');
		}, 500);
	})

	function openRegModal(){
		$('#customModal').addClass('show');
	}

	function closeRegModal(){
		console.log('closing');
		$('#customModal').removeClass('show');
	}

	function showForm1(){
		let frm = document.createElement('form');
		frm.setAttribute('method', 'post');
		frm.setAttribute('id', 'regform1');
		frm.onsubmit = regStepOne;
		let label = document.createElement('div');
		label.setAttribute('class', 'text-purple auth-label');
		label.innerText = 'Утасны дугаар';
		frm.appendChild(label);
		let dv = document.createElement('div');
		dv.setAttribute('class', 'black_text');
		let input = document.createElement('input');
		input.setAttribute('type', 'number')
		input.setAttribute('name', 'phone')
		input.setAttribute('autocomplete', 'off');
		dv.appendChild(input);
		frm.appendChild(dv);
		let btn = document.createElement('button');
		btn.setAttribute('type', 'submit')
		btn.setAttribute('class', 'btn btn-purple')
		btn.innerText = 'Бүртгүүлэх';
		frm.appendChild(btn);
		$('#authmodal .modal-body').html(frm);
	}

	function regStepOne(e){
		e.preventDefault();
		let phone = e.target.phone.value
		if(phone.length == 0){
			alert('Утасны дугаараа оруулна уу!')
			return false;
		}
		if(phone.length !== 8){
			alert('Утасны дугаар буруу байна!')
			return false;
		}
		phoneNumber = phone;
		showLoader();
		axios.post('/index.php?home/signup', JSON.stringify({"phone":phone}))
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
		label.innerText = 'Мессежээр илгээсэн кодыг оруулна уу!';
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
		btn.innerText = 'Илгээх';
		frm.appendChild(btn);
		$('#authmodal .modal-body').html(frm);
	}

	function regStepTwo(e){
		e.preventDefault();
		showLoader();
		let otp = e.target.otp.value
		if(otp.length !== 4){
			alert('Баталгаажуулах код буруу байна!')
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
		label.innerText = 'Баталгаажилт амжилттай. Нэр болон нууц үгээ оруулна уу!';
		frm.appendChild(label);
		// Name
		let labelName = document.createElement('div');
		labelName.setAttribute('class', 'text-purple auth-label');
		labelName.innerText = 'Нэр';
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
		labelPass.innerText = 'Нууц үг';
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
		labelPass2.innerText = 'Нууц үг давтаж оруулах';
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
		btn.innerText = 'Илгээх';
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
			alert('Нэрээ оруулна уу!')
			return false;
		}
		if(password.length < 6){
			alert('Нууц үг 6 болон түүнээс дээш тэмдэгт оруулна уу!')
			return false;
		}
		if(password != confirm){
			alert('Нууц үг давтаж оруулснаас өөр байна!')
			return false;
		}
		showLoader();
		axios.post('/index.php?home/register', JSON.stringify({"phone": phoneNumber, "name": name, "password": password}))
			.then(res => {
				if(res.data == 'success'){
					showMessage('Бүртгэл амжилттай. Та одоо утасны дугаар болон нууц үгээрээ нэвтэрч болно.');
				}else{
					showMessage(res.data);
				}
				
			}).catch(err => showMessage(err.res.data));
	}

	function showMessage(msg){
		let label = document.createElement('div');
		label.setAttribute('class', 'text-purple auth-label text-center');
		label.innerText = msg;
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
		label.innerText = 'Нэвтрэх';
		frm.appendChild(label);
		// Name
		let labelName = document.createElement('div');
		labelName.setAttribute('class', 'text-purple auth-label');
		labelName.innerText = 'Утасны дугаар';
		frm.appendChild(labelName);

		let dv = document.createElement('div');
		dv.setAttribute('class', 'black_text');
		let input = document.createElement('input');
		input.setAttribute('type', 'number');
		input.setAttribute('name', 'phone');
		input.setAttribute('required', 'true');
		input.setAttribute('autocomplete', 'off');
		dv.appendChild(input);
		frm.appendChild(dv);

		// Password
		let labelPass = document.createElement('div');
		labelPass.setAttribute('class', 'text-purple auth-label');
		labelPass.innerText = 'Нууц үг';
		frm.appendChild(labelPass);

		let dv2 = document.createElement('div');
		dv2.setAttribute('class', 'black_text');
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
		btn.innerText = 'Нэвтрэх';
		frm.appendChild(btn);
		$('#authmodal .modal-body').html(frm);
		setTimeout(function(){
			$('#authmodal input').val('');
		}, 500);
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
					showMessage('Нэвтрэх мэдээлэл таарахгүй байна.');
				}else{
					window.location.href = res.data;
				}
				
			}).catch(err => showMessage(err.res.data));
	}

	$('#menu').on('click', function() {
		if($('.sidebar').hasClass('show')){
			$('.sidebar').removeClass('show');
		}else{
			$('.sidebar').addClass('show');
		}
	});
</script>
<?php } ?>
<?php include 'sidebar.php';?>