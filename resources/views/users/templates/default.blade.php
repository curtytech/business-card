<div class="card default-template">
    <div class="card-header">
        <img src="{{ $user->image ? asset('storage/'.$user->image) : asset('favicon.ico') }}" alt="{{ $user->name }}" />
        <h1>{{ $user->name }}</h1>
    </div>

    <div class="card-body">
        <p>{{ $user->email }}</p>
        @if ($user->phone)
            <p>{{ $user->phone }}</p>
        @endif

        @if ($user->facebook || $user->instagram || $user->twitter || $user->linkedin)
            <div class="socials">
                @if ($user->facebook)<a href="{{ $user->facebook }}" target="_blank">Facebook</a>@endif
                @if ($user->instagram)<a href="{{ $user->instagram }}" target="_blank">Instagram</a>@endif
                @if ($user->twitter)<a href="{{ $user->twitter }}" target="_blank">Twitter/X</a>@endif
                @if ($user->linkedin)<a href="{{ $user->linkedin }}" target="_blank">LinkedIn</a>@endif
            </div>
        @endif

        @if (is_array($user->other_social_networks))
            <div class="other-socials">
                @foreach ($user->other_social_networks as $network => $url)
                    @if ($network && $url)
                        <a href="{{ $url }}" target="_blank">{{ $network }}</a>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>