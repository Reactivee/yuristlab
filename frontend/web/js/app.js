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

// const axios = {
//     baseUrl: '',
//     get: function (url, data, headers) {
//         return new Promise((resolve, reject) => {
//             if (this.baseUrl !== '') {
//                 url = this.baseUrl + url
//             }
//             fetch(url).then(res => {
//                 resolve(res.json())
//             }).catch(reject);
//         })
//     },
//     post: function (url, data, headers) {
//         return new Promise(async (resolve, reject) => {
//             if (this.baseUrl !== '') {
//                 url = this.baseUrl + url
//             }
//             let response = await fetch(url, {
//                 method: 'POST', // *GET, POST, PUT, DELETE, etc.
//                 mode: 'no-cors', // no-cors, *cors, same-origin
//                 // cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
//                 // credentials: 'same-origin', // include, *same-origin, omit
//                 headers: {
//                     'Content-Type': 'application/json',
//                     ...headers
//                 },
//                 // redirect: 'follow', // manual, *follow, error
//                 // referrerPolicy: 'no-referrer', // no-referrer, *client
//                 body: JSON.stringify(data) // body data type must match "Content-Type" header
//             })
//
//             return resolve(await response.json())
//         })
//     }
// }
// axios.baseUrl = 'http://127.0.0.1:8000'
// axios.baseUrl = 'https://api.enternaloptimist'


create.addEventListener('click', e => {
    console.log("doc_title", doc_title.value)
    if (doc_title.value === '' || !doc_title.value) {
        return alert('Error Document Title')
    }

    axios.post('https://api.enternaloptimist.com/docs/create', {title: doc_title.value}).then(data => {
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
    let response = await axios.get('https://api.enternaloptimist.com/docs/all')
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
        url: "https://api.enternaloptimist.com/upload",
        data: bodyFormData,
        headers: {"Content-Type": "multipart/form-data"},
    }).then(data => {
        console.log("new document ", data)

        setTimeout(async () => {
            getDocsOptions(await getDocsList())
        }, 1000)
        //
        // iframe.src = `https://docs.google.com/document/d/${data.data.id}/edit?usp=sharing&amp;widget=true&amp;headers=false`
        // iframe.style.display = 'block'
    }).catch(err => {
        alert('Create Document Failed')
    })
})


window.addEventListener("DOMContentLoaded", async (event) => {
    getDocsOptions(await getDocsList())
});


setInterval(async () => {
    getDocsOptions(await getDocsList())
}, 1000)