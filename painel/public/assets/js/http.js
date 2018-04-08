/**
 *
 * Autor: Vitor Fraga
 * Data: 18/02/2016
 * Versão: 1.0
 * Descrição: Modularizar as requisições HTTP (GET, POST, PUT, DELETE)
 */


 var http = {

	get: function (options){

		alert('teste');
   },

	post: function (){
		alert('post');
		
	},

	put : function (options){
		var data;
		var res  = new Object();

       var settings = {

  			"async": false,
  			"crossDomain": true,
  			"url": options.url,
 			"method": "PUT",
		    "data": options.data,
		}

	   response = $.ajax(settings).done();
	   res.data = response.responseJSON;
	   res.status = response.status;

	   return res;


	},

	delete: function(){

		alert('Delete');


	}

}

