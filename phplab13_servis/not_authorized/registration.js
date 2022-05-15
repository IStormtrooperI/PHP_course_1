
//onchange ФИО
function js_fio(x) {
	
	var reg = /^[а-яА-ЯёЁ]+\s[а-яА-ЯёЁ]+\s[а-яА-ЯёЁ]+$/;
	if(reg.test(x.value)) {
		x.style.borderColor = "black";
		document.getElementById('error').style.visibility = "hidden";
	} else {
		x.style.borderColor = "red";
		document.getElementById('error').style.visibility = "visible";
	}

	jsall();
}

//onchange Email
function js_mail(x) {

	var reg = /^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9_-]+\.[a-z]{2,6}$/;
	if(reg.test(x.value)) {
		x.style.borderColor = "black";
		document.getElementById('error').style.visibility = "hidden";
	} else {
		x.style.borderColor = "red";
		document.getElementById('error').style.visibility = "visible";
	}

	jsall();
}

//onchange password
function js_pas(x) {

	var reg = /^[a-zA-Z]{6,}$/;
	if(reg.test(x.value)) {
		x.style.borderColor = "black";
		document.getElementById('error').style.visibility = "hidden";
	} else {
		x.style.borderColor = "red";
		document.getElementById('error').style.visibility = "visible";
	}

	jsall();
}

//onchange Подтверждение password
function js_pas_pod(x) {

	if(x.value === document.getElementById('pas').value) {
		x.style.borderColor = "black";
		document.getElementById('error').style.visibility = "hidden";
	} else {
		x.style.borderColor = "red";
		document.getElementById('error').style.visibility = "visible";
	}

	jsall();
}



//onchange Всё
function jsall() {
	var
		fio = document.getElementById('fio').value,
		email = document.getElementById('mail').value,
		pas = document.getElementById('pas').value,
		pas_pod = document.getElementById('pas_pod').value,
		error = document.getElementById('error').style.visibility;

	if(error === "hidden" && fio !== "" && email !== "" && pas !== "" && pas_pod !== ""){
		document.getElementById('reg_but').type = "submit";
	} else {
		document.getElementById('reg_but').type = "button";
	}


}