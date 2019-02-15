<form method="POST" enctype="multipart/formdata">
	<fieldset class="form-group">
		<select name="student_id" >
			@foreach ($students as $student)
				<option value="{{ $student->student_id }}">{{ $student->firstname . $student->lastname }}</option>
			@endforeach
		</select>
		<select name="position_id" >
			@foreach ($positions as $position)
				<option value="{{ $position->id }}">{{ $position->name }}</option>
			@endforeach
		</select>
		<textarea name="platforms" cols="30" rows="10"></textarea>
		<label>Profile : </label>
		<input type="file" name="candidate_profile">
		<input type="submit" value="add">
	</fieldset>

</form>
