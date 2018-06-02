<select id="subcategory_id" name="subcategory_id" class="form-control">
	<option value="0" >Please Select Sub Category</option>
	@foreach($data as $row)			
		<option value="{{ $row->id }}">{{ $row->en_name }}</option>	
	@endforeach		
</select>

<script type="text/JavaScript">
		$(document).ready(function(event){
		
			$('#form').validate({
				modules : 'file',
				submit: {
					settings: {
						inputContainer: '.form-group',
						errorListClass: 'form-tooltip-error'
					}
				}
			}); 

			$("#subcategory_id").change(function(){
				getMainCategory($(this).val());
				$("#maincategory_id").html('<option id="0" >Select Main Category</option>');
			})
		}); 