 <label for="title" style="font-size:18px;">{{ 'Title' }}</label>
 <div class="form-group">
      <div class="form-line">
        <input class="form-control" name="title" type="text" id="title" value="{{ isset($post->title) ? $post->title : ''}}" required>
     {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
      </div>
 </div>
 <label for="description" style="font-size:18px;">{{ 'Description' }}</label>
 <div class="form-group">
      <div class="form-line">
        <textarea class="form-control ckeditor" rows="5" name="description" type="textarea" id="description" >{{ isset($post->description) ? $post->description : ''}}</textarea>
     {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
      </div>
 </div>
 <label for="status" style="font-size:18px;">{{ 'Status' }}</label>
 <div class="form-group">
      <div class="form-line">
        <select name="status" class="form-control" id="status" >
    @foreach (json_decode('{"1": "Active", "0": "Disabled"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($post->status) && $post->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
     {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
      </div>
 </div>

<button type="submit" class="btn btn-success btn-lg m-t-15 waves-effect col-md-offset-5" style="font-size: 18px;border: double"><i class="material-icons">create</i>{{ $formMode === 'edit' ? 'Update' : 'Create' }}</button>
