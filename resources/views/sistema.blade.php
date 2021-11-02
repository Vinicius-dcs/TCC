<?php

session_start();
if(!isset($_SESSION['loginAutorizado'])) {
    ?>
    @include('layouts.unauthorized')
    <?php    
} else {
?>
    @include('layouts.header')
    @include('layouts.menu')
<?php
}
?>
