function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}	


function decodeParameter(param) {
	if(param) {
		return decodeURIComponent(param.replace(/\+/g, ' '));
	} else {
		return param;
	}
}

function initCookie() {
	var orderinfo = {
	    DateAvailable: "",
	    shippingfromzip: "",
	    shippingfromcity: "",
	    shippingfromstate: "",
	    shippingtozip: "",
	    shippingtocity: "",
	    shippingtostate: "",    
	    vehicle_operational: "",
	    vehicle_trailer: "",
	    howmany: "",
	    numvehicles: "",
	    auto_make_index: "",
	    auto_model_index: "",
	    auto_year: "",
	    auto_make: "",
	    auto_model: "",    
	    auto_year2: "",
	    auto_make2: "",
	    auto_model2: "",
	    auto_year3: "",
	    auto_make3: "",
	    auto_model3: "",
	    auto_year4: "",
	    auto_make4: "",
	    auto_model4: "",
	    auto_year5: "",
	    auto_make5: "",
	    auto_model5: ""
	}

	var jsonOrderInfo = JSON.stringify(orderinfo);
	createCookie('OrderInfo',jsonOrderInfo);
}