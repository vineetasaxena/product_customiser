<?php

use App\RulesCover;

?>

<?php if ($collection_object->method == 'personalization' or $collection_object->method == 'foils'): ?>
	<div>
		<div style="clear: both;"></div>
		<?php foreach ($colours as $colour): ?>
	 		<div title="<?php echo $colour->name; ?>" alt="<?php echo $colour->name; ?>"
		      onClick="cover.changeColor('<?php echo $rule->action; ?>', '<?php echo $colour->rgb; ?>', '<?php echo $colour->name; ?>', '<?php echo $colour->effect; ?>', false);
				cover.addPattern('<?php echo $rule->action; ?>', 'foils', '<?php echo $colour->rgb; ?>');

		      return false"
		      class="circle selector" style="background-color: <?php echo $colour->rgb; ?>;">&nbsp;</div>
		<?php endforeach;?>
	</div>
	<div style="clear: both;"></div>
<?php else: ?>
	<div>
		<div style="clear: both;"></div>

			<?php $effect = '';?>

			<?php $bur_object = RulesCover::hasBurnishing($cover->id, $rule->action);?>
			<?php if ($bur_object): ?>



				<div title="<?php echo $bur_object->condition_two; ?>" alt="<?php echo $bur_object->condition_two; ?>"
		      	onClick="cover.changeColor('<?php echo $rule->action; ?>', 'rgba(0,0,0,0.3)', '<?php echo $bur_object->condition_two; ?>', '<?php echo $bur_object->condition_two; ?>', true);
		      	return false"
		      	class="burnishing_layer circle selector"
		      	style="background: url('/images/buttons/button_uv.png');
		      	background-size: contain; text-align: center; vertical-align: middle;">BUR</div>

			<?php endif;?>

			<?php if (preg_match('/(art|title|year|celebrate|anniversary)/', $rule->action)): ?>



				<div title="350 UV Clear" alt="350 UV Clear"
		      	onClick="cover.changeColor('<?php echo $rule->action; ?>', 'rgba(0,0,0,0.3)', '350 UV Clear', '350 UV Clear', true);
		      	return false"
		      	class="uv_layer hidden circle selector"
		      	style="background: url('/images/buttons/button_uv.png');
		      	background-size: contain; text-align: center; vertical-align: middle;">UV</div>

			<?php endif;?>

		<?php foreach ($colours as $colour): ?>

			<?php $uv_enable = (bool) $colour->isUvColour();?>

			<?php if ($colour->collection == 'material'): ?>

				<?php if ($colour->effect != $effect): ?>

					<p style="clear: both;"><strong><?php echo $colour->effect; ?></strong></p>
					<?php $effect = $colour->effect;?>
				<?php endif;?>


				<div title="<?php echo $colour->effect . ' - ' . $colour->name; ?>" alt="<?php echo $colour->effect . ' - ' . $colour->name; ?>"
		     		 onClick="cover.changeColor('<?php echo $rule->action; ?>', '<?php echo $colour->rgb; ?>', '<?php echo $colour->name; ?>', '<?php echo $colour->effect; ?>', false);
						cover.configureUv('<?php echo $rule->action; ?>', <?php echo (int) $uv_enable; ?>);
						cover.addPattern('<?php echo $rule->action; ?>', 'material_<?php echo $colour->getStrippedEffect(); ?>', '<?php echo $colour->rgb; ?>');
		      			return false"
		      			class="circle selector" style="background-color: <?php echo $colour->rgb; ?>;">&nbsp;</div>
			<?php else: ?>
	 			<div title="<?php echo $colour->name; ?>" alt="<?php echo $colour->name; ?>"
		      	onClick="cover.changeColor('<?php echo $rule->action; ?>', '<?php echo $colour->rgb; ?>', '<?php echo $colour->name; ?>', '<?php echo $colour->effect; ?>', true);
		      	return false"
		      	class="circle selector" style="background-color: <?php echo $colour->rgb; ?>;">&nbsp;</div>

		     <?php endif;?>
		<?php endforeach;?>
	</div>
	<div style="clear: both;"></div>

	<?php if (preg_match('/art/', $rule->action)): ?>
		<p><strong>Glitter Effects</strong> (applied over ink)</p>
		<div>
		<div style="clear: both;"></div>
					<div title="Toggle UV Gold Glitter" alt="Toggle  UV Gold Glitter"
			      	onClick="cover.addGlitter('<?php echo $rule->action; ?>', 'glitter_gold', 'UV Gold Glitter');
			      	return false"
			      	class=" circle selector" style="background: url('/images/buttons/button_uv_gold.png'); background-size: contain;">&nbsp;</div>


			      	<div title="Toggle  UV Silver Glitter" alt="Toggle  UV Silver Glitter"
			      	onClick="cover.addGlitter('<?php echo $rule->action; ?>', 'glitter_silver', 'UV Silver Glitter');
			      	return false"
			      	class="circle selector" style="background: url('/images/buttons/button_uv_silver.png'); background-size: contain;">&nbsp;</div>

			      <!-- 	<div title="Toggle UV Rainbow Glitter" alt="Toggle UV Rainbow Glitter"
			      	onClick="cover.addGlitter('<?php echo $rule->action; ?>', 'glitter_rainbow', 'UV Rainbow Glitter');
			      	return false"
			      	class=" circle selector" style="background: url('/images/buttons/button_uv_rainbow.png'); background-size: contain;">&nbsp;</div> -->
	      	</div>
		<div style="clear: both;"></div>
	<?php endif;?>
<?php endif;?>