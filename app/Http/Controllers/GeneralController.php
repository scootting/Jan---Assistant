<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\JWTFAuth;
use App\Libraries\DynamicMenu;
use App\General;

use Illuminate\Pagination\LengthAwarePaginator;

class GeneralController extends Controller
{
    //
    //
    //  * Buscar a un usuario de el recurso.
    //  * {username: nombre de usuario, password: clave del usuario}    
    public function searchUser(Request $request){  
        $data = General::SearchUser($request->get('username'), $request->get('password'));
        $token = JWTFAuth::ValidateDataCredential($data);
        $response = array(
            'access_token' => $token,
            'user' => $data
        );        
        return json_encode($response); 
    } 

    //  * Quitar el registro de un usuario en el recurso.    
    public function logoutUser(Request $request){
        return response()->json('Logged out successfully', 200);
    }

    //  * Registrar un usuario en el recurso.    
    public function storeUser(Request $request){
        $usuario = $request->get('usuario');
        $personal = $usuario['personal'];
        \Log::info($personal);
        $data = General::RegisterUser($personal);
        return $data;
    } 
    
    public function registerUserProfiles(Request $request){
        $usuario = $request->get('usuario');
        $gestion = $request->get('gestion');
        $data = General::SearchUserProfiles($usuario, $gestion);
        $profiles = DynamicMenu::GetDataOptions($data);
        return json_encode($profiles);
    }

    public function registerUserYears(Request $request){
        $usuario = $request->get('usuario');
        //\Log::info("entra aca para su prueba".$usuario);

        $years = General::SearchUserYears($usuario);
        return json_encode($years);
    }

    public function getPersonsByDescription(Request $request){
        $descripcion = $request->get('descripcion'); // '' cadena vacia
        //$parametro = $request->get('parametro');
        //$descripcion = 'ROJAS';
        $data = General::GetPersonsByDescription($descripcion);
        
        $page = ($request->get('page')? $request->get('page'): 1);
        $perPage = 10;

        $paginate = new LengthAwarePaginator(
            $data->forPage($page, $perPage),
            $data->count(),
            $perPage,
            $page,
            ['path' => url('api/persons')]
        );
        return json_encode($paginate);
    }

    //  * Obtener una persona de el recurso utilizado.
    //  * {id: numero de carnet de identidad}    
    public function getPersonById($id){        
        $data = General::GetPersonByIdentityCard($id);
        return json_encode($data);
    } 

    //  * Guardas los datos de una persona en el recurso utilizado.
    public function storePerson(Request $request){
        $persona = $request->get('persona');
        $personal = $persona['personal'];
        $nombres = $persona['nombres'];
        $paterno = $persona['paterno'];
        $materno = $persona['materno'];
        $sexo = $persona['sexo'];
        $nacimiento = $persona['nacimiento'];

        $marcador = $request->get('marker');

        switch ($marcador) {
            case 'registrar':
                $data = General::AddPerson($personal, $nombres, $paterno, $materno, $sexo, $nacimiento);
                break;
            case 'editar':
                $data = General::UpdatePerson($personal, $nombres, $paterno, $materno, $sexo, $nacimiento);
            break;
            default:
                break;
        }
        return json_encode($data);
    }

    //  * Obtener una lista de usuarios de el recurso utilizado.
    //  * {parametro: tipo de busqueda por atributo, descripcion: descripcion de la busqueda}    
    public function getUsersByDescription(Request $request){
        
        $descripcion = $request->get('descripcion');
        $data = General::GetUsersByDescription($descripcion);        
        $page = ($request->get('page')? $request->get('page'): 1);
        $perPage = 10;

        $paginate = new LengthAwarePaginator(
            $data->forPage($page, $perPage),
            $data->count(),
            $perPage,
            $page,
            ['path' => url('api/users')]
        );
        return json_encode($paginate);
    }

}