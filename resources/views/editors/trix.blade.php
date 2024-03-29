@extends( 'content-editor::editors.layout')

@section( 'label' )
    @include( 'content-editor::partials.label', [ 'name' => $name, 'label' => 'Trix text'])
@endsection

@section( 'editor' )
    <input id="{{ $name }}" value="{{ $component->text }}" type="hidden" name="{{ $name }}" class="content-editor-input">
    <trix-editor style="min-height:200px" class="prose w-full max-w-none" input="{{ $name }}"></trix-editor>
@endsection

