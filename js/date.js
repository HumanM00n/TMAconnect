$(function () {
  $("#datepicker").datepicker({
    dateFormat: 'dd/mm/yy',
    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    monthNamesShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
    dayNamesMin: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
    minDate: 1, // Aujourd'hui
    maxDate: '+1y', // Un an à partir d'aujourd'hui
    beforeShowDay: function (date) {
      var day = date.getDay();
      return [(day != 0 && day != 6), ''];
    },
    firstDay: 1, // Lundi
    showButtonPanel: true,
  });
});