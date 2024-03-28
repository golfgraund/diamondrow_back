@extends('twill::layouts.free')

@section('customPageContent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <a17-fieldset title="Экспорт кодов">
        <form action="{{ $form_action_url }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <a17-custom-multi-select
                    label="Цвет"
                    name="color"
                    :options="{{ json_encode($color['options']) }}"
                    :grid="true"
                    :in-modal="false"
                    :inline='false'
                    :border='false'
                    in-store="currentValue"
            ></a17-custom-multi-select>

            <a17-custom-multi-select
                    label="Размер"
                    name="size"
                    :options="{{ json_encode($size['options']) }}"
                    :grid="true"
                    :in-modal="false"
                    :inline='false'
                    :border='false'
                    in-store="currentValue"
            ></a17-custom-multi-select>

            <a17-datepicker
                    label="Дата"
                    name="date"
                    :required="false"
                    in-store="date"
                    mode="range"
            ></a17-datepicker>

            <a17-custom-single-select
                    label="Тип документа"
                    name="doc_ext"
                    :inline="true"
                    selected="{{ $doc_ext['selected'] }}"
                    :in-modal="false"
                    :options="{{ json_encode($doc_ext['options']) }}"
                    :grid="false"
                    :disabled="false"
                    :has-default-store="true"
                    in-store="value"
            ></a17-custom-single-select>
            <br>
            <a17-button type="submit" variant="validate" size=""> Скачать </a17-button>
        </form>
    </a17-fieldset>
    @if($error['message'])
        <div id="alert_message" role="alert" aria-live="polite" aria-atomic="true" class="notif notif--error">
            <div class="notif__inner">
                <span>Элементов не найдено</span>
            </div>
        </div>
        <script>
            setInterval(function() {
                $('#alert_message').fadeOut('slow');
                //window.location.replace(window.location.pathname)
            }, 2000);
        </script>
    @endif
@stop
