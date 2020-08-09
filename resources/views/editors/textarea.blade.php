@extends( 'content-editor::editors.layout')

@section( 'label' )
    @include( 'content-editor::partials.label', [ 'name' => $name, 'label' => 'Text'])
@endsection

@section( 'editor' )
    <textarea id="{{ $name }}" class="content-editor-input w-full rounded border border-gray-400 p-2" rows="4" name="{{ $name }}">{{ $component->text }}</textarea>
@endsection
