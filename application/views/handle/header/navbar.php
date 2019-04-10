<?php
$ac = array('','','','','','','','','','','','','');
if (!isset($pag)) { $pag = 0; }
$ac[$pag] = 'active';
?>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo base_url('index.php/main'); ?>"><span class="glyphicon glyphicon-list" style="color: red;" aria-hidden="true"></span> <font color="blue">ReDD</font></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="<?php echo $ac[0];?>">
					<a href="<?php echo base_url('index.php/handle'); ?>"><?php echo msg('Home'); ?>
					<span class="sr-only">(current)</span></a>
				</li>
				<li class="<?php echo $ac[1];?>">
					<a href="<?php echo base_url('index.php/handle/select/'); ?>">Selecinar projeto</a>
				</li>
                <li class="<?php echo $ac[1];?>">
                    <a href="<?php echo base_url('index.php/handle/cover/'); ?>">Folha de Rosto</a>
                </li>
				<li class="<?php echo $ac[1];?>">
					<a href="<?php echo base_url('index.php/handle/process/'); ?>">Processar Lote</a>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>