<?

use yii\helpers\Html;
use yii\helpers\Url;

/** @var \common\models\documents\MainDocument $model */

$domen = Url::base('https');
$fileName = pathinfo($model->lawyer_conclusion_path, PATHINFO_FILENAME);

?>
<div class="row">
    <div class="container-fluid px-5">

        <?=
        Html::a('<i class="mdi mdi-file-check btn-icon-prepend"></i> Saqlash', ['drive', 'id' => $doc, 'path' => $fileName], ['class' => 'btn btn-outline-primary btn-icon-text my-4',])
        ?>

        <iframe id="iframe" style="width: 100%; height: 900px"
                src="https://docs.google.com/document/d/<?= $doc ?>/edit?usp=sharing&amp;widget=true&amp;headers=false">
        </iframe>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>

<script>
    // const iframe = document.querySelector('#iframe')
    // const create = document.querySelector('#create')
    // const watch = document.querySelector('#watch')
    // const edit = document.querySelector('#edit')
    // const download = document.querySelector('#download')
    // const doc_title = document.querySelector('#doc_title')
    // const close = document.querySelector('#close')
    // const docs_select = document.querySelector('#docs')
    // const upload = document.querySelector('#upload')
    // const file = document.querySelector('#file')
    //
    // const domain = window.location.host;
    //
    // create.addEventListener('click', e => {
    //     console.log("doc_title", doc_title.value)
    //     if (doc_title.value === '' || !doc_title.value) {
    //         return alert('Error Document Title')
    //     }
    //
    //     axios.post(`/api/docs/create`, {title: doc_title.value}).then(data => {
    //         console.log("new document ", data)
    //
    //         setTimeout(async () => {
    //             getDocsOptions(await getDocsList())
    //         }, 1000)
    //
    //         iframe.src = `https://docs.google.com/document/d/${data.data.id}/edit?usp=sharing&amp;widget=true&amp;headers=false`
    //         iframe.style.display = 'block'
    //     }).catch(err => {
    //         alert('Create Document Failed')
    //     })
    // })
    //
    //
    // close.addEventListener('click', e => {
    //     iframe.style.display = 'none'
    // })
    //
    //
    // async function getDocsList() {
    //     let response = await axios.get(`https://api.enternaloptimist.com/docs/all`)
    //     return response.data.docs
    // }
    //
    // function getDocsOptions(list) {
    //
    //     if (list) {
    //         docs_select.innerHTML = ''
    //         // console.log(list)
    //
    //         list.forEach(el => {
    //
    //             let html = `<option value="${el}">${el}</option>`
    //             docs_select.insertAdjacentHTML('beforeend', html)
    //         })
    //
    //     }
    // }
    //
    //
    // edit.addEventListener('click', e => {
    //     // console.log(docs_select.value)
    //     iframe.src = `https://docs.google.com/document/d/${docs_select.value}/edit?usp=sharing&amp;widget=true&amp;headers=false`
    //     iframe.style.display = 'block'
    // })
    //
    //
    // upload.addEventListener('click', e => {
    //     if (!file?.files[0]) {
    //         return alert('Select File !!!')
    //     }
    //     let bodyFormData = new FormData();
    //     bodyFormData.append('file', file.files[0]);
    //
    //     axios({
    //         method: "post",
    //         url: 'https://api.enternaloptimist.com/upload',
    //         data: bodyFormData,
    //         headers: {"Content-Type": "multipart/form-data"},
    //     }).then(data => {
    //         console.log(data.data)
    //
    //         setTimeout(async () => {
    //             getDocsOptions(await getDocsList())
    //         }, 1000)
    //
    //         iframe.src = `https://docs.google.com/document/d/${data.data.id}/edit?usp=sharing&amp;widget=true&amp;headers=false`
    //         iframe.style.display = 'block'
    //     }).catch(err => {
    //         alert('Create Document Failed')
    //     })
    // })
    //
    //
    // window.addEventListener("DOMContentLoaded", async (event) => {
    //     getDocsOptions(await getDocsList())
    // });
    //
    // //
    // // setInterval(async () => {
    // getDocsOptions(getDocsList())
    // // }, 1000)
</script>