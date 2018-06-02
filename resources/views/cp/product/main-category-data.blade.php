<select id="maincategory_id" name="maincategory_id" class="form-control">
	
	@foreach($data as $row)			
		<option value="{{ $row->id }}">{{ $row->en_name }}</option>	
	@endforeach		
</select>