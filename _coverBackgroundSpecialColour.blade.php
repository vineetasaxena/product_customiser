<?php
use App\ColourCover;
use App\RulesCover;

$backgroundColours['custom']    = array();
$backgroundColours['custom'][]  = 'Earthstone';
$backgroundColours['custom'][]  = 'Fabrikoid';
$backgroundColours['custom'][]  = 'Leathertone';
$backgroundColours['premium']   = array();
$backgroundColours['premium'][] = 'Aurora';
$backgroundColours['premium'][] = 'Chic';
$backgroundColours['premium'][] = 'Flax';
$backgroundColours['premium'][] = 'Metal Flake';
$backgroundColours['premium'][] = 'Metallic Fabrikoid';
$backgroundColours['premium'][] = 'Natural';
$backgroundColours['premium'][] = 'Radiance';
$backgroundColours['premium'][] = 'Regal';

$reduced_op_colours = ColourCover::getReducedOpacityColours();

?>



<div class="panel panel-default" id="parent_choice_rule_<?php echo stripText($rule->name); ?>" class="hidden">
        <button class="accordion-toggle collapsed collection_choice" data-toggle="collapse" data-parent="#panel_details" data-target="#detail_choice_option_<?php echo stripText($rule->name); ?>">
             <?php if (strlen($title) and $rule->action != 'personalization'): ?><?php echo $title; ?><?php else: ?><?php echo $rule->name; ?><?php endif;?>
        </button>

		<div id="detail_choice_option_<?php echo stripText($rule->name); ?>" class="panel-collapse collapse">


			<?php foreach ($backgroundColours as $area => $material_array): ?>
				<p><strong>&mdash; <?php echo ucwords($area); ?></strong></p>

				<?php if ($area == 'premium'): ?><p><em>Premium Materials incur an additional costs</em></p><?php endif;?>
				<?php foreach ($material_array as $effect): ?>
					<p style="clear: both;"><strong><?php echo $effect; ?></strong></p>
					<?php $colours = ColourCover::getArrayByStyle('material', '', true, $effect); // change this ?>
					<div>
						<div style="clear: both;"></div>


						<?php foreach ($colours as $colour): ?>

							<?php $uv_enable      = (bool) $colour->isUvColour();?>
							<?php $burnish_enable = (bool) $colour->isBurnishColour();?>
							<?php $bur_object     = RulesCover::hasBurnishing($cover->id, $rule->action);?>
							<?php if (!$bur_object): ?>
								<?php $burnish_enable = false;?>
							<?php endif;?>


							<?php if ($colour->collection == 'material'): ?>

								<?php $opacity = '1.0';?>
								<?php if (in_array($colour->name, $reduced_op_colours)): ?>
										<?php $opacity = '0.4';?>
								<?php endif;?>


								<div title="<?php echo $colour->effect . ' - ' . $colour->name; ?>" alt="<?php echo $colour->effect . ' - ' . $colour->name; ?>"
						     		 onClick="cover.changeColor('<?php echo $rule->action; ?>', '<?php echo $colour->rgb; ?>', '<?php echo $colour->name; ?>', '<?php echo $colour->effect; ?>', false,  false, '<?php echo $opacity; ?>');
										cover.configureUv('<?php echo $rule->action; ?>', <?php echo (int) $uv_enable; ?>);
										cover.configureBurnishing('<?php echo $rule->action; ?>', <?php echo (int) $burnish_enable; ?>);
										cover.addPattern('<?php echo $rule->action; ?>', 'material_<?php echo $colour->getStrippedEffect(); ?>', '<?php echo $colour->rgb; ?>', '<?php echo $opacity; ?>');
						      			return false"
						      			class="circle selector" style="background-color: <?php echo $colour->rgb; ?>;">&nbsp;</div>
							<?php else: ?>
					 			<div title="<?php echo $colour->name; ?>" alt="<?php echo $colour->name; ?>"
						      	onClick="cover.changeColor('background', '<?php echo $colour->rgb; ?>', '<?php echo $colour->name; ?>', '<?php echo $colour->effect; ?>', true);
						      	return false"
						      	class="circle selector" style="background-color: <?php echo $colour->rgb; ?>;">&nbsp;</div>

						     <?php endif;?>
						<?php endforeach;?>


					</div>
					<div style="clear: both;"></div>
				<?php endforeach;?>
			<?php endforeach;?>



		</div>

	</div>