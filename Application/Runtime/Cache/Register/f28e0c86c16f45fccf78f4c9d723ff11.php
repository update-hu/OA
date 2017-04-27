<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>用户登录</title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->

		<link href="/OA/Public/assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="/OA/Public/vassets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="/OA/Public/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<!-- fonts -->

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!-- ace styles -->

		<link rel="stylesheet" href="/OA/Public/assets/css/ace.min.css" />
		<link rel="stylesheet" href="/OA/Public/assets/css/ace-rtl.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="/OA/Public/assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="/OA/Public/assets/js/html5shiv.js"></script>
		<script src="/OA/Public/assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="icon-leaf green"></i>
								</h1>
								<h4 class="blue">OA系统</h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">

								<div id="signup-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header green lighter bigger">
												<i class="icon-group blue"></i>
												新员工注册
											</h4>

											<div class="space-6"></div>

											<form id="RegisterForm" method="post" action="/OA/index.php/Register/Register/check" onsubmit="return inputCheck(this)" >
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="username" placeholder="用户名(3-15位字母或者数字不能以0开头)"  />
															<i class="icon-envelope"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="password" placeholder="密码(6-12位数字或者字母)" />
															<i class="icon-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="repassword" placeholder="重复密码" />
															<i class="icon-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" name="email" placeholder="邮箱" />
															<i class="icon-user"></i>
														</span>
													</label>

													<!--<label class="block clearfix">-->
													<!--<span class="block input-icon input-icon-right">-->
													<!--<input type="password" class="form-control" placeholder="" />-->
													<!--<i class="icon-retweet"></i>-->
													<!--</span>-->
													<!--</label>-->

													<label class="block">
														<input type="checkbox" class="ace" id="checkmenu" />
														<span class="lbl">
															我接受
															<a href="#">公司手册</a>
														</span>
													</label>

													<label class="block" >
														<span class="lbl" >
															已有账号,点击
															<a href="/OA/index.php/Login/Login/login" >登录</a>
														</span>
													</label>

													<div class="space-24"></div>

													<div class="clearfix">
														<button type="reset" class="width-30 pull-left btn btn-sm">
															<i class="icon-refresh"></i>
															清空
														</button>

														<button type="input" class="width-65 pull-right btn btn-sm btn-success">
															注册
															<i class="icon-arrow-right icon-on-right"></i>
														</button>

													</div>
												</fieldset>
											</form>
										</div>

										<div class="toolbar center">
											<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
												<i class="icon-arrow-left"></i>
											</a>
										</div>
									</div><!-- /widget-body -->
								</div><!-- /signup-box -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='/OA/Public/assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='/OA/Public/assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='/OA/Public/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->

		<script type="text/javascript">
			function show_box(id) {
			 jQuery('.widget-box.visible').removeClass('visible');
			 jQuery('#'+id).addClass('visible');
			}
		</script>

			<script>
				function inputCheck(RegisterForm) {

				    //检测用户名格式
                    var usernamereg = /^[a-zA-Z1-9]{1}[a-zA-Z0-9]{2,14}$/;
                    var username = RegisterForm.username.value.trim();

                    //检测密码格式
                    var passwordreg = /^[a-zA-Z0-9]{6,12}$/;
                    var password = RegisterForm.password.value.trim();

                    //检测邮箱格式
                    var emailreg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
                    var email = RegisterForm.email.value.trim();

				    if(RegisterForm.username.value == "") {
				        alert("用户名不能为空");
				        return false;
					} else if(RegisterForm.password.value == "") {
				        alert("密码不能为空");
				        return false;
					} else if(RegisterForm.repassword.value != RegisterForm.password.value) {
				        alert("两次密码输入不相等");
				        return false;
					} else if(RegisterForm.email.value == "") {
				        alert("邮箱不能为空");
				        return false;
					} else if(document.getElementById("checkmenu").checked == false) {  //检测用户是否同意员工手册
				        alert("请阅读员工手册，并点击同意");
				        return false;
					} else if(!usernamereg.test(username)) {
					    alert("用户名格式不正确，请重新注册");
					    return false;
					} else if(!passwordreg.test(password)) {
					    alert("密码格式不正确，请重新注册");
					    return false;
					} else if(!emailreg.test(email)) {
					    alert("邮箱格式不正确，请重新注册");
					    return false;
					} else {
				        return true;
					}
				}
			</script>




	<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>