<?php use App\School;?>
<?php use App\User;?>

		@foreach($builderItems as $builderItem)

        <div class="saved-item grid-item">
	      <div class="itemBody">
	        <div class="itemContainer" style="text-align:center;">
	          <div class="actions">
	            <div class="actionBtns">
	              <a href="{{ URL::to('bi/'. $builderItem->builder_item_type .'/edit/' . $builderItem->id) }}"><i class="fa fa-pencil fa-2x"></i><br>Edit</i></a>
	              <!-- delete the user (uses the destroy method DESTROY /users/{id} -->
				{!! Form::open(array('url' => 'bi/'. $builderItem->builder_item_type . '/' . $builderItem->id, 'class' => 'delete_form')) !!}
					{!! Form::hidden('_method', 'DELETE') !!}
					{{-- {!! Form::submit('Delete <i class="fa fa-trash-o"></i>', array('class' => 'btn btn-warning')) !!} --}}
					<button class="actionBtn del-confirm" type="submit"><i class="fa fa-trash-o fa-2x"></i><br>Delete</button>
				{!! Form::close() !!}
	            </div>
	          </div>
	          <?php  //print_r($builderItem);
			if (strlen($builderItem->filename)): ?>
	          		<img class="grid-item-image" src="<?php echo $builderItem->filename; ?>?ts=<?php echo strtotime($builderItem->updated_at); ?>" alt=""/>
          	  <?php else: ?>
	          		<img class="grid-item-image" src="/images/Master_Gown.svg" alt="" />
	      		<?php endif;?>
	        </div>
	        <div class="itemName" style="text-align:center;">
	          <h5><?php if (strlen($builderItem->design_name)): ?><?php echo $builderItem->design_name; ?><?php else: ?>&nbsp;<?php endif;?></h5>
	          <h5><?php echo date('D j, F, Y', strtotime($builderItem->created_at)); ?>

					  <?php if (strlen($builderItem->filename_pdf)): ?>

					  	<a href="<?php echo $builderItem->filename_pdf; ?>" target="_new" title="PDF" alt="PDF"><i class="fa fa-book"></i></a>
					  <?php endif;?>


					  <a href="{{ URL::to('email/'. $builderItem->builder_item_type .'/' . $builderItem->id) }}" title="Email" alt="Email"><i class="fa fa-envelope"></i></a>
	          </h5>

	          <h5>
	          	<?php echo School::getSchoolName($builderItem->school_id, User::getRepNumberById($builderItem->user_id), ''); ?>&nbsp;
	          </h5>
	        </div>
	      </div>
	    </div>

		@endforeach
