<?php
return [
    'sourcePath' => __DIR__. '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .    DIRECTORY_SEPARATOR,

    /*Add languages to the array for the language files to be generated, here are English and Russian.*/
    'languages' => ['en-US', 'ru-RU', 'uz-UZ'],

    'translator' => 'Yii::t',
    'sort' => false,
    'removeUnused' => false,
    'only' => ['*.php'],
    'except' => [
        '.svn',
        '.git',
        '.gitignore',
        '.gitkeep',
        '.hgignore',
        '.hgkeep',
        '/messages',
        '/vendor',
    ],
    'format' => 'php',

    /*path of messages folder created above*/
    'messagePath' => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .      'messages',

    'overwrite' => true,
];