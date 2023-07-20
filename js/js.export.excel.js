let date = new Date();
let anneeEnCours = date.getFullYear();

$(".btnexcel").click(function () {
    let wb = XLSX.utils.table_to_book(document.getElementById('idTable'), {sheet: "Employes"});
    let wbout = XLSX.write(wb, {bookType: 'xlsx', bookSST: true, type: 'binary'});
    function s2ab(s) {

        let buf = new ArrayBuffer(s.length);
        let view = new Uint8Array(buf);
        for (let i = 0; i < s.length; i++) {
            view[i] = s.charCodeAt(i) & 0xFF;
        }

        return buf;
    }

    let blob = new Blob([s2ab(wbout)], {type: 'application/octet-stream'});
    saveAs(blob, "lst-employes " + anneeEnCours + ".xlsx");
});