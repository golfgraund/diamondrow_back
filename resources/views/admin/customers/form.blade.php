@extends('twill::layouts.main')

@section('appTypeClass', 'body--form')

@push('extra_css')
    @if(app()->isProduction())
        <link href="{{ twillAsset('main-form.css') }}" rel="preload" as="style" crossorigin/>
    @endif

    @unless(config('twill.dev_mode', false))
        <link href="{{ twillAsset('main-form.css') }}" rel="stylesheet" crossorigin/>
    @endunless
@endpush

@push('extra_js_head')
    @if(app()->isProduction())
        <link href="{{ twillAsset('main-form.js') }}" rel="preload" as="script" crossorigin/>
    @endif
@endpush

@php
    $editor = $editor ?? false;
    $uniquePuzzles = [];
    $translate = $translate ?? false;
    $translateTitle = $translateTitle ?? $translate ?? false;
    $titleFormKey = $titleFormKey ?? 'title';
    $customForm = $customForm ?? false;
    $controlLanguagesPublication = $controlLanguagesPublication ?? true;
    $disableContentFieldset = $disableContentFieldset ?? false;
    $editModalTitle = ($createWithoutModal ?? false) ? twillTrans('twill::lang.modal.create.title') : null;
@endphp

@section('content')
    <div class="form" v-sticky data-sticky-id="navbar" data-sticky-offset="0" data-sticky-topoffset="12" >
        <br>
        <form action="{{ $saveUrl }}" novalidate method="POST" @if($customForm) ref="customForm" @else v-on:submit.prevent="submitForm" @endif>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="container">
                <div class="wrapper wrapper--reverse" v-sticky data-sticky-id="publisher" data-sticky-offset="80">
                    <aside class="col col--aside"></aside>
                    <section class="col col--primary" data-sticky-top="publisher">
                        @unless($disableContentFieldset)
                            <a17-fieldset title="Профиль" id="content">
                                @formField('input', [
                                    'name' => 'email',
                                    'label' => 'Почта',
                                    'readonly' => 'true'
                                ])
                                @formField('date_picker', [
                                    'name' => 'created_at',
                                    'label' => 'Дата создания',
                                    'disabled' => 'true'
                                ])
                            </a17-fieldset>
                            <a17-fieldset title="Используемые коды" id="codes">
                                @foreach($item->puzzles as $puzzle)
                                    @php
                                        if (in_array($puzzle->codes->code,$uniquePuzzles)) {
                                            continue;
                                        }

                                        $uniquePuzzles[] = $puzzle->codes->code;
                                    @endphp
                                    <div data-v-0793316e="" class="col--double col--double-wrap">
                                        <div data-v-74021712="" data-v-71218911="" class="input" data-v-0793316e="">
                                            <div data-v-71218911="" data-v-74021712="" dir="auto" class="input__field">
                                                <input
                                                    data-v-71218911=""
                                                    data-v-74021712=""
                                                    type="text" placeholder=""
                                                    name="link_href"
                                                    autocomplete="on"
                                                    readonly
                                                    value="{{ $puzzleCode = $puzzle->codes->code }}">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </a17-fieldset>
                        @endunless

                        @yield('fieldsets')
                    </section>
                </div>
            </div>
            <a17-spinner v-if="loading"></a17-spinner>
        </form>
    </div>
    <a17-modal class="modal--browser" ref="browser" mode="medium" :force-close="true">
        <a17-browser></a17-browser>
    </a17-modal>
    <a17-modal class="modal--browser" ref="browserWide" mode="wide" :force-close="true">
        <a17-browser></a17-browser>
    </a17-modal>
    <a17-editor v-if="editor" ref="editor" bg-color="{{ config('twill.block_editor.background_color') ?? '#FFFFFF' }}"></a17-editor>
    <a17-previewer ref="preview"></a17-previewer>
    <a17-dialog ref="warningContentEditor" modal-title="{{ twillTrans('twill::lang.form.dialogs.delete.title') }}" confirm-label="{{ twillTrans('twill::lang.form.dialogs.delete.confirm') }}">
        <p class="modal--tiny-title"><strong>{{ twillTrans('twill::lang.form.dialogs.delete.delete-content') }}</strong></p>
        <p>{!! twillTrans('twill::lang.form.dialogs.delete.confirmation') !!}</p>
    </a17-dialog>
