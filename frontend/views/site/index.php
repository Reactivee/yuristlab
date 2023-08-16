<?php

/** @var yii\web\View $this */


$this->title = 'Yuristlab';
?>
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">Arizalar soni</h4>
                    <div class="d-xl-flex justify-content-between mt-3 mb-3 align-items-center">
                        <h6 class="font-weight-normal">Mar 28 - Apr 28.2023</h6>
                        <button type="button" class="btn btn-outline-primary">Details</button>
                    </div>
                    <div class="row mt-4 mb-4 mb-sm-0 d-flex align-items-center">
                        <div class="col-xl-9  mb-4 mb-sm-0">
                            <h1 class="font-weight-medium m-0 text-dark">4,356 <span
                                        class="text-success text-small font-weight-normal">+54.34 (1.2%)</span></h1>
                        </div>

                        <div class="col-xl-3">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="avrg-order-quantity" width="164" height="82"
                                    style="display: block; width: 82px; height: 41px;"
                                    class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">Qayta ishlangan xujjatlar</h4>
                    <div class="d-xl-flex justify-content-between mt-3 mb-3 align-items-center">
                        <h6 class="font-weight-normal">Mar 28 -  Apr 28.2023</h6>
                        <button type="button" class="btn btn-outline-primary">Details</button>
                    </div>
                    <div class="row mt-4 mb-4 mb-sm-0 d-flex align-items-center">
                        <div class="col-xl-9 mb-4 mb-sm-0">
                            <h1 class="font-weight-medium m-0 text-dark">45.34% <span class="text-success text-small font-weight-normal">+24.18 (2.6%)</span></h1>
                        </div>

                        <div class="col-xl-3"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div><canvas id="percentage" width="164" height="82" style="display: block; width: 82px; height: 41px;" class="chartjs-render-monitor"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">Rad etilgan xujjatlar</h4>
                    <div class="d-xl-flex justify-content-between mt-3 mb-3 align-items-center">
                        <h6 class="font-weight-normal">Mar 28 -  Apr 28.2023</h6>
                        <button type="button" class="btn btn-outline-primary">Details</button>
                    </div>
                    <div class="row mt-4 mb-4 mb-sm-0 d-flex align-items-center">
                        <div class="col-xl-9 mb-4 mb-sm-0">
                            <h1 class="font-weight-medium m-0 text-dark">2345.00 <span class="text-danger text-small font-weight-normal">-11.45% (1.2%)</span></h1>
                        </div>

                        <div class="col-xl-3"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div><canvas id="total-conversion" width="164" height="82" style="display: block; height: 41px; width: 82px;" class="chartjs-render-monitor"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Arizalar soni</h4>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Xujjatlar statusi</h4>
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<!--danger zone-->
<div class="site-index">
    <?php
    //
    //    // Read contents
    //    $name = basename(__FILE__, '.php');
    //    $source = Yii::getAlias('@frontend') . '/web/uploads/docs/qBb34cYHol7cSNwwdsMn8MaVsTdcWe-x64d8e5c3e42b2.docx';
    //
    ////    echo date('H:i:s'), " Reading contents from `{$source}`", EOL;
    //    $phpWord = \PhpOffice\PhpWord\IOFactory::load($source);
    //
    //    function write($phpWord, $filename, $writers)
    //    {
    //        $result = '';
    //
    //        // Write documents
    //        foreach ($writers as $format => $extension) {
    //            $result .= date('H:i:s') . " Write to {$format} format";
    //            if (null !== $extension) {
    //                $targetFile = __DIR__ . "/results/{$filename}.{$extension}";
    //                $phpWord->save($targetFile, $format);
    //            } else {
    //                $result .= ' ... NOT DONE!';
    //            }
    ////            $result .= EOL;
    //        }
    //
    //        $result .= getEndingNotes($writers, $filename);
    //
    //        return $result;
    //    }
    //    // Save file
    //    echo write($phpWord, basename(__FILE__, '.php'), 'docx');

    //    // Creating the new document...
    //        $phpWord = new \PhpOffice\PhpWord\PhpWord();
    //
    //    /* Note: any element you append to a document must reside inside of a Section. */
    //
    // Adding an empty Section to the document...
    //        $section = $phpWord->addSection();
    //         Adding Text element to the Section having font styled by default...
    //        $section->addText('asd');

    /*
     * Note: it's possible to customize font style of the Text element you add in three ways:
     * - inline;
     * - using named font style (new font style object will be implicitly created);
     * - using explicitly created font style object.
     */

    // Adding Text element with font customized inline...
    //        $section->addText(
    //            '"Great achievement is usually born of great sacrifice, '
    //            . 'and is never the result of selfishness." '
    //            . '(Napoleon Hill)',
    //            array('name' => 'Tahoma', 'size' => 10)
    //        );

    // Adding Text element with font customized using named font style...
    //        $fontStyleName = 'oneUserDefinedStyle';
    //        $phpWord->addFontStyle(
    //            $fontStyleName,
    //            array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
    //        );
    //        $section->addText(
    //            '"The greatest accomplishment is not in never falling, '
    //            . 'but in rising again after you fall." '
    //            . '(Vince Lombardi)',
    //            $fontStyleName
    //        );

    // Adding Text element with font customized using explicitly created font style object...
    //        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
    //        $fontStyle->setBold(true);
    //        $fontStyle->setName('Tahoma');
    //        $fontStyle->setSize(13);
    //        $myTextElement = $section->addText('"Believe you can and you\'re halfway there." (Theodor Roosevelt)');
    //        $myTextElement->setFontStyle($fontStyle);

    // Saving the document as OOXML file...
    //        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    //        $objWriter->save('helloWorld.docx');

    //        // Saving the document as ODF file...
    //        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
    //        $objWriter->save('helloWorld.odt');
    //
    //        // Saving the document as HTML file...
    //        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
    //        $objWriter->save('helloWorld.html');
    //
    //        if(file_exists('helloWorld.docx')){
    //            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('helloWorld.docx');
    //            $templateProcessor->setValue('name', 'Akbarali');
    //            $templateProcessor->setValue('time','13.02.2021');
    //            $templateProcessor->setValue('month', 'January');
    //            $templateProcessor->setValue('state','Uzbekistan');
    ////            dd($templateProcessor);
    //            $templateProcessor->saveAs('helloWorld.docx');
    //        }
    //
    // This code example demonstrates how to add client Id and Secret in the code.
    //     $ClientId = '659fe7da-715b-4744-a0f7-cf469a392b73';
    //     $ClientSecret = 'b377c36cfa28fa69960ebac6b6e36421';
    //
    //     $ApiBaseUrl = 'https://api.groupdocs.cloud';
    //     $MyStorage = '';
    //
    //    // Intializing the configuration
    //    $configuration = new GroupDocs\Viewer\Configuration();
    //
    //    // Seting the configurations
    //    $configuration->setAppSid($ClientId);
    //    $configuration->setAppKey($ClientSecret);
    //    $configuration->setApiBaseUrl($ApiBaseUrl);
    //
    //    // This code example demonstrates how to upload a DOCX file to the cloud.
    //    // Initialize the api
    //    $apiInstance = new GroupDocs\Viewer\FileApi($configuration);
    //
    //    // Input file path
    //    $file = "helloWorld.docx";
    //
    //    // Upload file request
    //    $request = new GroupDocs\Viewer\Model\Requests\uploadFileRequest("input.docx", $file);
    //
    //    // Upload file
    //    $response = $apiInstance->uploadFile($request);
    //    // This code example demonstrates how to render DOCX to HTML.
    //    // Initialize the api
    //    $apiInstance = new GroupDocs\Viewer\ViewApi($configuration);
    //
    //    // Define ViewOptions
    //    $viewOptions = new Model\ViewOptions();
    //
    //    // Input file path
    //    $fileInfo = new Model\FileInfo();
    //    $fileInfo->setFilePath("input.docx");
    //    $viewOptions->setFileInfo($fileInfo);
    //
    //    // Set ViewFormat
    //    $viewOptions->setViewFormat(Model\ViewOptions::VIEW_FORMAT_HTML);
    //
    //    // Define HTML options
    //    $renderOptions = new Model\HtmlOptions();
    //
    //    // Set it to be responsive
    //    $renderOptions->setIsResponsive(true);
    //
    //    // Set for printing
    //    $renderOptions->setForPrinting(true);
    //
    //    // Assign render options
    //    $viewOptions->setRenderOptions($renderOptions);
    //
    //    // Create view request
    //    $request = new Requests\CreateViewRequest($viewOptions);
    //
    //    // Create view
    //    $response = $apiInstance->createView($request);
    //
    //    // Done
    //    echo "HtmlViewerResponsiveLayout completed: ", count($response->getPages());
    //    echo "\n";
    ?>
    <!--    --><? //= \lesha724\documentviewer\GoogleDocumentViewer::widget([
    //        'url' => 'https://yuristlab.uz/exam.doc',//url на ваш документ
    //        'width' => '100%',
    //        'height' => '400px',
    //        //https://geektimes.ru/post/111647/
    //        'embedded' => true,
    //        'a' => \lesha724\documentviewer\GoogleDocumentViewer::A_BI //A_V = 'v', A_GT= 'gt', A_BI = 'bi'
    //    ]); ?>
    <!---->
    <!--    --><? //= \lesha724\documentviewer\MicrosoftDocumentViewer::widget([
    //        'url' => 'https://yuristlab.uz/exam.doc',//url на ваш документ
    //        'width' => '100%',
    //        'height' => '600px'
    //    ]);
    //    //
    //    //     ?>
    <!--    <a href="https://abcdpdf.com/embedviewer.html?url=ASDASD&filename=ASDAS&format=word" target="_blank"><img width="20" height="20" loading="lazy" src="https://abcdpdf.com/images/favicon.png" alt="icon"><span> view with AbcdPDF </span></a>-->
    <!--    <iframe src="https://abcdpdf.com/embedviewer.html?url=https://yuristlab.uz/exam.doc&filename=exam.doc&format=word"-->
    <!--            width="100%" height="700" frameborder="0"></iframe>-->
    <!--    <iframe width="100%" height="500px"-->
    <!--            src="http://docs.google.com/gview?url=https://yuristlab.uz/exam.doc&embedded=true" frameborder="0">-->
    <!---->
    <!--    </iframe>-->
    <!--    <div id="odf"></div>-->
    <!--    --><? //
    //    $form = ActiveForm::begin();
    //
    //
    //    // Usage without model
    //    echo Summernote::widget([
    //        'name' => 'comments',
    //        'value' => '<b>Some Initial Value.</b>',
    //        // other widget settings
    //    ]);
    //    echo \yii\helpers\Html::submitButton();
    //    ActiveForm::end();
    //
    //
    //
    // This code example demonstrates how to add client Id and Secret in the code.
    //    static $ClientId = '659fe7da-715b-4744-a0f7-cf469a392b73';
    //    static $ClientSecret = 'b377c36cfa28fa69960ebac6b6e36421';
    //
    //    static $ApiBaseUrl = 'https://api.groupdocs.cloud';
    //    static $MyStorage = '';
    //
    //    // Intializing the configuration
    //    $configuration = new GroupDocs\Viewer\Configuration();
    //
    //    // Seting the configurations
    //    $configuration->setAppSid($ClientId);
    //    $configuration->setAppKey($ClientSecret);
    //    $configuration->setApiBaseUrl($ApiBaseUrl);
    //
    //    // This code example demonstrates how to upload a DOCX file to the cloud.
    //    // Initialize the api
    //    $apiInstance = new GroupDocs\Viewer\FileApi($configuration);
    //
    //    // Input file path
    //    $file = "my-document.doc";
    //
    //    // Upload file request
    //    $request = new GroupDocs\Viewer\Model\Requests\uploadFileRequest("input.docx", $file);
    //
    //    // Upload file
    //    $response = $apiInstance->uploadFile($request);
    //    // This code example demonstrates how to render DOCX to HTML.
    //    // Initialize the api
    //    $apiInstance = new GroupDocs\Viewer\ViewApi($configuration);
    //
    //    // Define ViewOptions
    //    $viewOptions = new Model\ViewOptions();
    //
    //    // Input file path
    //    $fileInfo = new Model\FileInfo();
    //    $fileInfo->setFilePath("input.docx");
    //    $viewOptions->setFileInfo($fileInfo);
    //
    //    // Set ViewFormat
    //    $viewOptions->setViewFormat(Model\ViewOptions::VIEW_FORMAT_HTML);
    //
    //    // Define HTML options
    //    $renderOptions = new Model\HtmlOptions();
    //
    //    // Set it to be responsive
    //    $renderOptions->setIsResponsive(true);
    //
    //    // Set for printing
    //    $renderOptions->setForPrinting(true);
    //
    //    // Assign render options
    //    $viewOptions->setRenderOptions($renderOptions);
    //
    //    // Create view request
    //    $request = new Requests\CreateViewRequest($viewOptions);
    //
    //    // Create view
    //    $response = $apiInstance->createView($request);
    //
    //    // Done
    //    echo "HtmlViewerResponsiveLayout completed: ", count($response->getPages());
    //    echo "\n";
    //        dd();
    //    $text = Yii::$app->request->post()['comments'];
    //    //        dd($text);
    //
    //    $htd = new HTML_TO_DOC();
    //    $htmlContent = $text;
    //    //        $htd->createDoc($htmlContent, "my-document");
    //    //        $htd->createDoc($htmlContent, "my-document", 1);
    //    $htd->createDoc("a.html", "my-document");
    //    //        $htd->createDoc($htmlContent, "my-document.docx");
    //    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    //    $section = $phpWord->addSection();
    //    $section->addText("Some Initial Value.");
    //    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    //    $objWriter->save('helloWorld.docx');
    //    if (file_exists('helloWorld.docx')) {
    //        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('helloWorld.docx');
    ////            $templateProcessor->setValue('name', 'Akbarali');
    ////            $templateProcessor->setValue('time', '13.02.2021');
    ////            $templateProcessor->setValue('month', 'January');
    ////            $templateProcessor->setValue('state', 'Uzbekistan');
    ////            dd($templateProcessor);
    //        $templateProcessor->saveAs('helloWorld.docx');
    //    }


    // Load an existing document
    //    dd(Yii::getAlias('@frontend'));
    //    $phpWord = IOFactory::load(Yii::getAlias('@frontend') . '/web/helloWorld.docx');
    //
    //    // Modify the document
    //    $section = $phpWord->addSection();
    //
    //    $section->addText('Hello World!');
    //
    //    // Save the document
    //
    //    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    //
    //    $objWriter->save('modified.docx');
    //
    //    ?>
    <!---->
    <!---->
    <!--    --><?php
    //
    //    $script = <<<JS
    //
    //JS;
    //    $this->registerJs($script); ?>


