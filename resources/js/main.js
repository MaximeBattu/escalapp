document.addEventListener('DOMContentLoaded', function() {

    let close = document.querySelector("#close")
    let routeblocks = document.querySelector("#routeblocks")
    let places = document.querySelectorAll(".place")
    let open = document.querySelector("#open")

    let number = 0

    for (let place of places) {
        number += 1
        if (number == 1)
            place.style.backgroundColor = "gold"
        else if (number == 2)
            place.style.backgroundColor = "silver"
        else if (number == 3)
            place.style.backgroundColor = "darkorange"
    }

    let contest = close.parentElement

    close.addEventListener("click", function() {
        contest.style.display = "none"
        open.style.display = "block"
    })

    open.addEventListener("click", function() {
        contest.style.display = "block"
        open.style.display = "none"
    })



    // disable succes or error message after 4s
    setTimeout(function() {
        $('#adminAccessError').fadeOut()
        $('#addSuccessRoom').fadeOut()
        $('#administratorRight').fadeOut()
    },4000)
})


function create(tag, text, parent, classs=null, id=null)
{
    let o = document.createElement(tag)
    if (text != null) {
        o.appendChild(document.createTextNode(text))
    }
    if (classs!= null) {
        o.classList.add(classs)
    }
    if (id!= null) {
        o.id = id
    }
    parent.appendChild(o)
    return o
}
