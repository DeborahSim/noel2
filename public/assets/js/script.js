$(document).ready(function(){
	/**
	*	fonction qui permet d'afficher les communes
	*	apres saisie du code postale
	*
	*/



	$('#code_postal').keyup(function(){

		$('#selectVille').html('').hide();

		$.ajax ({

			type: "GET",
			url: "assets/json/laposte_hexasmal.json" ,
			dataType: "json",

			success : function(data, status) {
				
				
				var code_postal = $('#code_postal').val();
				// boucle
				$.each(data, function(i, data){
					

					// condition pour le rajout des options
					if (data['fields']['code_postal'] == code_postal ){


						$('#selectVille').append('<option value="'+data['fields']['nom_de_la_commune']+'" >'+data['fields']['nom_de_la_commune']+'</option>');
						$('#selectVille').show();
					}
					
				// fin du each
				});


			// fin du success
			},

			error : function(result, status, error) {
				console.log("Réponse jquery : "+result);
				console.log("Status de requete : " + status);
				console.log("Type d'erreur : "+error);
			},


		// fin ajax
		});
	// fi de la fonction
	});

// fin du script
});