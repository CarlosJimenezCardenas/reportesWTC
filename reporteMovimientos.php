<?PHP
$serverName = "192.168.1.246\sqlexpress"; //serverName\instanceName
$connectionInfo = array( "Database"=>"WTC", "UID"=>"luis.aguayo", "PWD"=>"AgLu2049");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$arregloDatos = array();
$data  = json_decode( file_get_contents("https://jadelrio.workteam.com.mx/index.php/processAdminSitio/api/executeProcess?data={%22metodo%22:%22primerReporteApi%22,%22fechaInicial%22:%22".date('Y-m-d',strtotime("-1 days"))."%22,%22fechaFinal%22:%22".date('Y-m-d',strtotime("-1 day"))."%22}&token=f6162382df32b0fa5089244a2fef"), true );
$data2 = json_decode($data);
if(count($data2)>0){
    for($i=0; $i<count($data2);$i++){
        $sql = "INSERT INTO Movimientos 
        (FechaInicio, FechaFin,	FerchaPago, IncidenciasInicio, IncidenciasFin, IdEmpresa, EmpleadosTimbrados,
        EmpleadosCalculados, Perc, Dedu, Tota, TimbresUUID, NombreEmprea, NoPeriodo, IdPeriodo, IdTipoNomina, TipoNomina) 
        VALUES ('".$data2[$i]->fechaInicio."', '".$data2[$i]->fechaFin."', '".$data2[$i]->fechaPago."', '".$data2[$i]->incidenciasInicio."',
        '".$data2[$i]->incidenciasFin."', ".$data2[$i]->idEmpresa.", ".$data2[$i]->empleadosTimbrados.",".$data2[$i]->empleadosCalculados.",
        '".$data2[$i]->perc."','".$data2[$i]->dedu."','".$data2[$i]->tota."', '".$data2[$i]->timbresUUID."', '".$data2[$i]->nombreEmpresa."',
        ".$data2[$i]->noPeriodo.", ".$data2[$i]->idPeriodo.",  ".$data2[$i]->idTipoNomina.", '".$data2[$i]->tipoNomina."')";
        sqlsrv_query( $conn, $sql);
    }
}
sqlsrv_close( $conn );
?>