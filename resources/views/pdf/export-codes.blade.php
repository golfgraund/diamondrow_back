@php
    $assetPath = asset('assets/frontend/templates/codes');
@endphp

<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=595px, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <link href="{{ $assetPath  }}/assets/styles/styles.css" rel="stylesheet" />
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
                --dpi: 143.75;
            }
        }
    </style>
</head>
<body>
<div class="document">

    @foreach($itemsChunks as $items)

        <div class="page page_album">
            <div class="page__grid">

                @foreach($items as $item)

                    <div class="sideA page__flyer">
                    <div class="sideA__header">
                        <img class="sideA__header__logo" src="{{ $assetPath  }}/assets/images/logo@2x.png" width="70" height="41" alt="Алмазный ряд" />
                    </div>

                    <div class="sideA__content">
                        <div class="sideA__item">
                            <div class="sideA__title">Код набора</div>
                            <div class="sideA__code">{{ $item->code }}</div>
                            <div class="sideA__type">{{ Str::lower($item->colorCodes[$item->color]) }}, {{ $item->size }} см</div>
                        </div>
                        <div class="sideA__arrow">
                            <div class="sideA__title">&nbsp;</div>
                            <svg viewBox="0 0 40 12">
                                <path d="M30.000039,5.0000128 L30.000039,1.1270428 C30.000039,0.260736798 30.877239,-0.280703202 31.578939,0.152448798 L39.473639,5.0254128 C39.8209892,5.23979692 39.9964213,5.61334381 40,5.9885008 C40,5.99233299 40,5.99617036 40,6.0000128 C40,6.00388811 40,6.00775828 40,6.01162318 C39.9963844,6.38674037 39.8209527,6.76023123 39.473639,6.9745928 L31.578939,11.8475928 C30.877239,12.2806928 30.000039,11.7392928 30.000039,10.8729928 L30.000039,7.0000128 L1,7.0000128 C0.44771525,7.0000128 0,6.55229755 0,6.0000128 C0,5.44772805 0.44771525,5.0000128 1,5.0000128 L30.000039,5.0000128 Z" fill-rule="nonzero" />
                            </svg>
                        </div>
                        <div class="sideA__item">
                            <div class="sideA__title">Активировать код</div>
                            <img class="sideA__qr" src="{{ $assetPath  }}/assets/temp/qr-code.jpg" width="61" height="62" alt="" />
                        </div>
                    </div>

                    <div class="sideA__footer">
                        <p>Один код можно использовать 5 раз. Попытка засчитается после того, как инструкция для создания мозаики придёт вам на электронную почту.</p>
                    </div>
                </div>
                @endforeach

                <div class="cut-line cut-line_h"></div>
                <div class="cut-line cut-line_v"></div>
            </div>
        </div>

        {{--
        <div class="page page_album">
            <div class="page__grid">

                @foreach($items as $item)
                    <div class="sideB page__flyer">
                        <div class="sideB__content">

                            <div class="contacts">
                                <img class="contacts__qr" src="{{ $assetPath  }}/assets/temp/qr_white@2x.png" width="62"
                                     height="62" alt=""/>
                                <div class="contacts__right">
                                    <div class="contacts__title">Возникли вопросы? Напишите нам:</div>
                                    <p>mail@mail.ru</p>
                                    <p>+7 (554) 545-55-55</p>
                                    <div class="contacts__messengers">
                                        <img src="{{ $assetPath  }}/assets/images/telegram.svg" width="14" height="14"
                                             alt=""/>
                                        <img src="{{ $assetPath  }}/assets/images/viber.svg" width="14" height="14"
                                             alt=""/>
                                        <img src="{{ $assetPath  }}/assets/images/whatsapp.svg" width="14" height="14"
                                             alt=""/>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <img class="sideB__hero" src="{{ $assetPath  }}/assets/images/hero@2x.png" alt=""/>
                    </div>
                @endforeach

                <img class="sideB__bg" src="{{ $assetPath  }}/assets/images/bg-gradient@2x.png" alt="" />

                <div class="cut-line cut-line_h"></div>
                <div class="cut-line cut-line_v"></div>
            </div>
        </div>

        <div class="page page_album">
            <div class="page__grid">

                @foreach($items as $item)
                    <div class="sideB sideB_mono page__flyer">
                        <div class="sideB__content">

                            <div class="contacts">
                                <img class="contacts__qr" src="{{ $assetPath  }}/assets/temp/qr@2x.png" width="62" height="62" alt="" />
                                <div class="contacts__right">
                                    <div class="contacts__title">Возникли вопросы? Напишите нам:</div>
                                    <p>mail@mail.ru</p>
                                    <p>+7 (554) 545-55-55</p>
                                    <div class="contacts__messengers">
                                        <img src="{{ $assetPath  }}/assets/images/telegram.svg" width="14" height="14" alt="" />
                                        <img src="{{ $assetPath  }}/assets/images/viber.svg" width="14" height="14" alt="" />
                                        <img src="{{ $assetPath  }}/assets/images/whatsapp.svg" width="14" height="14" alt="" />
                                    </div>
                                </div>
                            </div>

                        </div>
                        <img class="sideB__hero" src="{{ $assetPath  }}/assets/images/hero_mono@2x.png" alt="" />
                    </div>
                @endforeach

                <div class="cut-line cut-line_h"></div>
                <div class="cut-line cut-line_v"></div>
            </div>
        </div>
        --}}
    @endforeach

</div>
</body>
</html>
