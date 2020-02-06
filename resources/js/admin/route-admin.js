const DISPLAY_NONE = 'd-none'
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

$(document).on('keydown', '.field-update-route', function (e) {
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
    if (e.keyCode === 27) {
        const $input = $(this)
        const newValue = $input.val()
        const $td = $input.parent()
        $td.addClass(DISPLAY_NONE)

        $td.prev().removeClass(DISPLAY_NONE)
        $td.prev().html(newValue)
    }
})
