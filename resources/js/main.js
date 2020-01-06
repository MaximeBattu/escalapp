// disable succes or error message after 4s
setTimeout(function() {
    $('#adminAccessError').fadeOut()
    $('#addSuccessRoom').fadeOut()
    $('#administratorRight').fadeOut()
    $('#profileModification').fadeOut()
},4000)

document.addEventListener('DOMContentLoaded', function() {
    let body = document.querySelector('body')
    let imagesVoie = document.querySelectorAll('.imgVoie')
    console.log(imagesVoie)

    let div = create("div", null, body)
    for(let imageVoie of imagesVoie) {
        imageVoie.addEventListener('click', function() {
            div.classList.toggle('imgOnPage')
            imageVoie.classList.toggle('imgOnMiddleScreen')
        })
        div.addEventListener('click', function() {
            div.classList.remove('imgOnPage')
            imageVoie.classList.remove('imgOnMiddleScreen')
        })
    }


	let contest = document.querySelector("#contest")
	let close = document.querySelector("#close")
	let open = document.querySelector("#open")


	close.addEventListener("click", function() {
		contest.style.display = "none"
		open.style.display = "block"
	})

	open.addEventListener("click", function() {
		contest.style.display = "block"
		open.style.display = "none"
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
