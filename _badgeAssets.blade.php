<?php $file_list = $badge->getList($asset_path);?>

<?php $base_path = Config::get('badges.base_path'); ?>
<?php $rowItemCount = 2 ?>
<?php $count = 0 ?>
<?php foreach($file_list as $file):?>

	
	<?php if($count%$rowItemCount == 0): ?>
		<div class="row">
		<?php $opened = true; ?>			
	<?php endif ?>

	<div class="col-xs-6">
		<img data-finish="embroidery" data-disallow-finish="none"  data-editable="true" 
		title="<?php echo preg_replace('/\./', '_', $file);?>"
		alt="<?php echo preg_replace('/\./', '_', $file);?>"
		id="<?php echo preg_replace('/\./', '_', $file);?>" src="/<?php echo $base_path . $asset_path;?><?php echo $file;?>" 
		draggable="true" class="img-responsive img-prev draggable"/>
	</div>
	
	<?php $count++; ?>
	<?php if($count%$rowItemCount == 0): ?>
		<?php if($opened): ?>
			<?php $opened = false; ?>	
			</div>
		<?php endif; ?>	
	<?php endif; ?>
<?php endforeach;?>

<?php if($opened): ?>
	<?php $opened = false; ?>	
	</div>
<?php endif; ?>	