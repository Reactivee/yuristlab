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