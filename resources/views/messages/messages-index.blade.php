<ul class="list-group">
    <a href="{{ route('messages.index') }}">
        <li>All</li>
    </a>
    @foreach($science_tags as $science_tag)
        <a href="{{ route('messages.index', ['science_tags'=>$science_tag->id]) }}">
            <li>{{ $science_tag->science_name }}</li>
        </a>
    @endforeach
</ul>
