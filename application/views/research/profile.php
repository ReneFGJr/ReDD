<div class="row">
	<div class="col-md-2 col-sm-2 col-xs-2">
		FOTO
	</div>
	<div class="col-md-9 col-sm-9 col-xs-9">
		<span class="small"><?php echo msg('name');?></span><br>
		<span class="big"><?php echo $r_name;?></span>
		<br>
		<span class="small"><?php echo msg("link_lattes");?></span><br>
		<span class="std"><a href="<?php echo ($r_lattes);?>" target="_new"><?php echo ($r_lattes);?></a></span>
	</div>
	<div class="col-md-1 col-sm-1 col-xs-1 text-right">
		<span class="small"><?php echo msg('last_update');?></span><br>
		<span class="std"><?php echo stodbr($r_lastupdate);?></span>
		<br>
		<a href="<?php echo base_url('index.php/research/id/'.$id_r.'/inport');?>" class="btn btn-default">
		<img src="<?php echo base_url('img/icon/icone_import.png');?>" style="width: 32px">
		<br><span class="small">lattes.cnpq.br</span>
		</a>
	</div>
</div>
