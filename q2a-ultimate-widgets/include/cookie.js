/**
 * doCookie: function to get or set a cookie
 * @param name (string): cookie name
 * @param value (string - optional): cookie value to set
 * @param options (object - optional): possible options are
 *  - expires: (number of days | proper datetime string)
 *  - path: (string)
 *  - domain: (string)
 */
 if (typeof doCookie != 'function') { 
	function doCookie(name, value, options) {
		var expires = '', date, path, domain, cookieValue = null, cookie, cookies, i;
		if (typeof value !== 'undefined') {
			/* value provided, set cookie */
			options = options || {};
			if (value === null) {
				value = '';
				options.expires = -1;
			}
			if (options.expires && (typeof options.expires === 'number' || options.expires.toUTCString)) {
				if (typeof options.expires === 'number') {
					date = new Date();
					date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
				} else {
					date = options.expires;
				}
				expires = '; expires=' + date.toUTCString();
			}
			path = options.path ? '; path=' + (options.path) : '';
			domain = options.domain ? '; domain=' + (options.domain) : '';
			document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain].join('');
		} else {
			/* no value, get cookie */
			if (document.cookie && document.cookie !== '') {
				cookies = document.cookie.split(';');
				for (i = 0; i < cookies.length; i += 1) {
					// trim value
					cookie = cookies[i].replace(/^[\s]+/, '').replace(/[\s]+$/, '');
					if (cookie.indexOf(name + '=') === 0) {
						cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
						break;
					}
				}
			}
			return cookieValue;
		}
	}
}
