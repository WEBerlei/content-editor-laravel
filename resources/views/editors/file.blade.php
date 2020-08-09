@extends( 'content-editor::editors.layout')

@section( 'label' )
    @include( 'content-editor::partials.label', [ 'name' => $name, 'label' => 'File path'])
@endsection

@section( 'editor' )
    <div class="myDropzone border dropzone text-center" max-files="5" id="myDropzone"></div>
@endsection
