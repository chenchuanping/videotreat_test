	//回车转Tab
	function cgo(obj, element, method) {
		var e = event ? event : window.event;

		if (e.keyCode == 13) {
			for ( var i = 0; i < obj.length; i++) {
				if (obj[i].name == element) {
					id = i;
				}
			}
			obj[id + 1].focus();
		}

	}