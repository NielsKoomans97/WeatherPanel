   @php
       use App\Http\Helpers\Weather;

       $locations = Weather::getBuienradarWarnings();
       $code = Weather::getBuienradarWarningCode();
   @endphp

   <a href="{{ route('warnings.index') }}">
       <div class="warning-widget small {{ $code }}">
           <x-icon iconCode="exclamation-diamond-fill" />
           <span class="alert-amount">
               @if (count($locations) > 0)
                   {{ count($locations) }} provincies
               @else
                   Geen waarschuwingen
               @endif
           </span>
       </div>
   </a>
