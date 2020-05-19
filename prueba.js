function mueveReloj()
{
    momentoActual = new Date()
    hora = momentoActual.getHours()
    minuto = momentoActual.getMinutes()
    segundo = momentoActual.getSeconds()
    horaPartda = "<?php require(\"./prueba.php\"); echo $hora ?>";
    minPartda = "<?php require(\"./prueba.php\"); echo $min ?>";
    horaImprimible = hora + " : " + minuto + " : " + segundo

    document.form_reloj.reloj.value = horaImprimible

    if (hora===horaPartda & minuto >=minPartda & minuto <minPartda+2) {
        document.getElementById("ubi").innerHTML = 'En vuelo';
    } else if (hora===17 & minuto >=minPartda+2) {
        document.getElementById("ubi").innerHTML = 'Alla';
    } else {
        document.getElementById("ubi").innerHTML = 'Aqui';
    }

    setTimeout("mueveReloj()",1000)
}