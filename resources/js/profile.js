
// PROFILE ACHIEVEMENTS
let achievements = document.querySelectorAll(".achievements")
for (let achievement of achievements) {
    achievement.addEventListener("click", function() {
        let inforoutes = achievement.querySelectorAll(".inforoute")
        for (let inforoute of inforoutes) {
        	inforoute.classList.toggle("nope")
        }
    })
}