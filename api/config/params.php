<?php

$currentDirectory = __DIR__;
$parentDirectory = dirname($currentDirectory);
$folderName = 'config';
$savePath = 'uploads';
$fileCredentials = file_get_contents($currentDirectory . DIRECTORY_SEPARATOR . 'creds.json');
$fileCredentialsPath = $currentDirectory . DIRECTORY_SEPARATOR . 'creds.json';
$fileToken = file_get_contents($currentDirectory . DIRECTORY_SEPARATOR . 'token.json');
$fileTokenPath = $currentDirectory . DIRECTORY_SEPARATOR . 'token.json';
$savePathDocs = $parentDirectory . DIRECTORY_SEPARATOR . $savePath . DIRECTORY_SEPARATOR . 'docs/';
$savePathDocsUpload = $parentDirectory . DIRECTORY_SEPARATOR . $savePath . DIRECTORY_SEPARATOR . 'docs_upload/';

return [
    'adminEmail' => 'seniordev@prizma.uz',
    'api_directory' => $parentDirectory,
    'config' => $currentDirectory,
    'fileCredentials' => $fileCredentials,
    'fileCredentialsPath' => $fileCredentialsPath,
    'fileToken' => $fileToken,
    'fileTokenPath' => $fileTokenPath,
    'savePathDocs' => $savePathDocs,
    'savePathDocsUpload' => $savePathDocsUpload
];
