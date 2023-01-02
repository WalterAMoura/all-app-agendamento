<?php include("../../config/config.php"); ?>
<?php include(DIRREQ."lib/html/header.php"); ?>

<?php
  $objetoEvents=new \Classes\ClassEvents();
  $events=$objetoEvents->getEventById($_GET['id']);
  $date=new \DateTime($events['start']);
?>

    <a id="delete" href="<?php echo DIRPAGE.'controllers/ControllerDelete.php?id='.$_GET['id']; ?>"><img src="<?php echo DIRPAGE.'img/button-trash.png'; ?>" alt=""></a>
    <form name="formEdit"  method="post" action="<?php echo DIRPAGE.'controllers/ControllerEdit.php'; ?>">
        <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>"><br>
        Data: <input type="date" name="date" id="date" value="<?php echo $date->format("Y-m-d"); ?>"><br>
        Hora: <input type="time" name="time" id="time" value="<?php echo $date->format("H:i"); ?>"><br>
        Orador: <input type="text" name="orador" id="orador" value="<?php echo $events['orador']; ?>"><br>
        Telefone: <input type="text" name="telefone" id="telefone" value="<?php echo $events['contato']; ?>"><br>
        1° Hino: <input type="text" name="primeiroHino" id="primeiroHino" value="<?php echo $events['hino_inicial']; ?>"><br>
        Hino Final: <input type="text" name="hinoFinal" id="hinoFinal" value="<?php echo $events['hino_final']; ?>"><br>
        Tema: <input type="text" name="tema" id="tema" value="<?php echo $events['description']; ?>"><br>
        Status:
        <select name="status" id="status">
            <option value="">Selecione</option>
            <option value="CONFIRMADO">CONFIRMADO</option>
            <option value="PENDENTE_CONFIRMAR">PENDENTE_CONFIRMAR</option>
            <option value="AGENDADO">AGENDADO</option>
        </select>
        <br>
        <br>
        <input type="submit" value="Atualizar Evento">
    </form>


<?php include(DIRREQ."lib/html/footer.php"); ?>