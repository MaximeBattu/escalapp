const DISPLAY_NONE = 'd-none'
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
        url: `/admin/gestion-salles/modifier/salle/${room.id}`,
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
    }
    if (e.keyCode === 27) {
        const $input = $(this)
        const newValue = $input.val()
        const $td = $input.parent()
        $td.addClass(DISPLAY_NONE)

        $td.prev().removeClass(DISPLAY_NONE)
        $td.prev().html(newValue)
    }
})
