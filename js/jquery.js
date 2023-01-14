var modals = document.getElementById('myModals');
var btns  = document.getElementById("myBtns");
var spans  = document.getElementsByClassName("closes");

btns.onclick = function(){
	modals.style.display = "block";
}
spans.onclick = function(){
	modals.style.display = "none";
}
window.onclick = function(event){
	if(event.target == modal){
		modals.style.display = "none";
	}
}
function makeField() {
  var input = getElementById('displaynik');
  document.body.appendChild(input);
}
function viewDiv(){
  document.getElementById("displaynik").style.display = "block";
};