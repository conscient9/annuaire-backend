<?php 
namespace App\Gestions;
/**
 * 
 */

use App\Models\{Utilisateur};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GestionUtilisateur
{
	
	public function store($data)
	{

		$token = Str::random(60);

		$user = Utilisateur::create([
			'nom_utilisateur' => $data->user_name,
			'nom' => $data->nom,
			'prenom' => $data->prenom,
			'email' => $data->email,
			'telephone' => $data->telephone,
			'date_de_creation' => now(),
			'password' => Hash::make($data->password),
			'api_token' => $token
		]);

		return response()->json([
			'status' => true,
			'api_token' => $token,
			'id' => $user->id_utilisateur,
			'nom' => $user->nom,
			'prenom' => $user->prenom,
			'message' => trans("Inscription effectuée avec succès")
		]);
	}

	public function login($data){

		$user = Utilisateur::whereNomUtilisateur($data->username);

		if ($user->exists()) {
			$user = $user->first();

			$hashedPassword = $user->password;

			if (Hash::check($data->password, $hashedPassword)) {

		    	return response()->json([
					'status' => true,
					'api_token' => $user->api_token,
					'message' => "Utilisateur authentifié",
				]);
			}
		}


		return response()->json([
			'status' => false,
			'message' => "identifiant ou mot de passe incorrect",
		], 403);
	}
}
 ?>