@stop

@section('initialStore')
    window['{{ config('twill.js_namespace') }}'].STORE.form = {
    baseUrl: '{{ $baseUrl ?? '' }}',
    saveUrl: '{{ $saveUrl }}',
    previewUrl: '{{ $previewUrl ?? '' }}',
    restoreUrl: '{{ $restoreUrl ?? '' }}',
    availableBlocks: {},
    blocks: {},
    blockPreviewUrl: '{{ $blockPreviewUrl ?? '' }}',
    availableRepeaters: {!! $availableRepeaters ?? '{}' !!},
    repeaters: {!! json_encode(($form_fields['repeaters'] ?? []) + ($form_fields['blocksRepeaters'] ?? [])) !!},
    fields: [],
    editor: {{ $editor ? 'true' : 'false' }},
    isCustom: {{ $customForm ? 'true' : 'false' }},
    reloadOnSuccess: {{ ($reloadOnSuccess ?? false) ? 'true' : 'false' }},
    editorNames: []
    }

    window['{{ config('twill.js_namespace') }}'].STORE.publication = {
    withPublicationToggle: {{ json_encode(($publish ?? true) && isset($item) && $item->isFillable('published')) }},
    published: {{ isset($item) && $item->published ? 'true' : 'false' }},
    createWithoutModal: {{ isset($createWithoutModal) && $createWithoutModal ? 'true' : 'false' }},
    withPublicationTimeframe: {{ json_encode(($schedule ?? true) && isset($item) && $item->isFillable('publish_start_date')) }},
    publishedLabel: '{{ $customPublishedLabel ?? twillTrans('twill::lang.main.published') }}',
    expiredLabel: '{{twillTrans('twill::lang.publisher.expired')}}',
    scheduledLabel: '{{twillTrans('twill::lang.publisher.scheduled')}}',
    draftLabel: '{{ $customDraftLabel ?? twillTrans('twill::lang.main.draft') }}',
    submitDisableMessage: '{{ $submitDisableMessage ?? '' }}',
    startDate: '{{ $item->publish_start_date ?? '' }}',
    endDate: '{{ $item->publish_end_date ?? '' }}',
    visibility: '{{ isset($item) && $item->isFillable('public') ? ($item->public ? 'public' : 'private') : false }}',
    reviewProcess: {!! isset($reviewProcess) ? json_encode($reviewProcess) : '[]' !!},
    submitOptions: {!! isset($submitOptions) ? json_encode($submitOptions) : 'null' !!}
    }

    window['{{ config('twill.js_namespace') }}'].STORE.revisions = {!! json_encode($revisions ?? []) !!}

    window['{{ config('twill.js_namespace') }}'].STORE.parentId = {{ $item->parent_id ?? 0 }}
    window['{{ config('twill.js_namespace') }}'].STORE.parents = {!! json_encode($parents ?? [])  !!}

    window['{{ config('twill.js_namespace') }}'].STORE.medias.crops = {!! json_encode(($item->mediasParams ?? []) + config('twill.block_editor.crops') + (config('twill.settings.crops') ?? [])) !!}
    window['{{ config('twill.js_namespace') }}'].STORE.medias.selected = {}

    window['{{ config('twill.js_namespace') }}'].STORE.browser = {}
    window['{{ config('twill.js_namespace') }}'].STORE.browser.selected = {}

    window['{{ config('twill.js_namespace') }}'].APIKEYS = {
    'googleMapApi': '{{ config('twill.google_maps_api_key') }}'
    }
@stop

@prepend('extra_js')
    @includeWhen(config('twill.block_editor.inline_blocks_templates', true), 'twill::partials.form.utils._blocks_templates')
    <script src="{{ twillAsset('main-form.js') }}" crossorigin></script>
@endprepend
