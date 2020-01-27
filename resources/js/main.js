// disable succes or error message after 4s
setTimeout(function() {
    $('#adminAccessError').fadeOut()
    $('#addSuccessRoom').fadeOut()
    $('#administratorRight').fadeOut()
    $('#profileModification').fadeOut()
},4000)


document.addEventListener('DOMContentLoaded', function() {

    let body = document.querySelector('body')
    let images = document.querySelectorAll("#image")
    let div = create('div',null,body)
    let imageDiv = create("div",null, body,null,"centerImage")
    let centerImage = document.querySelector("#centerImage")
    console.log(images)
    for(let image of images) {
        image.addEventListener('click', function() {
            console.log(image.style.borderColor)
            div.classList.toggle("transparentDiv")
            imageDiv.classList.toggle("imageCenter")
            imageDiv.style.background = "url('"+image.src+"')"
            imageDiv.style.border = "3px solid " + image.style.borderColor
            imageDiv.style.opacity = "1"
            console.log(image.classList)
        })
        div.addEventListener('click', function() {
            div.classList.remove("transparentDiv")
            imageDiv.classList.remove("imageCenter")
            imageDiv.style.background = null
            centerImage.style.border = "none"
        })
        centerImage.addEventListener('click', function() {
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
        title.addEventListener("click", function() {
            for(let score of scores) {
                score.style.display = "block"
            }
        })
    }

	open.addEventListener("click", function() {
		contest.style.left = "0"
        open.style.left = "-5vw"
        close.style.left ="13vw"
        escalapp.style.marginLeft = "10%"
    })
    close.addEventListener("click", function() {
        contest.style.left = "-13vw"
        close.style.left = "-2vw"
        open.style.left = "0"
        escalapp.style.marginLeft = null
    })
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
