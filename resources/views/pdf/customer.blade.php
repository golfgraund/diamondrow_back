@php
    $assetPath = asset('assets/frontend/templates/manual');
//    $size = $puzzle->codes()->first()->size;
    $size = '40x50';
    $brightColorLimit = 170;
    $symbols = 'ABCDEVT';
    $colors = ['r' => '', 'g' => '', 'b' => ''];
    $sectorIndex = 0;

    $imageDimensionsBySize = [
        '20x30' => ['w' => '132', 'h' => '195'],
        '40x50' => ['w' => '145', 'h' => '155'],
        '30x40' => ['w' => '158', 'h' => '207'],
    ];
@endphp
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=595px, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <link href="{{ $assetPath }}/assets/styles/styles.css" rel="stylesheet" />
    <title>Шаблон PDF-файла с инструкцией</title>
    <style>
        /* При dpi === 72 физический размер А4 210mm x 297mm соответствует размеру в пикселях 595x842px */
        @media screen {
            :root {
                --dpi: 72;
            }
        }

        @media print {
            :root {
                --dpi: 95;
            }
        }
    </style>
</head>
<body>
<div class="document">

    @if($previewType == 'wide')
        <div class="cover cover_vertical page">
            <div class="header">
                <img class="header__logo" src="{{ $assetPath }}/assets/images/logo@2x.png" width="88" height="52" alt="Алмазный ряд" />
                <div class="qr">
                    <div class="qr__hint">Отсканируйте код чтобы открыть инструкцию для сборки на телефоне</div>
{{--                    <img class="qr__code" src="{{ $assetPath }}/assets/temp/qr-code@2x.png" width="68" height="68" alt="" />--}}
                    {!! $qrCodeSVG !!}
                </div>
            </div>

            <picture class="cover__pic">
                <img src="{{ $puzzle->imageAsArr('customer_image')['src'] }}" alt="" />
            </picture>

            <div class="footer">
                <div class="legend">
                    <div class="legend__title">Цвета, используемые в мозаике:</div>
                    <img class="legend__image" src="{{ $puzzle->imageAsArr('colors_image')['src'] }}" width="188" height="48" alt="" />
                </div>
                <div class="contacts">
                    <div class="contacts__title">Возникли вопросы?</div>
                    <p>tmnasledie@yandex.ru</p>
                    <p>+7 (968) 475-67-91</p>
                    <div class="contacts__messengers">
                        <a href="https://t.me/NasledieTM">
                            <img src="{{ $assetPath }}/assets/images/telegram.svg" width="14" height="14" alt="" />
                        </a>
                        <a href="viber://add?number=79684756791">
                            <img src="{{ $assetPath }}/assets/images/viber.svg" width="14" height="14" alt="" />
                        </a>
                        <a href="https://wa.me/qr/F6QEQWWLRTFKC1">
                            <img src="{{ $assetPath }}/assets/images/whatsapp.svg" width="14" height="14" alt="" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="cover cover_horizontal page">
            <div class="header">
                <img class="header__logo" src="{{ $assetPath }}/assets/images/logo@2x.png" width="88" height="52" alt="Алмазный ряд" />
                <div class="qr">
                    <div class="qr__hint">Отсканируйте код чтобы открыть инструкцию для сборки на телефоне</div>
{{--                    <img class="qr__code" src="{{ $assetPath }}/assets/temp/qr-code@2x.png" width="68" height="68" alt="" />--}}
                    {!! $qrCodeSVG !!}
                </div>
            </div>

            <picture class="cover__pic">
                <img src="{{ $puzzle->imageAsArr('customer_image')['src'] }}" width="523" height="391" alt="" />
            </picture>

            <div class="footer">
                <div class="legend">
                    <div class="legend__title">Цвета, используемые в мозаике:</div>
                    <img class="legend__image" src="{{ $puzzle->imageAsArr('colors_image')['src'] }}" width="188" height="48" alt=""/>
                </div>
                <div class="contacts">
                    <div class="contacts__title">Возникли вопросы?</div>
                    <p>tmnasledie@yandex.ru</p>
                    <p>+7 (968) 475-67-91</p>
                    <div class="contacts__messengers">
                        <a href="https://t.me/NasledieTM">
                            <img src="{{ $assetPath }}/assets/images/telegram.svg" width="14" height="14" alt="" />
                        </a>
                        <a href="viber://add?number=79684756791">
                            <img src="{{ $assetPath }}/assets/images/viber.svg" width="14" height="14" alt="" />
                        </a>
                        <a href="https://wa.me/qr/F6QEQWWLRTFKC1">
                            <img src="{{ $assetPath }}/assets/images/whatsapp.svg" width="14" height="14" alt="" />
                        </a> </div>
                </div>
            </div>
        </div>
    @endif

    @foreach($matrix as $key => $sectors)
        @php
            $start = !empty($start) ? $start + $sectors->count() : 1;
            $end = !empty($end) ? $end + $sectors->count() : $sectors->count();
        @endphp

        <div class="sectors sectors_{{ $size }} page">
            <div class="header header_compact">
                <img class="header__logo" src="{{ $assetPath }}/assets/images/logo@2x.png" width="88" height="52" alt="Алмазный ряд" />
                <div class="sectorCount">
                    <svg width="26px" height="26px" viewBox="0 0 26 26">
                        <path d="M2.5,12 L12,12 L12,2.5 L2.5,2.5 L2.5,12 Z M2.5,14 L2.5,23.5 L12,23.5 L12,14 L2.5,14 Z M23.5,12 L23.5,2.5 L14,2.5 L14,12 L23.5,12 Z M23.5,14 L14,14 L14,23.5 L23.5,23.5 L23.5,14 Z M1.47368,0 L24.52632,0 C25.340211,0 26,0.65978901 26,1.47368 L26,24.52632 C26,25.340211 25.340211,26 24.52632,26 L1.47368,26 C0.65978901,26 0,25.340211 0,24.52632 L0,1.47368 C0,0.65978901 0.65978901,0 1.47368,0 Z" fill="#333333" fill-rule="nonzero" />
                    </svg>
                    <span>{{ $start }}-{{ $end }}</span>
                </div>
            </div>

            <div class="flex-grid flex-grid_{{ $size }}">

                @foreach($sectors as $key => $sector)
                    <div class="sector">
                        <div class="sector__number">{{ $key + 1 }}</div>

                        <div class="sector-grid">
                            <div class="sector-grid__squares sector-grid__squares_{{ $size }}">

                                @foreach($sector as $skey => $square)
                                    @if(!($square))
                                        <div class="sector-grid__square empty" style="color: rgb(255, 255, 255); background: rgb(255, 255, 255);">
                                            <span></span>
                                            <sup></sup>
                                        </div>
                                        @php
                                            $sectorIndex = 0;
                                            $colors = ['r' => '', 'g' => '', 'b' => ''];
                                        @endphp
                                    @else
                                        @php
                                            $sectorIndex = ($skey % 10 == 0) ? 1 : ($colors['r'] != $square->r && $colors['g'] != $square->g && $colors['b'] != $square->b ? 1 : $sectorIndex + 1);
                                            $colors = ['r' => $square->r,'g' => $square->g,'b' => $square->b];
                                        @endphp
                                        <div class="sector-grid__square"
                                             style="color: {{ $square->r >= $brightColorLimit && $square->g >= $brightColorLimit && $square->b >= $brightColorLimit ? 'black' : 'white' }}; background: rgb({{$square->r}}, {{$square->g}}, {{$square->b}});">
                                            <span>{{ $symbols[$square->index] }}</span>
                                            <sup>{{ $sectorIndex }}</sup>
                                        </div>
                                    @endif
                                @endforeach
                                @php
                                    $sectorIndex = 0;
                                    $colors = ['r' => '', 'g' => '', 'b' => ''];
                                @endphp
                            </div>
                            <div class="sector-grid__head sector-grid__head_top">
                                @foreach(range(1, 10) as $number)
                                    <span>{{$number}}</span>
                                @endforeach
                            </div>
                            <div class="sector-grid__head sector-grid__head_bottom">
                                @foreach(range(1, 10) as $number)
                                    <span>{{$number}}</span>
                                @endforeach
                            </div>
                            <div class="sector-grid__head sector-grid__head_left">
                                @foreach(range(1, 10) as $number)
                                    <span>{{$number}}</span>
                                @endforeach
                            </div>
                            <div class="sector-grid__head sector-grid__head_right">
                                @foreach(range(1, 10) as $number)
                                    <span>{{$number}}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    @endforeach

</div>
</body>
</html>

