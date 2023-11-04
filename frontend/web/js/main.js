AOS.init();
var plugin = $('#file-input').data('fileinput');


function refreshFilesBlock(e) {
    const queryString = window.location;

    var id = e.params.data.id;
    var url = '?id=' + id;


    $.get('/create/get-file', {id: id}, function (data) {
        if (data !== null) {
            let path = document.getElementById('maindocument-path')

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

var canvas = document.getElementById('signature-pad');
if (canvas){
    var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
    });

    document.getElementById('save-png').addEventListener('click', function () {
        if (signaturePad.isEmpty()) {
            return alert("Please provide a signature first.");
        }
        var data = signaturePad.toDataURL('image/png');
        console.log(data)
        $.ajax({
            url: "/user/get-signture",
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000
        }).done(function () {
            alert("jonatildi")
        });
    });

    document.getElementById('clear').addEventListener('click', function () {
        signaturePad.clear();
    });
}

// // Adjust canvas coordinate space taking into account pixel ratio,
// // to make it look crisp on mobile devices.
// // This also causes canvas to be cleared.
// function resizeCanvas() {
//     // When zoomed out to less than 100%, for some very strange reason,
//     // some browsers report devicePixelRatio as less than 1
//     // and only part of the canvas is cleared then.
//     var ratio = Math.max(window.devicePixelRatio || 1, 1);
//     canvas.width = canvas.offsetWidth * ratio;
//     canvas.height = canvas.offsetHeight * ratio;
//     canvas.getContext("2d").scale(ratio, ratio);
// }
//
// window.onresize = resizeCanvas;
// resizeCanvas();



