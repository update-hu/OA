<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>修改培训</title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->

		<link href="/OA/Public/assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="/OA/Public/assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="/OA/Public/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<link rel="stylesheet" href="/OA/Public/assets/css/jquery-ui-1.10.3.custom.min.css" />

		<!-- fonts -->

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!-- ace styles -->

		<link rel="stylesheet" href="/OA/Public/assets/css/ace.min.css" />
		<link rel="stylesheet" href="/OA/Public/assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="/OA/Public/assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="/OA/Public/assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->

		<script src="/OA/Public/assets/js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="/OA/Public/assets/js/html5shiv.js"></script>
		<script src="/OA/Public/assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<div class="navbar navbar-default" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							<i class="icon-leaf"></i>
							OA
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->

				<div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="/OA/Public/assets/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									Welcome
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="icon-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul><!-- /.ace-nav -->
				</div><!-- /.navbar-header -->
			</div><!-- /.container -->
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text"></span>
				</a>

				<div class="sidebar" id="sidebar">
					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
					</script>

					<div class="sidebar-shortcuts" id="sidebar-shortcuts">
						<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
							<button class="btn btn-success">
								<i class="icon-signal"></i>
							</button>

							<button class="btn btn-info">
								<i class="icon-pencil"></i>
							</button>

							<button class="btn btn-warning">
								<i class="icon-group"></i>
							</button>

							<button class="btn btn-danger">
								<i class="icon-cogs"></i>
							</button>
						</div>

						<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
							<span class="btn btn-success"></span>

							<span class="btn btn-info"></span>

							<span class="btn btn-warning"></span>

							<span class="btn btn-danger"></span>
						</div>
					</div><!-- #sidebar-shortcuts -->

					<ul class="nav nav-list">
						<li class="active">
							<a href="addLog3.html">
								<i class="icon-dashboard"></i>
								<span class="menu-text"> 控制台 </span>
							</a>
						</li>
						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-user"></i>
								<span class="menu-text"> 权限管理 </span>

								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<li>
									<a href="/OA/index.php/Auth/AuthList/showAuthList">
										<i class="icon-double-angle-right"></i>
										权限列表
									</a>
								</li>

								<li>
									<a href="/OA/index.php/Auth/FillAuth/addAuth">
										<i class="icon-double-angle-right"></i>
										添加权限
									</a>
								</li>

								<li>
									<a href="/OA/index.php/Auth/RoleList/showRoleList">
										<i class="icon-double-angle-right"></i>
										用户组列表
									</a>
								</li>
								<li>
									<a href="/OA/index.php/Auth/FillRole/addRole">
										<i class="icon-double-angle-right"></i>
										新增用户组
									</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-user"></i>
								<span class="menu-text"> 员工管理 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="/OA/index.php/Employee/EmployeeList/showEmployeeList">
										<i class="icon-double-angle-right"></i>
										员工列表
									</a>
								</li>

								<li>
									<a href="/OA/index.php/Employee/FillEmoloyee/addEmployee">
										<i class="icon-double-angle-right"></i>
										信息填写
									</a>
								</li>

								<li>
									<a href="/OA/index.php/Employee/ChangeAcc/changeAccount">
										<i class="icon-double-angle-right"></i>
										账号密码修改
									</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-home"></i>
								<span class="menu-text"> 部门管理 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="/OA/index.php/Department/DepartmentList/showDepartmentList">
										<i class="icon-double-angle-right"></i>
										部门列表
									</a>
								</li>

								<li>
									<a href="/OA/index.php/Department/FillDepartment/addDepartment">
										<i class="icon-double-angle-right"></i>
										添加部门
									</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-book"></i>
								<span class="menu-text"> 日志管理 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="/OA/index.php/Log/LogList/showLogList">
										<i class="icon-double-angle-right"></i>
										日志列表
									</a>
								</li>

								<li>
									<a href="/OA/index.php/Log/LogList/showOneLogList">
										<i class="icon-double-angle-right"></i>
										个人日志列表
									</a>
								</li>

								<li>
									<a href="/OA/index.php/Log/FillLog/addLog">
										<i class="icon-double-angle-right"></i>
										写日志
									</a>
								</li>
							</ul>
						</li>

						<li class="active open">
							<a href="#" class="dropdown-toggle">
								<i class="icon-adjust"></i>
								<span class="menu-text"> 培训管理 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="/OA/index.php/Train/TrainList/showTrainList">
										<i class="icon-double-angle-right"></i>
										培训列表
									</a>
								</li>

								<li>
									<a href="/OA/index.php/Train/TrainList/showOneTrainList">
										<i class="icon-double-angle-right"></i>
										个人培训列表
									</a>
								</li>

								<li>
									<a href="/OA/index.php/Train/FillTrain/addTrain">
										<i class="icon-double-angle-right"></i>
										新增培训
									</a>
								</li>

								<li class="open">
									<a href="#">
										<i class="icon-double-angle-right"></i>
										修改培训信息
									</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-adjust"></i>
								<span class="menu-text"> 考勤管理 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="/OA/index.php/Sign/SignList/showSignList">
										<i class="icon-double-angle-right"></i>
										签到列表
									</a>
								</li>

								<li>
									<a href="/OA/index.php/Sign/SignList/showOneSignList">
										<i class="icon-double-angle-right"></i>
										个人签到列表
									</a>
								</li>

								<li>
									<a href="/OA/index.php/Sign/SignList/addSign">
										<i class="icon-double-angle-right"></i>
										签到
									</a>
								</li>

								<li>
									<a href="/OA/index.php/Sign/LeaveList/showLeaveList">
										<i class="icon-double-angle-right"></i>
										请假列表
									</a>
								</li>

								<li>
									<a href="/OA/index.php/Sign/LeaveList/showOneLeaveList">
										<i class="icon-double-angle-right"></i>
										个人请假列表
									</a>
								</li>

								<li>
									<a href="/OA/index.php/Sign/FillLeave/addLeave">
										<i class="icon-double-angle-right"></i>
										请假
									</a>
								</li>
							</ul>
						</li>

					</ul><!-- /.nav-list -->

					<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>

					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
					</script>
				</div>

				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="#">首页</a>
							</li>

							<li>
								<a href="#">培训</a>
							</li>
							<li class="active">修改培训信息</li>
						</ul><!-- .breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>修改培训信息</h1>
						</div><!-- /.page-header -->

						<form method="post" action="/OA/index.php/Train/TrainList/editTrain" >
							<div class="row">
								<div class="col-xs-12">
									<div>
									    <span>
										    <h4 class="header green clearfix" style="text-align: center">培训标题:<input type="text" name="train_name" value="<?php echo ($train["train_name"]); ?>"></h4>
									    </span>
									</div>

									<div>
									    <span>
										    <h4 class="header green clearfix" style="text-align: center">培训目标:<input type="text" name="purpose" value="<?php echo ($train["purpose"]); ?>"></h4>
									    </span>
									</div>

									<div>
									    <span>
										    <h4 class="header green clearfix" style="text-align: center">培训开始时间:<input type="date" name="start_time" value="<?php echo ($train["start_time"]); ?>"></h4>
									    </span>
									</div>

									<div>
									    <span>
										    <h4 class="header green clearfix" style="text-align: center">培训结束时间:<input type="date" name="end_time" value="<?php echo ($train["end_time"]); ?>"></h4>
									    </span>
									</div>

									<div class="wysiwyg-editor" id="editor1"><?php echo ($train["content"]); ?></div>
									<input type="hidden" name="content" id="con">
									<input type="hidden" name="train_id" value="<?php echo ($train["train_id"]); ?>" >

									<div class="hr hr-double dotted"></div>
									<script type="text/javascript">
                                        var $path_assets = "assets";
									</script>

								</div> <!--col -->
							</div><!-- /.row -->
							<div class="clearfix form-actions" >
								<div class="col-md-offset-3 col-md-9" >
									<input class="btn btn-info" type="submit" id="btn" value="提交" onclick="getDiv()">
								</div>
							</div>
						</form>
				</div>

				<div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="icon-cog bigger-150"></i>
					</div>

					<div class="ace-settings-box" id="ace-settings-box">
						<div>
							<div class="pull-left">
								<select id="skin-colorpicker" class="hide">
									<option data-skin="default" value="#438EB9">#438EB9</option>
									<option data-skin="skin-1" value="#222A2D">#222A2D</option>
									<option data-skin="skin-2" value="#C6487E">#C6487E</option>
									<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
								</select>
							</div>
							<span>&nbsp; Choose Skin</span>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
							<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
							<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
							<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
							<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
							<label class="lbl" for="ace-settings-add-container">
								Inside
								<b>.container</b>
							</label>
						</div>
					</div>
				</div><!-- /#ace-settings-container -->
			</div><!-- /.main-container-inner -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="icon-double-angle-up icon-only bigger-110"></i>
			</a>
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
		<script src="/OA/Public/assets/js/bootstrap.min.js"></script>
		<script src="/OA/Public/assets/js/typeahead-bs2.min.js"></script>

		<!-- page specific plugin scripts -->

		<script src="/OA/Public/assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="/OA/Public/assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="/OA/Public/assets/js/markdown/markdown.min.js"></script>
		<script src="/OA/Public/assets/js/markdown/bootstrap-markdown.min.js"></script>
		<script src="/OA/Public/assets/js/jquery.hotkeys.min.js"></script>
		<script src="/OA/Public/assets/js/bootstrap-wysiwyg.min.js"></script>
		<script src="/OA/Public/assets/js/bootbox.min.js"></script>

		<!-- ace scripts -->

		<script src="/OA/Public/assets/js/ace-elements.min.js"></script>
		<script src="/OA/Public/assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->

		<script type="text/javascript">
			jQuery(function($){
	
	function showErrorAlert (reason, detail) {
		var msg='';
		if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
		else {
			console.log("error uploading file", reason, detail);
		}
		$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
		 '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
	}

	//$('#editor1').ace_wysiwyg();//this will create the default editor will all buttons

	//but we want to change a few buttons colors for the third style
	$('#editor1').ace_wysiwyg({
		toolbar:
		[
			'font',
			null,
			'fontSize',
			null,
			{name:'bold', className:'btn-info'},
			{name:'italic', className:'btn-info'},
			{name:'strikethrough', className:'btn-info'},
			{name:'underline', className:'btn-info'},
			null,
			{name:'insertunorderedlist', className:'btn-success'},
			{name:'insertorderedlist', className:'btn-success'},
			{name:'outdent', className:'btn-purple'},
			{name:'indent', className:'btn-purple'},
			null,
			{name:'justifyleft', className:'btn-primary'},
			{name:'justifycenter', className:'btn-primary'},
			{name:'justifyright', className:'btn-primary'},
			{name:'justifyfull', className:'btn-inverse'},
			null,
			{name:'createLink', className:'btn-pink'},
			{name:'unlink', className:'btn-pink'},
			null,
			{name:'insertImage', className:'btn-success'},
			null,
			'foreColor',
			null,
			{name:'undo', className:'btn-grey'},
			{name:'redo', className:'btn-grey'}
		],
		'wysiwyg': {
			fileUploadError: showErrorAlert
		}
	}).prev().addClass('wysiwyg-style2');

	

	$('#editor2').css({'height':'200px'}).ace_wysiwyg({
		toolbar_place: function(toolbar) {
			return $(this).closest('.widget-box').find('.widget-header').prepend(toolbar).children(0).addClass('inline');
		},
		toolbar:
		[
			'bold',
			{name:'italic' , title:'Change Title!', icon: 'icon-leaf'},
			'strikethrough',
			null,
			'insertunorderedlist',
			'insertorderedlist',
			null,
			'justifyleft',
			'justifycenter',
			'justifyright'
		],
		speech_button:false
	});


	$('[data-toggle="buttons"] .btn').on('click', function(e){
		var target = $(this).find('input[type=radio]');
		var which = parseInt(target.val());
		var toolbar = $('#editor1').prev().get(0);
		if(which == 1 || which == 2 || which == 3) {
			toolbar.className = toolbar.className.replace(/wysiwyg\-style(1|2)/g , '');
			if(which == 1) $(toolbar).addClass('wysiwyg-style1');
			else if(which == 2) $(toolbar).addClass('wysiwyg-style2');
		}
	});


	

	//Add Image Resize Functionality to Chrome and Safari
	//webkit browsers don't have image resize functionality when content is editable
	//so let's add something using jQuery UI resizable
	//another option would be opening a dialog for user to enter dimensions.
	if ( typeof jQuery.ui !== 'undefined' && /applewebkit/.test(navigator.userAgent.toLowerCase()) ) {
		
		var lastResizableImg = null;
		function destroyResizable() {
			if(lastResizableImg == null) return;
			lastResizableImg.resizable( "destroy" );
			lastResizableImg.removeData('resizable');
			lastResizableImg = null;
		}

		var enableImageResize = function() {
			$('.wysiwyg-editor')
			.on('mousedown', function(e) {
				var target = $(e.target);
				if( e.target instanceof HTMLImageElement ) {
					if( !target.data('resizable') ) {
						target.resizable({
							aspectRatio: e.target.width / e.target.height,
						});
						target.data('resizable', true);
						
						if( lastResizableImg != null ) 
						lastResizableImg = target;
					}
				}
			})
			.on('click', function(e) {
				if( lastResizableImg != null && !(e.target instanceof HTMLImageElement) ) {
					destroyResizable();
				}
			})
			.on('keydown', function() {
				destroyResizable();
			});
	    }
		
		enableImageResize();

		/**
		//or we can load the jQuery UI dynamically only if needed
		if (typeof jQuery.ui !== 'undefined') enableImageResize();
		else );
				} else	enableImageResize();
			});
		}
		*/
	}


});
		</script>




			<script>
                function changeCode() {
                    var html = $("#editor1").html();
                    var decodeHTML = decodeHtml(html);
                    document.getElementById("editor1").innerHTML = decodeHTML;
                }
                function decodeHtml(s) {
                    var HTML_DECODE = {
                        "&lt;": "<",
                        "&gt;": ">",
                        "&amp;": "&",
                        "&nbsp;": " ",
                        "&quot;": "\"",
                        "&copy;": ""
                    };
                    var REGX_HTML_ENCODE = /"|&|'|<|>|[\x00-\x20]|[\x7F-\xFF]|[\u0100-\u2700]/g;
                    var REGX_HTML_DECODE = /&\w+;|&#(\d+);/g;
                    var REGX_TRIM = /(^\s*)|(\s*$)/g;
                    s = (s != undefined) ? s : "";
                    return (typeof s != "string") ? s :
                        s.replace(REGX_HTML_DECODE,
                            function ($0, $1) {
                                var c = HTML_DECODE[$0];
                                if (c == undefined) {
                                    // Maybe is Entity Number
                                    if (!isNaN($1)) {
                                        c = String.fromCharCode(($1 == 160) ? 32 : $1);
                                    } else {
                                        c = $0;
                                    }
                                }
                                return c;
                            });
                };

                function getDiv() {
                    var d = $("#editor1").html();
                    document.getElementById("con").value = d;
                }
                window.onload = changeCode;
			</script>
	<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>