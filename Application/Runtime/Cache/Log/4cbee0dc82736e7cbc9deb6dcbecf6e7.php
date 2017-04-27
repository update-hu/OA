<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>OA系统</title>
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
								注销
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
					<a href="index.html">
						<i class="icon-dashboard"></i>
						<span class="menu-text"> 控制台 </span>
					</a>
				</li>

				<li>
					<a href="#" class="dropdown-toggle">
						<i class="icon-user"></i>
						<span class="menu-text"> 员工管理 </span>

						<b class="arrow icon-angle-down"></b>
					</a>

					<ul class="submenu">
						<li>
							<a href="/OA/index.php/Employee/List/showList">
								<i class="icon-double-angle-right"></i>
								员工列表
							</a>
						</li>

						<li>
							<a href="/OA/index.php/Employee/FillInfo/addMessage">
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
							<a href="/OA/index.php/Department/List/showList">
								<i class="icon-double-angle-right"></i>
								部门列表
							</a>
						</li>

						<li>
							<a href="/OA/index.php/Department/FillInfo/addDepartment">
								<i class="icon-double-angle-right"></i>
								添加部门
							</a>
						</li>
					</ul>
				</li>

				<li class="active open">
					<a href="#" class="dropdown-toggle">
						<i class="icon-book"></i>
						<span class="menu-text"> 日志管理 </span>

						<b class="arrow icon-angle-down"></b>
					</a>

					<ul class="submenu">
						<li class="open">
							<a href="/OA/index.php/Log/List/showList">
								<i class="icon-double-angle-right"></i>
								日志列表
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

				<li>
					<a href="#" class="dropdown-toggle">
						<i class="icon-adjust"></i>
						<span class="menu-text"> 培训管理 </span>

						<b class="arrow icon-angle-down"></b>
					</a>

					<ul class="submenu">
						<li>
							<a href="/OA/index.php/Train/List/showList">
								<i class="icon-double-angle-right"></i>
								培训列表
							</a>
						</li>

						<li>
							<a href="/OA/index.php/Train/FillTrain/addTrain">
								<i class="icon-double-angle-right"></i>
								新增培训
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
						<a href="#">日志</a>
					</li>
					<li class="active">日志列表</li>
				</ul><!-- .breadcrumb -->
			</div>

			<div class="page-content">
				<div class="row">
					<div class="col-xs-12">

						<div class="row">
							<div class="col-xs-12">
								<h3 class="header smaller lighter blue">日志列表</h3>
								<div class="table-header">
									所有日志
								</div>
								<div class="table-responsive">
									<table id="sample-table-1" class="table table-striped table-bordered table-hover">

										<thead>
										<tr>
											<th>日志名称</th>
											<th >日志状态</th>
											<th>日志级别</th>
											<th>日志作者</th>
											<th>日志提交时间</th>
											<th></th>
										</tr>
										</thead>

										<tbody>
										<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$log): $mod = ($i % 2 );++$i;?><tr>

											<td>
												<a href="#"><?php echo ($log["log_name"]); ?></a>
											</td>
											<td><?php echo ($log["check"]); ?></td>
											<td><?php echo ($log["grade"]); ?></td>
											<td><?php echo ($log["emp_name"]); ?></td>
											<td><?php echo ($log["create_time"]); ?></td>

											<td>
												<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">

													<a class="blue" href="/OA/index.php/Log/List/showLog?log_id=<?php echo ($log["log_id"]); ?>">
														<i class="icon-zoom-in bigger-130"></i>
													</a>

													<a class="green" href="/OA/index.php/Log/List/showEditLog?log_id=<?php echo ($log["log_id"]); ?>">
														<i class="icon-pencil bigger-130"></i>
													</a>

													<a class="red" href="/OA/index.php/Log/List/deleteLog?log_id=<?php echo ($log["log_id"]); ?>">
														<i class="icon-trash bigger-130"></i>
													</a>
												</div>

												<div class="visible-xs visible-sm hidden-md hidden-lg">
													<div class="inline position-relative">
														<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
															<i class="icon-caret-down icon-only bigger-120"></i>
														</button>

														<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">

															<li>
																<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																				<span class="blue">
																					<i class="icon-zoom-in bigger-120"></i>
																				</span>
																</a>
															</li>

															<li>
																<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="icon-edit bigger-120"></i>
																				</span>
																</a>
															</li>

															<li>
																<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																				<span class="red">
																					<i class="icon-trash bigger-120"></i>
																				</span>
																</a>
															</li>
														</ul>
													</div>
												</div>
											</td>
										</tr><?php endforeach; endif; else: echo "" ;endif; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div id="modal-table" class="modal fade" tabindex="-1">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header no-padding">
										<div class="table-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												<span class="white">&times;</span>
											</button>
											Results for "Latest Registered Domains
										</div>
									</div>

									<div class="modal-body no-padding">
										<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
											<thead>
											<tr>
												<th>Domain</th>
												<th>Price</th>
												<th>Clicks</th>

												<th>
													<i class="icon-time bigger-110"></i>
													Update
												</th>
											</tr>
											</thead>

											<tbody>
											<tr>
												<td>
													<a href="#">ace.com</a>
												</td>
												<td>$45</td>
												<td>3,330</td>
												<td>Feb 12</td>
											</tr>

											<tr>
												<td>
													<a href="#">base.com</a>
												</td>
												<td>$35</td>
												<td>2,595</td>
												<td>Feb 18</td>
											</tr>

											<tr>
												<td>
													<a href="#">max.com</a>
												</td>
												<td>$60</td>
												<td>4,400</td>
												<td>Mar 11</td>
											</tr>

											<tr>
												<td>
													<a href="#">best.com</a>
												</td>
												<td>$75</td>
												<td>6,500</td>
												<td>Apr 03</td>
											</tr>

											<tr>
												<td>
													<a href="#">pro.com</a>
												</td>
												<td>$55</td>
												<td>4,250</td>
												<td>Jan 21</td>
											</tr>
											</tbody>
										</table>
									</div>

									<div class="modal-footer no-margin-top">
										<button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
											<i class="icon-remove"></i>
											Close
										</button>

										<ul class="pagination pull-right no-margin">
											<li class="prev disabled">
												<a href="#">
													<i class="icon-double-angle-left"></i>
												</a>
											</li>

											<li class="active">
												<a href="#">1</a>
											</li>

											<li>
												<a href="#">2</a>
											</li>

											<li>
												<a href="#">3</a>
											</li>

											<li class="next">
												<a href="#">
													<i class="icon-double-angle-right"></i>
												</a>
											</li>
										</ul>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- PAGE CONTENT ENDS -->
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.page-content -->
		</div><!-- /.main-content -->

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

<script src="/OA/Public/assets/js/jquery.dataTables.min.js"></script>
<script src="/OA/Public/assets/js/jquery.dataTables.bootstrap.js"></script>

<!-- ace scripts -->

<script src="/OA/Public/assets/js/ace-elements.min.js"></script>
<script src="/OA/Public/assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->

<script type="text/javascript">
    jQuery(function($) {
        var oTable1 = $('#sample-table-2').dataTable( {
            "aoColumns": [
                { "bSortable": false },
                null, null,null, null, null,
                { "bSortable": false }
            ] } );


        $('table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                .each(function(){
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
                });

        });


        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
            return 'left';
        }
    })
</script>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>