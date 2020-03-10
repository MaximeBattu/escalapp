function orderByFirstname() {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: `/admin/gestion-comptes/trier-par-prenom`,
        type: 'POST',
        data: null
    })
}

$('#order-by-firstname').on('click', ()=> {
    orderByFirstname({}).then(res => {
        console.log('succes sort by firstname')
        document.body.outerHTML = res
    }).catch(console.error)
})

function orderByName() {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: `/admin/gestion-comptes/trier-par-nom`,
        type: 'POST',
        data: null
    })
}

$('#order-by-name').on('click', () => {
    orderByName({}).then(res => {
        console.log('succes sort by name')
        document.body.outerHTML = res
    }).catch(console.error)
})

function orderByEmail() {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: `/admin/gestion-comptes/trier-par-email`,
        type: 'POST',
        data: null
    })
}

$('#order-by-email').on('click', ()=> {
    orderByEmail({}).then(res => {
        console.log('succes sort by email')
        document.body.outerHTML = res
    }).catch(console.error)
})

function orderByDate() {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: `/admin/gestion-comptes/trier-par-date`,
        type: 'POST',
        data: null
    })
}

$('#order-by-date').on('click', ()=> {
    orderByDate({}).then(res => {
        console.log('succes sort by date')
        document.body.outerHTML = res
    }).catch(console.error)
})

function orderByAdmin() {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: `/admin/gestion-comptes/trier-par-admin`,
        type: 'POST',
        data: null
    })
}

$('#order-by-admin').on('click', ()=> {
    orderByEmail({}).then(res => {
        console.log('succes sort by admin right')
        document.body.outerHTML = res
    }).catch(console.error)
})
