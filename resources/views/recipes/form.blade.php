<?php
?>
<div class="form-group">
    <form method="POST" action="{{ $formPath ?? '' }}">
    @csrf
    @method($formMethod)
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" value="{{ $recipe->name }}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $recipe->description }}</textarea>
        </div>

        <autocomplete></autocomplete> 

        <button type="submit" class="form-control btn-success">{{ $buttonText ?? 'Submit' }}</button>
    </form>
</div>