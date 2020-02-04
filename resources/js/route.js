$('#filter-form').submit(function(e){
    e.preventDefault()

    const sectorName = $('#sector').val()
    const color = $('#color').val()
    const difficulty = $('#difficulty').val()

    const queryParam = []
    if (sectorName !== '') {
        queryParam.push(`sectorNameFilter=${sectorName}`)
    }
    if (color !== '') {
        queryParam.push(`colorFilter=${color}`)
    }
    if (difficulty !== '') {
        queryParam.push(`difficultyFilter=${difficulty}`)
    }

   // if (queryParam.length !== 0) { // TODO Remplacer par réinitialiser ???
        window.location = `${pageUrl}?${queryParam.join('&')}`
    //}
})
