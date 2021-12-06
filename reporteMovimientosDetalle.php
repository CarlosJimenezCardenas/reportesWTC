<?PHP
$serverName = "192.168.1.246\sqlexpress"; //serverName\instanceName
$connectionInfo = array( "Database"=>"WTC", "UID"=>"luis.aguayo", "PWD"=>"AgLu2049");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$data  = json_decode( file_get_contents("https://jadelrio.workteam.com.mx/index.php/processAdminSitio/api/executeProcess?data={%22metodo%22:%22segundoReporteApi%22,%22fechaInicial%22:%22".date('Y-m-d',strtotime("-1 day"))."%22,%22fechaFinal%22:%22".date('Y-m-d',strtotime("-1 day"))."%22}&token=f6162382df32b0fa5089244a2fef"),true);
$datosMovimiento = json_decode($data);
if(count($datosMovimiento)>0){
    for($i=0; $i<count($datosMovimiento);$i++){
        $sql = "INSERT INTO movimientosDetalle 
        (Trabajador, Empresa, NombreEmpresa, Fercha, TipoMovimiento, NombreMovimiento) 
        VALUES ('".$datosMovimiento[$i]->trabajador."', ".$datosMovimiento[$i]->empresa.", '".$datosMovimiento[$i]->nombreEmpresa."', '".$datosMovimiento[$i]->fecha."',
        '".$datosMovimiento[$i]->tipoMovimiento."', '".$datosMovimiento[$i]->nombreMovimiento."')";
        sqlsrv_query( $conn, $sql);
    }
}
sqlsrv_close( $conn );
?>