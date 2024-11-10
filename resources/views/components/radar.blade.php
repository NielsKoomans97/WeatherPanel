@php
    use App\Http\Helpers\Helpers;
@endphp

<div class="radar">
    @php
        $frames = Helpers::GetFrameSet($manifest);
        $manifestJson = json_decode(file_get_contents('manifests/' . $manifest));
    @endphp

    @if (!empty($manifestJson->extra_layers))

        @php
            $index = 0;
        @endphp
        @foreach ($manifestJson->extra_layers as $key => $value)
            <img src="{{ $value }}" class="{{ $key }}" data-index="{{ $index }}">
            @php
                $index++;
            @endphp
        @endforeach

    @endif

    @foreach ($frames as $frame)
        <x-radar.frame :frame_set="$frame" icon="{{ $manifestJson->icon }}" brand="{{ $manifestJson->prettyname }}" />
    @endforeach

    <x-radar.controls :frames="$frames" />
</div>
