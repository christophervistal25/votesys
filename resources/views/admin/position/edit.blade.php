<form method="POST" action="/admin/position/update/{{$position->id}}">
        <fieldset class="form-group" >
            <label for="formGroupExampleInput">Example label</label>
        <input name="name" type="text" class="form-control" id="formGroupExampleInput" value="{{$position->name}}" placeholder="Example input">
        </fieldset>
        <fieldset class="form-group">
            <label for="formGroupExampleInput2">Another label</label>
            <input name="limit" type="number" class="form-control" id="formGroupExampleInput2" value={{$position->limit}}>
        </fieldset>
        <input type="submit" value="update">
    </form>
    