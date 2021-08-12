
const labelEls = document.querySelectorAll('.form-check-label');

const handleLabelEl = (id) => {
    let el = document.getElementById('l-'+id);
    el.innerHTML = `
                <label class="form-check-label" for="status">
                                            Выполнено <i class="fa fa-check-square-o text-success"></i>
                                        </label>
            `;
}
const setStatus = (e) => {
    let id = e.currentTarget.getAttribute('data-id');
    fetch(fetchUrl + id)
        .then(response => { return response.json()})
        .then(data => { handleLabelEl(id) } )
        .catch(e => console.log(e));
}
if (labelEls.length > 0) {
    labelEls.forEach(el => {
        el.addEventListener('click', setStatus);
    });
}


const editEl = document.querySelectorAll('.editBtn');
const formEl = document.getElementById('edit-form');
const inputEl = document.getElementById('edit-task');


const clear = () => {
    formEl.setAttribute('action', '');
    inputEl.value = '';
}
const handleEditForm = (e) => {
    clear();
    let id = e.currentTarget.getAttribute('data-id');
    const spanEl = document.getElementById('c-'+id);

    console.log(id, spanEl);
    formEl.setAttribute('action', editUrl+id);
    inputEl.value =  spanEl.textContent;
}

if (editEl.length > 0 ) {
    editEl.forEach(btn => {
        btn.addEventListener('click', handleEditForm);
    })
}