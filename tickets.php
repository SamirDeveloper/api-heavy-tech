<?php 
include("db_connect.php");
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            getTickets($id);
        }
        else 
        {
            getTickets();
        }
        break;
    case 'POST':
        // Ajout de produit
        AddTicket();
        break;
    case 'PUT':
        // Modifier un produit
        $id = intval($_GET["id"]);
        updateTicket($id);
        break;
    case 'DELETE':
        // Supprimer un produit
        $id = intval($_GET["id"]);
        deleteTicket($id);
        break;    
    default:
        // Rqt invalide
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function getTickets($id=0)
{
  global $conn;
  $query = "SELECT * FROM ticket";
  if ($id != 0 ) {
      $query .= " WHERE id=".$id." LIMIT 1";
  }
  $response = array();
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_array($result))
  {
    $response[] = $row;
  }
  header('Content-Type: application/json');
  echo json_encode($response, JSON_PRETTY_PRINT);
}

function AddTicket()
{
  global $conn;
  $tps_arrivee = $_POST["temp_arrivee"];
  $description = $_POST["description"];
  $severite = $_POST["severite"];
  //$created = date('Y-m-d H:i:s');
  echo $query="INSERT INTO ticket(temp_arrivee, description, severite,) VALUES('".$tps_arrivee."', '".$description."', '".$severite."')";
  if(mysqli_query($conn, $query))
  {
    $response=array(
      'status' => 1,
      'status_message' =>'ticket ajoute avec succes.'
    );
  }
  else
  {
    $response=array(
      'status' => 0,
      'status_message' =>'ERREUR!.'. mysqli_error($conn)
    );
  }
  header('Content-Type: application/json');
  echo json_encode($response);
}

function updateTicket($id)
{
  global $conn;
  $_PUT = array(); //tableau qui va contenir les données reçues
  parse_str(file_get_contents('php://input'), $_PUT);
  $name = $_PUT["temp_arrivee"];
  $description = $_PUT["description"];
  $price = $_PUT["severite"];
  //construire la requête SQL
  $query="UPDATE ticket SET temp_arrivee='".$temp_arrivee."', description='".$description."', severite='".$severite."' WHERE id=".$id;
  
  if(mysqli_query($conn, $query))
  {
    $response=array(
      'status' => 1,
      'status_message' =>'Ticket mis a jour avec succes.'
    );
  }
  else
  {
    $response=array(
      'status' => 0,
      'status_message' =>'Echec de la mise a jour de Ticket. '. mysqli_error($conn)
    );
    
  }
  
  header('Content-Type: application/json');
  echo json_encode($response);
}

function deleteTicket($id)
{
  global $conn;
  $query = "DELETE FROM ticket WHERE id=".$id;
  if(mysqli_query($conn, $query))
  {
    $response=array(
      'status' => 1,
      'status_message' =>'Ticket supprime avec succes.'
    );
  }
  else
  {
    $response=array(
      'status' => 0,
      'status_message' =>'La suppression du ticket a echoue. '. mysqli_error($conn)
    );
  }
  header('Content-Type: application/json');
  echo json_encode($response);

?>