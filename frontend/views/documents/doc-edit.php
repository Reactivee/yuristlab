<?

use yii\helpers\Url;

/** @var \common\models\documents\MainDocument $model */

$domen = Url::base('https');
?>
<div class="row">
    <div class="container-fluid px-5">
        <input id='doc_title' type="text" placeholder="document title">
        <button id="create">Create doc File</button>

        <select name="docs" id="docs">
        </select>
        <button id="edit">Edit doc File</button>


        <p>
            <button id="close">Close doc File</button>
        </p>

        <p>
            <input type="file" id="file">
            <button id="upload">Upload doc File</button>
        </p>

        <iframe id="iframe" style="width: 100%; height: 700px; "
                src="https://docs.google.com/document/d/1K79v0UaIw8FZXHBUTXAapEyO5lqe9as624R7iTw1VxM/edit?usp=sharing&amp;widget=true&amp;headers=false">


        </iframe>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>

<script>
    const iframe = document.querySelector('#iframe')
    const create = document.querySelector('#create')
    const watch = document.querySelector('#watch')
    const edit = document.querySelector('#edit')
    const download = document.querySelector('#download')
    const doc_title = document.querySelector('#doc_title')
    const close = document.querySelector('#close')
    const docs_select = document.querySelector('#docs')
    const upload = document.querySelector('#upload')
    const file = document.querySelector('#file')

    const domain = window.location.host;

    create.addEventListener('click', e => {
        console.log("doc_title", doc_title.value)
        if (doc_title.value === '' || !doc_title.value) {
            return alert('Error Document Title')
        }

        axios.post(`/api/docs/create`, {title: doc_title.value}).then(data => {
            console.log("new document ", data)

            setTimeout(async () => {
                getDocsOptions(await getDocsList())
            }, 1000)

            iframe.src = `https://docs.google.com/document/d/${data.data.id}/edit?usp=sharing&amp;widget=true&amp;headers=false`
            iframe.style.display = 'block'
        }).catch(err => {
            alert('Create Document Failed')
        })
    })


    close.addEventListener('click', e => {
        iframe.style.display = 'none'
    })


    async function getDocsList() {
        let response = await axios.get(`/api/docs/all`)
        return response.data.docs
    }

    function getDocsOptions(list) {
        docs_select.innerHTML = ''
        list.forEach(el => {
            let html = `<option value="${el.split('.')[0]}">${el}</option>`
            docs_select.insertAdjacentHTML('beforeend', html)
        })
    }


    edit.addEventListener('click', e => {
        iframe.src = `https://docs.google.com/document/d/${docs_select.value}/edit?usp=sharing&amp;widget=true&amp;headers=false`
        iframe.style.display = 'block'
    })


    upload.addEventListener('click', e => {
        if (!file?.files[0]) {
            return alert('Select File !!!')
        }
        let bodyFormData = new FormData();
        bodyFormData.append('file', file.files[0]);

        axios({
            method: "post",
            url: `/api/docs/upload`,
            data: bodyFormData,
            headers: {"Content-Type": "multipart/form-data"},
        }).then(data => {
            console.log(data)

            setTimeout(async () => {
                getDocsOptions(await getDocsList())
            }, 1000)
            //
            iframe.src = `https://docs.google.com/document/d/${data.data.id}/edit?usp=sharing&amp;widget=true&amp;headers=false`
            iframe.style.display = 'block'
        }).catch(err => {
            alert('Create Document Failed')
        })
    })


    window.addEventListener("DOMContentLoaded", async (event) => {
        getDocsOptions(await getDocsList())
    });

    //
    // setInterval(async () => {
    //     getDocsOptions(await getDocsList())
    // }, 1000)
</script>