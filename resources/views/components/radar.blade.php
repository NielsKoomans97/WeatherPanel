@php
    use App\Http\Helpers\Helpers;
@endphp

<div class="radar">
    @php
        $frames = Helpers::GetFrameSet($manifest);
        $manifestJson = json_decode(file_get_contents('manifests/' . $manifest));
    @endphp

    @if (!empty($manifestJson->extra_layers))
        @foreach ($manifestJson->extra_layers as $key => $value)
            <img src="{{ $value }}" class="{{ $key }}">
        @endforeach
    @endif

    @foreach ($frames as $frame)
        <x-radar.frame :frame_set="$frame" />
    @endforeach
</div>
