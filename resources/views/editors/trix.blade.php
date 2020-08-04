<div class="bg-white overflow-hidden shadow rounded-lg">
    <div class="bg-gray-50 border-b border-gray-200 px-4 py-5 sm:px-6">
        <label for="{{ $name }}" class="text-lg leading-6 font-medium text-gray-900">
            Text
        </label>
    </div>
    <div class="px-4 py-5 sm:p-6">
        <input id="{{ $name }}" value="{{ $component->text }}" type="hidden" name="{{ $name }}" class="content-editor-input">
        <trix-editor style="min-height:500px" input="{{ $name }}"></trix-editor>
    </div>
</div>


