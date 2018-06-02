<select id="category_id" name="category_id" class="form-control">
	
	@foreach($data as $row)			
		<option value="{{ $row->id }}">{{ $row->name }}</option>	
	@endforeach		
</select>