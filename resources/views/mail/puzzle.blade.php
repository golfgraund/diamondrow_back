<html>
@php
 $puzzle = $params['puzzle'];
@endphp
@isset($puzzle->codes->code)
<p><b>Ваш код:</b> {{$puzzle->codes->code}} </p>
@endisset
@isset($puzzle->codes->code)
<p><b>Осталось попыток:</b> {{($puzzle->codes->used_count >= env('ATTEMPTS_CODE_COUNT', 5)) ? 0 : env('ATTEMPTS_CODE_COUNT', 5) - $puzzle->codes->used_count}} </p>
@endisset
@isset($puzzle->slug)
<p><b>Ссылка на интерактивную инструкцию:</b> {{ route('web.puzzle.show', ['slug' => $puzzle->slug]) }}</p>
@endisset
</html>
