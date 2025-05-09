<?php
include("include/header.php");
include("include/footer.php");
include("db.php");
if (isset($_POST['actualizar'])) {
    $_SESSION['rol'] = 2; // con las alertas se sobre cubre la informacion que tenga el session entonces toca renombrarlo
    $id = $_POST['contador'];
    $lectura_actual = $_POST['lectura_fin'];
    $rutaA = $_POST['n_ruta'];
    $queryconsumo = "SELECT `id_contador`, `enero`, `febrero`, `marzo`, `abril`, `mayo`, `junio`, `julio`, `agosto`, `septiembre`, `octubre`, `noviembre`, `diciembre` FROM `consumo` WHERE consumo.id_contador = '$id'";
    $resultadoconsumo = mysqli_query($conn, $queryconsumo);
    if (mysqli_num_rows($resultadoconsumo) == 1) {
        $row = mysqli_fetch_array($resultadoconsumo);
        $enero_con = $row['enero'];
        $febrero_con = $row['febrero'];
        $marzo_con = $row['marzo'];
        $abril_con = $row['abril'];
        $mayo_con = $row['mayo'];
        $junio_con = $row['junio'];
        $julio_con = $row['julio'];
        $agosto_con = $row['agosto'];
        $septiembre_con = $row['septiembre'];
        $octubre_con = $row['octubre'];
        $noviembre_con = $row['noviembre'];
        $diciembre_con = $row['diciembre'];
    }

    $querylecturas = "SELECT fechas_lecturas.enero, fechas_lecturas.febrero, fechas_lecturas.marzo, fechas_lecturas.abril, fechas_lecturas.mayo, fechas_lecturas.junio, fechas_lecturas.julio, fechas_lecturas.agosto, fechas_lecturas.septiembre, fechas_lecturas.octubre, fechas_lecturas.noviembre, fechas_lecturas.diciembre  FROM fechas_lecturas WHERE fechas_lecturas.id_contador='$id'";
    $resultado = mysqli_query($conn, $querylecturas);
    if (mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_array($resultado);
        $enero = $row['enero'];
        $febrero = $row['febrero'];
        $marzo = $row['marzo'];
        $abril = $row['abril'];
        $mayo = $row['mayo'];
        $junio = $row['junio'];
        $julio = $row['julio'];
        $agosto = $row['agosto'];
        $septiembre = $row['septiembre'];
        $octubre = $row['octubre'];
        $noviembre = $row['noviembre'];
        $diciembre = $row['diciembre'];
    }
    // Fecha de la lectura
    date_default_timezone_set("America/Bogota");
    $fechaLectura = date('Y-m-d-H-i-s');
    // Este es para sacar el mes
    date_default_timezone_set("America/Bogota");
    $fecha_lectura = date('m');
    // enero
    if ($fecha_lectura == 01) {
        $suma_noviembre = $julio_con + $agosto_con + $septiembre_con + $octubre_con +  $noviembre_con + $diciembre_con;
        $lectura_i = $suma_noviembre / 6;
        $lectura = $lectura_actual - $diciembre;
    }
    // febrero
    elseif ($fecha_lectura == 02) {
        $suma_noviembre = $agosto_con + $septiembre_con + $octubre_con +  $noviembre_con + $diciembre_con + $enero_con;
        $lectura_i = $suma_noviembre / 6;
        $lectura = $lectura_actual - $enero;
    }
    // marzo
    elseif ($fecha_lectura == 03) {
        $suma_noviembre = $septiembre_con + $octubre_con +  $noviembre_con + $diciembre_con + $enero_con + $febrero_con;
        $lectura_i = $suma_noviembre / 6;
        $lectura = $lectura_actual - $febrero;
    }
    // abril
    elseif ($fecha_lectura == 04) {
        $suma_noviembre = $octubre_con +  $noviembre_con + $diciemb_conre_con + $enero_con + $febrero_con + $marzo_con;
        $lectura_i = $suma_noviembre / 6;
        $lectura = $lectura_actual - $marzo;
    }
    // mayo
    elseif ($fecha_lectura == 05) {
        $suma_noviembre =  $noviembre_con + $diciembre_con + $enero_con + $febrero_con + $marzo_con + $abril_con;
        $lectura_i = $suma_noviembre / 6;
        $lectura = $lectura_actual - $abril;
    }
    // junio
    elseif ($fecha_lectura == 06) {
        $suma_noviembre = $diciembre_con + $enero_con + $febrero_con + $marzo_con + $abril_con + $mayo_con;
        $lectura_i = $suma_noviembre / 6;
        $lectura = $lectura_actual - $mayo;
    }
    // julio
    elseif ($fecha_lectura == 07) {
        $suma_noviembre = $enero_con + $febrero_con + $marzo_con + $abril_con + $mayo_con + $junio_con;
        $lectura_i = $suma_noviembre / 6;
        $lectura = $lectura_actual - $junio;
    }
    // agosto
    elseif ($fecha_lectura == 8) {
        $suma_noviembre = $febrero_con + $marzo_con + $abril_con + $mayo_con + $junio_con + $julio_con;
        $lectura_i = $suma_noviembre / 6;
        $lectura = $lectura_actual - $julio;
    }
    // septiembre
    elseif ($fecha_lectura == 9) {
        $suma_noviembre = $marzo_con + $abril_con + $mayo_con + $junio_con + $julio_con + $agosto_con;
        $lectura_i = $suma_noviembre / 6;
        $lectura = $lectura_actual - $agosto;
    }
    // octubre
    elseif ($fecha_lectura == 10) {
        $suma_noviembre =  $abril_con + $mayo_con + $junio_con + $julio_con + $agosto_con + $septiembre_con;
        $lectura_i = $suma_noviembre / 6;
        $lectura = $lectura_actual - $septiembre;
    }
    // noviembre
    elseif ($fecha_lectura == 11) {
        $suma_noviembre = $mayo_con + $junio_con + $julio_con + $agosto_con + $septiembre_con + $octubre_con;
        $lectura_i = $suma_noviembre / 6;
        $lectura = $lectura_actual - $octubre;
    }
    // diciembre
    if ($fecha_lectura == 12) {
        $suma_diciembre = $noviembre_con + $junio_con + $julio_con + $agosto_con + $septiembre_con + $octubre_con;
        $lectura_i = $suma_diciembre / 6;
        $lectura = $lectura_actual - $noviembre;
        echo $lectura_i, 'lectura i<br>';
        echo $lectura, 'comosumo de esta lectura';
    }
    if ($lectura <= 0) {
        $_SESSION['message_menor'] = 'Hubo una reducción en el medidor, verifica la lectura en el medidor ' . $id;
        header('Location:indexcontador.php?id=' . $id);
    } else {
        if ($lectura_i > 39) {
            $variacion = $lectura_i * 0.35;
            echo $variacion;
            $variacion_significativa = $lectura_i + $variacion;
            if ($lectura > $variacion_significativa) {
                $_SESSION['message_menor'] = 'Consumo mayor de lo habitual en el contador ' . $id;
                header('Location:indexcontador.php?id=' . $id);
            } else {
                $variacion_significativa =$lectura_i - $variacion;
                if ($lectura < $variacion_significativa) {
                    $_SESSION['message_menor'] = 'Consumo menor de lo habitual en el contador ' . $id;
                    header('Location:indexcontador.php?id=' . $id);
                } elseif ($lectura) {
                    $query = "UPDATE contador set lectura_final='$lectura', fecha_lectura='$fechaLectura', lectura_anterior='$lectura_actual' WHERE id_contador = '$id'";
                    mysqli_query($conn, $query);
                    if ($fecha_lectura == 01) {
                        $queryfechal = "UPDATE fechas_lecturas set enero='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.enero='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 02) {
                        $queryfechal = "UPDATE fechas_lecturas set febrero='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.febrero='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 03) {
                        $queryfechal = "UPDATE fechas_lecturas set marzo='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.marzo='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 04) {
                        $queryfechal = "UPDATE fechas_lecturas set abril='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.abril='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 05) {
                        $queryfechal = "UPDATE fechas_lecturas set mayo='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.mayo='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 06) {
                        $queryfechal = "UPDATE fechas_lecturas set junio='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.junio='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 07) {
                        $queryfechal = "UPDATE fechas_lecturas set julio='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.julio='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 8) {
                        $queryfechal = "UPDATE fechas_lecturas set agosto='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.agosto='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 9) {
                        $queryfechal = "UPDATE fechas_lecturas set septiembre='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.septiembre='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 10) {
                        $queryfechal = "UPDATE fechas_lecturas set octubre='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.octubre='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 11) {
                        $queryfechal = "UPDATE fechas_lecturas set noviembre='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.noviembre='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 12) {
                        $queryfechal = "UPDATE fechas_lecturas set diciembre='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.diciembre='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    }

                    $_SESSION['message'] = 'Se realizado la lectura correctamente del contador ' . $id;
                    header('Location:ruta_contador.php?n_ruta=' . $rutaA);
                }
            }
        }
        if ($lectura_i < 40) {
            echo $lectura_i, 'inicial,';
            $variacion = $lectura_i * 0.65;
            echo $variacion, 'variacion,';
            $variacion_significativa = $lectura_i + $variacion;
            if ($lectura > $variacion_significativa) {
                $_SESSION['message_menor'] = 'Consumo mayor de lo habitual en el contador ' . $id;
                header('Location:indexcontador.php?id=' . $id);
                echo $variacion_significativa, '    m';
            } else {
                $variacion_significativa = $lectura_i - $variacion;
                if ($lectura < $variacion_significativa) {
                    echo $variacion_significativa;
                    $_SESSION['message_menor'] = 'Consumo menor de lo habitual en el contador ' . $id;
                    header('Location:indexcontador.php?id=' . $id);
                } elseif ($lectura) {
                    $query = "UPDATE contador set lectura_final='$lectura', fecha_lectura='$fechaLectura', lectura_anterior='$lectura_actual' WHERE id_contador = '$id'";
                    mysqli_query($conn, $query);
                    if ($fecha_lectura == 01) {
                        $queryfechal = "UPDATE fechas_lecturas set enero='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.enero='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 02) {
                        $queryfechal = "UPDATE fechas_lecturas set febrero='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.febrero='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 03) {
                        $queryfechal = "UPDATE fechas_lecturas set marzo='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.marzo='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 04) {
                        $queryfechal = "UPDATE fechas_lecturas set abril='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.abril='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 05) {
                        $queryfechal = "UPDATE fechas_lecturas set mayo='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.mayo='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 06) {
                        $queryfechal = "UPDATE fechas_lecturas set junio='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.junio='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 07) {
                        $queryfechal = "UPDATE fechas_lecturas set julio='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.julio='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 8) {
                        $queryfechal = "UPDATE fechas_lecturas set agosto='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.agosto='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 9) {
                        $queryfechal = "UPDATE fechas_lecturas set septiembre='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.septiembre='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 10) {
                        $queryfechal = "UPDATE fechas_lecturas set octubre='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.octubre='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 11) {
                        $queryfechal = "UPDATE fechas_lecturas set noviembre='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.noviembre='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    } elseif ($fecha_lectura == 12) {
                        $queryfechal = "UPDATE fechas_lecturas set diciembre='$lectura_actual'WHERE id_contador = '$id'";
                        mysqli_query($conn, $queryfechal);
                        //guardar consumo
                        $query_up_consumo = "UPDATE consumo SET consumo.diciembre='$lectura' WHERE consumo.id_contador = '$id' ";
                        mysqli_query($conn, $query_up_consumo);
                    }
                     $_SESSION['message'] = 'Se realizado la lectura correctamente del contador ' . $id;
                     header('Location:ruta_contador.php?n_ruta=' . $rutaA);
                }
            }
        }
    }
}
