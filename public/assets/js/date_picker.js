$(document).ready(function() {
    // Initialiser le Datepicker
    $('#datepicker').datepicker({
        format: 'yyyy/mm/dd', // Format de date
        autoclose: true, // Fermeture automatique après la sélection de la date
        todayHighlight: true // Mettre en surbrillance la date actuelle
    });
});