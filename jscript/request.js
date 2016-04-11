/* 
	XmlHttpRequest Wrapper
	Version 1.2.2
	29 Jul 2005 
	adamv.com/dev/
*/

var Http = {
	ReadyState: {
		Uninitialized: 0,
		Loading: 1,
		Loaded:2,
		Interactive:3,
		Complete: 4
	},
		
	Status: {
		OK: 200,
		
		Created: 201,
		Accepted: 202,
		NoContent: 204,
		
		BadRequest: 400,
		Forbidden: 403,
		NotFound: 404,
		Gone: 410,
		
		ServerError: 500
	},
		
	Cache: {
		Get: 1,
		GetCache: 2,
		GetNoCache: 3,
		FromCache: 4
	},
	
	Method: {Get: "GET", Post: "POST", Put: "PUT", Delete: "DELETE"},
	
	enabled: false,
	logging: false,
	_get: null,	// Reference to the XmlHttpRequest object
	_cache: new Object(),
	
	Init: function(){
		Http._get = Http._getXmlHttp()
		Http.enabled = (Http._get != null)
		Http.logging = (window.Logging != null);
	},
	
	_getXmlHttp: function(){
	/*@cc_on @*//*@if (@_jscript_version >= 5)
		try { return new ActiveXObject("Msxml2.XMLHTTP"); } 
		catch (e) {} 
		try { return new ActiveXObject("Microsoft.XMLHTTP"); } 
		catch (e) {} 
	@end @*/
		try { return new XMLHttpRequest();}
		catch (e) {}

		return null;
	},

/*
	Params:
		url: The URL to request. Required.
		cache: Cache control. Defaults to Cache.Get.
		callback: onreadystatechange function, called when request is completed. Optional.
		method: HTTP method. Defaults to Method.Get.
*/
	get: function(params, callback_args){	
		if (!Http.enabled) throw "Http: XmlHttpRequest not available.";
		
		var url = params.url;
		if (!url) throw "Http: A URL must be specified";
				
		var cache = params.cache || Http.Cache.Get;
		var method = params.method || Http.Method.Get;
		var callback = params.callback;
		
		if ((cache == Http.Cache.FromCache) || (cache == Http.Cache.GetCache))
		{
			var in_cache = Http.from_cache(url, callback, callback_args)

			if (Http.logging){
				Logging.log(["Http: URL in cache: " + in_cache]);
			}

			if (in_cache || (cache == Http.Cache.FromCache)) return in_cache;
		}
		
		if (cache == Http.Cache.GetNoCache)
		{
			var sep = (-1 < url.indexOf("?")) ? "&" : "?"	
			url = url + sep + "__=" + encodeURIComponent((new Date()).getTime());
		}
	
		// Only one request at a time, please
		if ((Http._get.readyState != Http.ReadyState.Uninitialized) && 
			(Http._get.readyState != Http.ReadyState.Complete)){
			this._get.abort();
			
			if (Http.logging){
				Logging.log(["Http: Aborted request in progress."]);
			}
		}
		
		Http._get.open(method, url, true);

		Http._get.onreadystatechange =  function() {
			if (Http._get.readyState != Http.ReadyState.Complete) return;
			
			if (Http.logging){
				Logging.log(["Http: Returned, status: " + Http._get.status]);
			}

			if ((cache == Http.Cache.GetCache) && (Http._get.status == Http.Status.OK)){
				Http._cache[url] = Http._get.responseText;
			}
			
			if (callback_args == null) callback_args = new Array();

			var cb_params = new Array();
			cb_params.push(Http._get);
			for(var i=0;i<callback_args.length;i++)
				cb_params.push(callback_args[i]);
				
			callback.apply(null, cb_params);
		}
		
		if(Http.logging){
			Logging.log(["Http: Started\n\tURL: " + url + "\n\tMethod: " + method + "; Cache: " + Hash.keyName(Http.Cache,cache)])
		}
		
		Http._get.send(params.body || null);
	},
	
	from_cache: function(url, callback, callback_args){
		var result = Http._cache[url];
		
		if (result != null) {
			var response = new Http.CachedResponse(result)
			
			var cb_params = new Array();
			cb_params.push(response);
			for(var i=0;i<callback_args.length;i++)
				cb_params.push(callback_args[i]);
							
			callback.apply(null, cb_params);
				
			return true
		}
		else
			return false
	},
	
	clear_cache: function(){
		Http._cache = new Object();
	},
	
	is_cached: function(url){
		return Http._cache[url]!=null;
	},
	
	CachedResponse: function(response) {
		this.readyState = Http.ReadyState.Complete
		this.status = Http.Status.OK
		this.responseText = response
	}	
}

Http.Init()

function json_response(response){
	var js = response.responseText;
	try{
		return eval(js); 
	} catch(e){
		if (Http.logging){
			Logging.logError(["json_response: " + e]);
		}
		else{
			alert("Error: " + e + "\n" + js);
		}
		return null;
	}
}

function getResponseProps(response, header){
	try {
		var s = response.getResponseHeader(header || 'X-Ajax-Props');
		if (s==null || s=="")
			return new Object()
		else
			return eval("o="+s)
	} catch (e) { return new Object() }
}

