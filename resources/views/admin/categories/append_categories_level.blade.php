<div class="form-group">
    <label>Main Categories</label>
    <select class="form-control select2" id=""; name="parent_id" style="width: 100%;">
        <option value="0" @if(isset($category['parent_id']) && $category['parent_id'] == 0) selected @endif>Main Category</option>
        @if(!empty($categories))
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" @if(isset($category['parent_id']) && $category['parent_id'] == $cat->id) selected @endif >{{ $cat->category_name }}</option>
            @if(!empty($cat->subcategories))
                @foreach($cat->subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}" >&nbsp; &rArr; &nbsp;{{ $subcategory->category_name }}</option>                    
                @endforeach
                @endif            
        @endforeach
        @endif
    </select>
</div>