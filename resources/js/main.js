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
    for(let image of images) {
        console.log(image.classList)
        image.addEventListener('click', function() {
            div.classList.toggle("transparentDiv")
            image.classList.toggle("imageCenter")
        })
        div.addEventListener('click', function() {
            div.classList.remove("transparentDiv")
            image.classList.remove("imageCenter")
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
