@extends( 'content-editor::editors.layout')

@section( 'label' )
    @include( 'content-editor::partials.label', [ 'name' => $name, 'label' => $component->getName() ])
@endsection

@section( 'editor' )
    <select id="{{ $name }}" class="content-editor-input  rounded border border-gray-400 p-2" name="{{ $name }}" >
        @foreach( $entities as $key => $value )
            <option value="{{ $key }}" {{ $component->entity_id == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
        @endforeach
    </select>
@endsection
