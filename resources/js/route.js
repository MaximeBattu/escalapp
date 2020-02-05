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

    console.log(queryParam);
    

   if (queryParam.length !== 0) { // TODO Remplacer par réinitialiser ???
        window.location = `${pageUrl}?${queryParam.join('&')}`
    } else {
        window.location = `${pageUrl}`
    }
})
