<?php include("../../config/config.php"); ?>
<?php include(DIRREQ."lib/html/header.php"); ?>

<?php
    $date=new \DateTime($_GET['date'], new \DateTimeZone('America/Sao_Paulo'));
?>

    <form name="formAdd"  method="post" action="<?php echo DIRPAGE.'controllers/ControllerAdd.php'; ?>">
        Data: <input type="date" name="date" id="date" value="<?php echo $date->format("Y-m-d"); ?>"><br>
        Hora: <input type="time" name="time" id="time" value="<?php echo $date->format("H:i"); ?>"><br>
        Orador: <input type="text" name="orador" id="orador"><br>
        Telefone: <input type="text" name="telefone" id="telefone"><br>
        1° Hino: <input type="text" name="primeiroHino" id="primeiroHino"><br>
        Hino Final: <input type="text" name="hinoFinal" id="hinoFinal"><br>
        Tema: <input type="text" name="tema" id="tema"><br>
        Status:
        <select name="status" id="status">
            <option value="">Selecione</option>
            <option value="CONFIRMADO">CONFIRMADO</option>
            <option value="PENDENTE_CONFIRMAR">PENDENTE_CONFIRMAR</option>
            <option value="AGENDADO">AGENDADO</option>
        </select>
        <br>
        <br>
        <input type="submit" value="Adicionar Evento">
    </form>

<?php include(DIRREQ."lib/html/footer.php"); ?>