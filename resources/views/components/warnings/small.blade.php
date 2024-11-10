<div class="warning-widget small">
    @php
        use App\Http\Helpers\Weather;

        $locations = Weather::getBuienradarWarnings();
    @endphp

    <span class="alert-amount">{{ count($locations) }} provincies</span>
</div>