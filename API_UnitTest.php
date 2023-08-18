<?php
//   /**
//    * Tells the browser to allow code from any origin to access
//    */
//   header("Access-Control-Allow-Origin: *");


//   /**
//    * Tells browsers whether to expose the response to the frontend JavaScript code
//    * when the request's credentials mode (Request.credentials) is include
//    */
//   header("Access-Control-Allow-Credentials: true");
 


//   /**
//    * Specifies one or more methods allowed when accessing a resource in response to a preflight request
//    */
//   header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
 
//   /**
//    * Used in response to a preflight request which includes the Access-Control-Request-Headers to
//    * indicate which HTTP headers can be used during the actual request
//    */
//   header("Access-Control-Allow-Headers: Content-Type");

  require_once('MysqliDb.php');

class API {

    public function __construct(){

        $this->db = new MysqliDB('localhost', 'root', '', 'employee');
    }

    /**
     * HTTP GET Request
     *
     * @param $payload
     */
    public function httpGet($payload = array()){
		
        if(!empty($payload)){
            $this->db->where("id",$payload['id']);
        }

        // execute query
        $query = $this->db->get('information');

        //check if query is success or fail
        if ($query) {
            return json_encode(array(
                'method' => 'GET',
                'status' => 'success',
                'data' => $query,
            ));
        } else {
            return json_encode(array(
                'method' => 'GET',
                'status' => 'fail',
                'data' => [],
                'message' => 'Failed to Fetch'
            ));
        }
    }

    /**
     * HTTP POST Request
     *
     * @param $payload
     */
    public function httpPost($payload){

        $query = $this->db->insert('information', $payload);

        //check if query is success or fail
        if ($query) {
            return json_encode(array(
                'id' => $query,
                'method' => 'POST',
                'status' => 'success',
                'data' => $payload,
            ));
        } else {
            return json_encode(array(
                'method' => 'POST',
                'status' => 'fail',
                'data' => [],
                'message' => 'Failed to Insert'
            ));
        }
    }

    /**
     * HTTP PUT Request
     *
     * @param $id
     * @param $payload
     */
    public function httpPut($id, $payload){
          
        // where clause
        $this->db->where('id', $id);

        //check if query is success or fail
        if($this->db->has('information')){

            $this->db->where('id', $id);
            //Execute query
            $query = $this->db->update('information', $payload);

            if ($query) {
                return json_encode(array(
                    'method' => 'PUT',
                    'status' => 'success',
                    'data' => $payload,
                ));
            } else {
                return json_encode(array(
                    'method' => 'PUT',
                    'status' => 'fail',
                    'data' => [],
                    'message' => 'Failed to Update'
                ));
            }
        }else{
            return json_encode(array(
                'method' => 'PUT',
                'status' => 'fail',
                'data' => [],
                'message' => 'ID DOES NOT EXIST'
            ));
        }
    }

        /**
     * HTTP DELETE Request
     *
     * @param $id
     * @param $payload
     */
    public function httpDelete($id, $payload){
        //Explode the ids
        $selected_id = ['id' => is_string($id) ? explode(",", $id) : null ];
        
        //check if there are any selected ids in the $selected_id array
        if (count($selected_id['id'])){
            //If there are, use the IN operator to search for those specific ids in the 'id' column
            $this->db->where('id', $selected_id['id'], 'IN');
        }else{
            $this->db->where('id', $id);
        }
        
        if($this->db->has("information")){
            
            //check if there are any selected ids in the $selected_id array
            if (count($selected_id['id'])){
                //If there are, use the IN operator to search for those specific ids in the 'id' column
                $this->db->where('id', $selected_id['id'], 'IN');
            }else{
                $this->db->where('id', $id);
            }
            $query = $this->db->delete('information');

            //check if success or fail
            if($query){
                return json_encode(array(
                    'method' => 'DELETE',
                    'status' => 'success',
                    'data' => [],
                ));
                return;
            } else {
                return json_encode(array(
                    'method' => 'DELETE',
                    'status' => 'fail',
                    'data' => [],
                    'message' => 'Failed to Delete',
                ));
            }
        }else{
            return json_encode(array(
                'method' => 'PUT',
                'status' => 'fail',
                'message' => 'ID does not exist',
            ));
        }
    }
}
################################## FUNCTIONS END HERE ##################################
    
    // Identifier if what type of request
    $request_method = $_SERVER['REQUEST_METHOD'];
      // For GET,POST,PUT & DELETE Request
    if ($request_method === 'GET') {
        $received_data = $_GET;
    } else {
        //check if method is PUT or DELETE, and get the ids on URL
        if ($request_method === 'PUT' || $request_method === 'DELETE') {
            
            $request_uri = $_SERVER['REQUEST_URI'];

            $ids = null;

            $exploded_request_uri = array_values(explode("=", $request_uri));

            $last_index = count($exploded_request_uri) - 1;

            $ids = $exploded_request_uri[$last_index];
        }
    }

    //payload data
    $received_data = json_decode(file_get_contents('php://input'), true);
    $api = new API;
    //Checking if what type of request and designating to specific functions
     switch ($request_method) {
         case 'GET':
             echo $api->httpGet($received_data);
             break;
         case 'POST':
             echo $api->httpPost($received_data);
             break;
         case 'PUT':
             echo $api->httpPut($ids, $received_data);
             break;
         case 'DELETE':
             echo $api->httpDelete($ids, $received_data);
             break;
     }
?>