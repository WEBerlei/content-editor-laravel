@extends( 'content-editor::editors.layout')

@section( 'label' )
    @include( 'content-editor::partials.label', [ 'name' => $name, 'label' => 'Image path'])
@endsection

@section( 'editor' )
    <div class="myDropzone border dropzone text-center" max-files="1" id="myDropzone"></div>
@endsection
