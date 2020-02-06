const DISPLAY_NONE = 'd-none'
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

$(document).on('keydown', '.field-update-sector', function (e) {
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
    if (e.keyCode === 27) {
        const $input = $(this)
        const newValue = $input.val()
        const $td = $input.parent()
        $td.addClass(DISPLAY_NONE)

        $td.prev().removeClass(DISPLAY_NONE)
        $td.prev().html(newValue)
    }
})

