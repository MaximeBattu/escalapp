// disable succes or error message after 4s
setTimeout(function () {
    $('#adminAccessError').fadeOut()
    $('#addSuccessRoom').fadeOut()
    $('#administratorRight').fadeOut()
    $('#profileModification').fadeOut()
}, 4000)

const DISPLAY_NONE = 'd-none'

document.addEventListener('DOMContentLoaded', function () {

    // AJAX UPDATE FOR ROOM
    $('.updatable-field-room').on('dblclick', function (e) {
        const $td = $(this)
        $td.next().children('.field-update-room').val($td.html()).focus()
        $td.addClass(DISPLAY_NONE)
        $td.next().removeClass(DISPLAY_NONE)
    })

    /**
     * @param {object} room
     * @param {number} room.id
     * @param {string} room.name
     * @param {string} room.address
     * @param {string} room.email
     *
     * @return {Promise}
     */
    function updateRoom(room) {
        return $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `/admin/gestion-salles/modifier/route/${room.id}`,
            type: 'PUT',
            data: JSON.stringify({
                name: room.name,
                email: room.email,
                address: room.address
            })
        })
    }

    $(document).on('keydown', '.field-update-room', function (e) {
        if (e.keyCode === 13) {
            const $input = $(this)
            const newValue = $input.val()
            const $td = $input.parent()
            $td.addClass(DISPLAY_NONE)

            $td.prev().removeClass(DISPLAY_NONE)
            $td.prev().html(newValue)

            const $tr = $td.parent()
            const id = $tr.find('.room-id').html()
            const name = $tr.find('.room-name').html()
            const email = $tr.find('.room-email').html()
            const address = $tr.find('.room-address').html()

            updateRoom({
                id,
                name,
                email,
                address
            }).then(res => {
                console.log('success room modification')
            }).catch(console.error)

            /* */
        }
    })

    // AJAX UPDATE FOR SECTOR
    $('.updatable-field-sector').on('dblclick', function (e) {
        const $td = $(this)
        $td.next().children('.field-update-sector').val($td.html()).focus()
        $td.addClass(DISPLAY_NONE)
        $td.next().removeClass(DISPLAY_NONE)
    })

    /**
     *
     * @param {object} sector
     * @param {number} sector.id
     * @param {string} sector.name
     * @return {Promise}
     */
    function updateSector(sector) {
        return $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `/admin/gestion-salles/modifier/sector/${sector.id}`,
            type: 'PUT',
            data: JSON.stringify({
                name_sector: sector.name
            })
        })
    }

    $(document).on('keydown','.field-update-sector', function(e) {
        if (e.keyCode === 13) {
            const $input = $(this)
            const newValue = $input.val()
            const $td = $input.parent()
            $td.addClass(DISPLAY_NONE)

            $td.prev().removeClass(DISPLAY_NONE)
            $td.prev().html(newValue)

            const $tr = $td.parent()
            const id = $tr.find('.sector-id').html()
            const name = $tr.find('.sector-name').html()

            updateSector({
                id,
                name
            }).then(res => {
                console.log('succes sector modification')
            }).catch(console.error)
        }
    })

    // AJAX UPDATE FOR ROUTE
    $('.updatable-field-route').on('dblclick', function (e) {
        const $td = $(this)
        $td.next().children('.field-update-route').val($td.html()).focus()
        $td.addClass(DISPLAY_NONE)
        $td.next().removeClass(DISPLAY_NONE)
    })

    /**
     * @param {object} route
     * @param {number} route.id
     * @param {string} route.color
     * @param {string} route.difficulty
     * @param {number} route.score
     * @return {Promise}
     */
    function updateRoute(route) {
        return $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `/admin/gestion-salles/modifier/route/${route.id}`,
            type: 'PUT',
            data: JSON.stringify({
                color: route.color,
                difficulty: route.difficulty,
                score: route.score
            })

        })

    }

    $(document).on('keydown','.field-update-route', function(e) {
        if (e.keyCode === 13) {
            const $input = $(this)
            const newValue = $input.val()
            const $td = $input.parent()
            $td.addClass(DISPLAY_NONE)

            $td.prev().removeClass(DISPLAY_NONE)
            $td.prev().html(newValue)

            const $tr = $td.parent()
            const id = $tr.find('.route-id').html()
            const color = $tr.find('.route-color').html()
            const difficulty = $tr.find('.route-difficulty').html()
            const score = $tr.find('.route-score').html()

            updateRoute({
                id,
                color,
                difficulty,
                score
            }).then(res => {
                console.log('succes route modification')
            }).catch(console.error)
        }
    })

    let body = document.querySelector('body')
    let images = document.querySelectorAll("#image")
    let div = create('div', null, body)
    let imageDiv = create("div", null, body, null, "centerImage")
    let centerImage = document.querySelector("#centerImage")
    console.log(images)
    for (let image of images) {
        image.addEventListener('click', function () {
            console.log(image.style.borderColor)
            div.classList.toggle("transparentDiv")
            imageDiv.classList.toggle("imageCenter")
            imageDiv.style.background = "url('" + image.src + "')"
            imageDiv.style.border = "3px solid " + image.style.borderColor
            imageDiv.style.opacity = "1"
            console.log(image.classList)
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
        close.style.left = "13vw"
        escalapp.style.marginLeft = "10%"
    })
    close.addEventListener("click", function () {
        contest.style.left = "-13vw"
        close.style.left = "-2vw"
        open.style.left = "0"
        escalapp.style.marginLeft = null
    })
})


function create(tag, text, parent, classs = null, id = null) {
    let o = document.createElement(tag)
    if (text != null) {
        o.appendChild(document.createTextNode(text))
    }
    if (classs != null) {
        o.classList.add(classs)
    }
    if (id != null) {
        o.id = id
    }
    parent.appendChild(o)
    return o
}
