@php
    use App\Http\Helpers\Helpers;
@endphp

<div class="radar">
    @php
        $frames = Helpers::GetFrameSet($manifest);
    @endphp

    @foreach($frames as $frame)
        <x-radar.frame :frame_set="$frame" />
    @endforeach
</div> 