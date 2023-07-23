 function SubmitFormData() {
    var tes = $("#tes").val();
    $.post("index.php", { tes },
    function(data) {
   $('#results').html(data);
   $('#Form1')[0].reset();
    });
}