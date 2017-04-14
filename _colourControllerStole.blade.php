<?php
use App\Colour;


$stole_colours = Colour::getArrayByStyle('satin');
$stole_colours_gros = Colour::getArrayByStyle('grosgrain ribbon');
$stole_colours_ribbon = Colour::getArrayByStyle('satin');

?>


<div id="colours_satin_base" class="hidden">
	<h5>Stole Color (Satin)</h5>


	<div style="clear: both;"></div>

	<?php foreach( $stole_colours as $colour => $name):?>
	      <div title="<?php echo $name;?>" alt="<?php echo $name;?>" onClick="stole.manipulateSvgPath('stole_base', '<?php echo $colour;?>');return false" class="circle selector" style="background-color: <?php echo $colour;?>;">&nbsp;</div>
	<?php endforeach;?>
</div>

<div style="clear: both;"></div>

<div id="colours_satin_reversible" class="hidden">
	<h5>Reversible Color (Satin)</h5>


	<div style="clear: both;"></div>

	<?php foreach( $stole_colours as $colour => $name):?>
	      <div title="<?php echo $name;?>" alt="<?php echo $name;?>" onClick="stole.manipulateSvgPath('stole_reverse', '<?php echo $colour;?>');return false" class="circle selector" style="background-color: <?php echo $colour;?>;">&nbsp;</div>
	<?php endforeach;?>
</div>

<div style="clear: both;" ></div>
<div id="colours_satin_trim" class="hidden" >
	<h5>Trim Color (Satin)</h5>
	 <div style="clear: both;"></div>


	 <?php foreach( $stole_colours as $colour => $name):?>
	      <div title="<?php echo $name;?>" alt="<?php echo $name;?>" onClick="stole.manipulateSvgPath('stole_trim', '<?php echo $colour;?>');return false" class="circle selector" style="background-color: <?php echo $colour;?>;">&nbsp;</div>
	<?php endforeach;?>
</div>

<div style="clear: both;"></div>


<div id="colours_bose_trim"  class="hidden">
	<h5>Trim Color (Grosgrain Ribbon)</h5>

	 <div style="clear: both;"></div>

	 <?php foreach( $stole_colours_gros as $colour => $name):?>
	      <div title="<?php echo $name;?>" alt="<?php echo $name;?>" onClick="stole.manipulateSvgPath('stole_trim', '<?php echo $colour;?>');return false" class="circle selector" style="background-color: <?php echo $colour;?>;">&nbsp;</div>
	<?php endforeach;?>
</div>

<div style="clear: both;"></div>