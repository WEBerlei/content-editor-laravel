<ul>
    @foreach( $component->getMedia( 'files' ) as $media )
        <li><a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }}</a></li>
    @endforeach
</ul>
