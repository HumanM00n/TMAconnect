$(function() {
  $("#datepicker").datepicker({
      dateFormat: 'yy-mm-dd', // Format de date pour la compatibilité avec le champ "date"
      firstDay: 1, // Lundi
      dayNamesMin: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
      beforeShowDay: function(date) {
          var day = date.getDay();
          return [(day != 0), ''];
      }
  });
  $("#datepicker").attr('type', 'date'); // Convertit le champ en texte pour désactiver le datepicker natif
});






// $( function() {
//   $("#datepicker").datepicker({
//       dateFormat: 'dd/mm/yy',
//       monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
//       monthNamesShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
//       dayNamesMin: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim']
//   });
// });
