var app = angular.module('autenticacion-login').service('loginService', function ($http, $q) {

	return {									
		/*/home/tupatri2/public_html/testservices/servicios*/
		autenticaUsuario: function (usuario, pwd){
			
		return $http.get('http://localhost:80/servicios/api/servicios-admin-user-sig-in.php?nombreUsuario=' + usuario + '&&pass=' + pwd)
				.then(
					function successCallback(response) {

						return response.data;
					},
					function errorCallback(errResponse) {

						return $q.reject(errResponse);
					}
				);
		}


}});
