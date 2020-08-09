@extends( 'content-editor::editors.layout')

@section( 'label' )
    @include( 'content-editor::partials.label', [ 'name' => $name, 'label' => 'Entity Id'])
@endsection

@section( 'editor' )
    <input type="text" id="{{ $name }}" class="content-editor-input  rounded border border-gray-400 p-2" name="{{ $name }}" value="{{ $component->entity_id }}" />
@endsection
