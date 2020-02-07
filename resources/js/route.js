// FILTER PART
$('#filter-form').submit(function(e){
    e.preventDefault()

    const sectorName = $('#sector').val()
    const color = $('#color').val()
    const difficulty = $('#difficulty').val()

    const queryParam = []
    if (sectorName !== '') {
        queryParam.push(`sectorName=${sectorName}`)
    }
    if (color !== '') {
        queryParam.push(`color=${color}`)
    }
    if (difficulty !== '') {
        queryParam.push(`difficulty=${difficulty}`)
    }

    if (queryParam.length !== 0) {
        window.location = `${pageUrl}?${queryParam.join('&')}`
    }
});

$('#reset-form').click(function(e){
    e.preventDefault()
    window.location = pageUrl
});

// SHOW IMAGE ON CLICK
document.addEventListener('DOMContentLoaded', function () {
    let body = document.querySelector('body')
    let images = document.querySelectorAll("#image")
    let div = create('div', null, body)
    let imageDiv = create("div", null, body, null, "centerImage")
    let centerImage = document.querySelector("#centerImage")
    for (let image of images) {
        image.addEventListener('click', function () {
            div.classList.toggle("transparentDiv")
            imageDiv.classList.toggle("imageCenter")
            imageDiv.style.background = "url('" + image.src + "')"
            imageDiv.style.border = "3px solid " + image.style.borderColor
            imageDiv.style.opacity = "1"
        })
        div.addEventListener('click', function () {
            div.classList.remove("transparentDiv")
            imageDiv.classList.remove("imageCenter")
            imageDiv.style.background = null
            centerImage.style.border = "none"
        })
        centerImage.addEventListener('click', function () {
            div.classList.remove("transparentDiv")
            imageDiv.classList.remove("imageCenter")
            imageDiv.style.background = null
            centerImage.style.border = "none"
        })
    }
})

// CONTEST SHOW
let contest = document.querySelector("#contest")
let open = document.querySelector("#open")
let close = document.querySelector("#closeContest")
let escalapp = document.querySelector(".escalapp")
let roomsuccess = document.querySelectorAll(".roomsuccess")
let scores = document.querySelectorAll(".score")

for (let title of roomsuccess) {
    title.addEventListener("click", function () {
        for (let score of scores) {
            score.style.display = "block"
        }
    })
}
open.addEventListener("click", function () {
    contest.style.left = "0"
    open.style.left = "-5vw"
    open.style.transition = "0.4s all ease-in-out"
    close.style.left = "13vw"
    escalapp.style.marginLeft = "10%"
})
close.addEventListener("click", function () {
    contest.style.left = "-13vw"
    close.style.left = "-2vw"
    open.style.left = "0"
    escalapp.style.marginLeft = null
})

/**
 *
 * @param {object} parameters
 * @param {number} parameters.idRoute
 * @param {number} parameters.idUser
 *
 * @return {promise}
 */
function addLikeUser(parameters) {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: `/voies/route/${parameters.idRoute}/utilisateur/${parameters.idUser}`,
        type: 'PUT',
        data: JSON.stringify({
            idRoute: parameters.idRoute,
            idUser: parameters.idUser
        })
    })
}

$('.like-route').on('click', function (e) {
    $(this).toggleClass('far like-route fas unlike-route')

    const idRoute = $(this).parent().find('.like-route-id').html()
    addLikeUser({
        idRoute,
        idUser
    }).then(res => {
        console.log('success like user')
    }).catch(console.error)

})

/**
 *
 * @param {object} parameters
 * @param {number} parameters.idRoute
 * @param {number} parameters.idUser
 *
 * @return {promise}
 */
function removeLikeUser(parameters) {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: `/voies/route/${parameters.idRoute}/utilisateur/${parameters.idUser}/supprimer`,
        type: 'PUT',
        data: JSON.stringify({
            idRoute: parameters.idRoute,
            idUser: parameters.idUser
        })
    })
}

$('.unlike-route').on('click',function(e) {
    $(this).toggleClass('far unlike-route fas like-route')

    const idRoute = $(this).parent().find('.like-route-id').html()
    removeLikeUser({
        idRoute,
        idUser
    }).then(res => {
        console.log('succes unlike user')
    }).catch(console.error)
})

