<div class="component-editor">
    <label for="{{ $name }}">Text</label>
    <div class="content-editor-trix-content">
        <input id="{{ $name }}" value="{{ $component->text }}" type="hidden" name="{{ $name }}" class="content-editor-input">
        <trix-editor input="{{ $name }}"></trix-editor>
    </div>
</div>
