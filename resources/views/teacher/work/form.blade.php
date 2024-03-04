<div class="row">

	<div class="input-field col s12 l6">

		<i class="fa fa-file-text-o prefix"></i>

		{!! Form::text('name', null,['id' => 'name','required' => 'required']) !!}

		<label for="name"> Work Name *</label>

	</div>


	<div class="input-field col s12 l6">

		<i class="fa fa-pencil-square-o prefix"></i>

		{!! Form::text('desc',null,['id' => 'desc', 'required' => 'required']) !!}

		<label for="desc"> Description *</label>

	</div>

</div>


<div class="row">

	

	<div class="input-field col s12">

		<div class="input-field col s12">

			<button class="btn purple waves-effect waves-light right" type="submit" name="action">Submit <i class="mdi-content-send right"></i></button>

		</div>

	</div>

</div>