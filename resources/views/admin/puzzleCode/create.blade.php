@formField('select', [
'name' => 'size',
'label' => 'Выберите размер',
'default' => 'popArt',
'options' => [
    [
    'value' => '30x40',
    'label' => '30x40 см'
    ],
    [
    'value' => '20x30',
    'label' => '20x30 см'
    ],
    [
    'value' => '40x50',
    'label' => '40x50 см'
    ]
]
])

@formField('radios', [
'name' => 'color',
'label' => 'Выберите цвет',
'default' => 'popArt',
'inline' => true,
'options' => [
[
'value' => 'blackAndWhite',
'label' => 'Черно-белый'
],
[
'value' => 'sepia',
'label' => 'Сепия'
],
[
'value' => 'popArt',
'label' => 'Поп-арт'
],
]
])

@formField('input', [
'name' => 'count',
'label' => 'Укажите количество кодов',
'type' => 'number',
'note' => 'Число от 1 до 1000!',
])
