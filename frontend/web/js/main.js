var plugin = $('#file-input').data('fileinput');


function refreshFilesBlock(e) {
    const queryString = window.location;

    var id = e.params.data.id;
    var url = '?id=' + id;


    $.get('/create/get-file', {id: id}, function (data) {
        if (data !== null) {
            let path = document.getElementById('maindocument-path')
            console.log(data)
            $.pjax.reload({url: url, container: '#files_block', async: false});
            // path.value = data

//                        document.getElementById('piva').value=data.PIVA;
//                        document.getElementById('indi').value=data.Indirizzo;
//                        document.getElementById('input-type-1').value=id;
        } else {
            //if data wasn't found the alert.
            alert('We\'re sorry but we couldn\'t load the the location data!');
        }
    });
}

function PreviewWordDoc() {
    //Read the Word Document data from the File Upload.
    var doc = document.getElementById("files").files[0];
    console.log((doc));

    //If Document not NULL, render it.
    if (doc != null) {
        //Set the Document options.
        var docxOptions = Object.assign(docx.defaultOptions, {
            useMathMLPolyfill: true
        });

        //Reference the Container DIV.
        var container = document.querySelector("#word-container");

        //Render the Word Document.
        docx.renderAsync(doc, container, null, docxOptions);
    }
}

$('.js-preloader').preloadinator({
    animation: 'fadeOut',
    scroll: false,
    animationDuration: 400
});

function PlayLoader() {
    let loader = document.querySelector('.preloader');
    loader.style.display = 'flex';
}
