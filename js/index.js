$("#place").change(function(){
    console.log($("#place").val(),findPlaceId($("#place").val()))
    $("#placeid").val(findPlaceId($("#place").val()))
})

function findPlaceId(pl){
const place = ["Alappuzha","Ernakulam","Idukki","Kannur","Kasaragod","Kollam","Kottayam","Kozhikode","Malappuram","Palakkad","Pathanamthitta","Thiruvananthapuram","Thrissur","Wayanad"];
return place.indexOf(pl);
}