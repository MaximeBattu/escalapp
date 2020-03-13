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
 * @param {number} route.id_color
 * @param {string} route.color
 * @param {string} route.nameColor
 * @param {string} route.difficulty
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
            id_color: route.id_color,
            color: route.color,
            nameColor: route.nameColor,
            difficulty: route.difficulty
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
        const id_color = $tr.find('.color-id').html()
        const color = $tr.find('.route-code').html()
        const nameColor = $tr.find('.route-color-name').html()
        const difficulty = $tr.find('.route-difficulty').html()

        updateRoute({
            id,
            id_color,
            color,
            nameColor,
            difficulty
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

/**
 *
 * @param {object} route
 * @param {number} route.id
 * @param {string} routes.labels
 * @returns {Promise}
 */
function addLabels(route) {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: `/admin/gestion-salles/modifier/route/${route.id}/ajouter-labels`,
        type: 'PUT',
        data: JSON.stringify({
            idRoute: route.id,
            labels: route.labels
        })

    })
}

$('.route-labels').on('keydown', function(e) {
    if (e.keyCode === 13) {
        const $tr = $(this).parent().parent()
        const id = $tr.find('.route-id').html()
        const labels = $tr.find('.route-labels').val()

        addLabels({
            id,
            labels
        }).then(res => {
            console.log('succes update on labels')
        }).catch(console.error)
    }
})
