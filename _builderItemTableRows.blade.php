@foreach($builderItems as $builderItem)
<tr>
	<td><input type="checkbox" name="post[]" value="2"></td>
	<td>{{ $builderItem->title }}</td>
	<td>
		{{ date('M d, Y', strtotime($builderItem->created_at)) }}
	</td>

	<!-- we will also add show, edit, and delete buttons -->
	<td>
	<!-- edit this record (uses the edit method found at GET /bi/{id}/edit -->
	<a class="btn btn-default btn-xs" href="{{ URL::to('bi/' . $builderItem->id . '/edit') }}">Edit <i class="fa fa-edit"></i></a>

	<!-- delete the user (uses the destroy method DESTROY /users/{id} -->
	{!! Form::open(array('url' => 'bi/'. $builderItem->builder_item_type . '/' . $builderItem->id, 'class' => 'delete_form pull-right')) !!}
		{!! Form::hidden('_method', 'DELETE') !!}
		{{-- {!! Form::submit('Delete <i class="fa fa-trash-o"></i>', array('class' => 'btn btn-warning')) !!} --}}
		<button class="btn btn-default btn-xs btn-danger del-confirm" type="submit">Delete <i class="fa fa-trash-o"></i></button>
	{!! Form::close() !!}
	</td>
</tr>
@endforeach