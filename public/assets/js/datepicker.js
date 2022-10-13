$(document).ready(function(){

    $('.input-daterange').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        calendarWeeks : true,
        clearBtn: true,
        disableTouchKeyboard: true,
        language: 'es'
    });

    // The Calender
    $('#calendar').datepicker({
        format: 'dd-mm-yyyy',
        inline: true,
        // calendarWeeks : true,
        firstDay: 1,
        disableTouchKeyboard: true,
        language: 'es',
        // startDate: '0d',
    }).datepicker("setDate", new Date());

});