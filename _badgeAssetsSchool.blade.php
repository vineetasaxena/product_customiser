<?php use App\School;?>
<?php echo $school_id = Request::session()->get('school_id', 0); ?>

<?php $responses = School::getAssets($school_id, true);?>


<?php $school_name = School::getSchoolName($school_id, Request::session()->get('rep_number', 0));?>

<?php $asset_path = str_replace('!!CUSTOMERNUM!!', $school_id, Config::get('images.asset_storage'));?>

<?php $file_list = $badge->getListDownloaded($asset_path);?>

<?php $base_path    = Config::get('badges.base_path');?>
<?php $rowItemCount = 2;?>
<?php $count        = 0;?>
@if(count($file_list))
<?php foreach ($file_list as $file): ?>


	<?php if ($count % $rowItemCount == 0): ?>
		<div class="row">
		<?php $opened = true;?>
	<?php endif?>


	<?php $file_name = preg_replace('/\s+/', '_', $school_name . ' ' . preg_replace('/\.svg/i', '', $file));?>

	<div class="col-xs-6">
		<img data-finish="embroidery" data-disallow-finish="none"  data-editable="true"
		title="<?php echo $file_name; ?>"
		alt="<?php echo $file_name; ?>"
		id="<?php echo $file_name; ?>" src="<?php echo $asset_path; ?><?php echo $file; ?>"
		draggable="true" class="img-responsive img-prev draggable"/>
	</div>

	<?php $count++;?>
	<?php if ($count % $rowItemCount == 0): ?>
		<?php if ($opened): ?>
			<?php $opened = false;?>
			</div>
		<?php endif;?>
	<?php endif;?>
<?php endforeach;?>

<?php if ($opened): ?>
	<?php $opened = false;?>
	</div>
<?php endif;?>
@endif
