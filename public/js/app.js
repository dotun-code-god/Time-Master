$(function(){

    let selectedDate = selectDate(new Date(), 'yyyy-mm-dd');
    selectDate(new Date(), 'date_string');
    $("#select_date").val(selectedDate);

    $("#select_date").change(function (e) { 
        e.preventDefault();
        selectedDate = e.target.value;
        selectDate(new Date(selectedDate), 'date_string');
    });


})

function selectDate(date, format){
    let formattedDate;
    if(format == 'date_string') {
        formattedDate = date.toDateString();
        $("#selected_date").text(formattedDate);
        return;
    } else if(format == 'yyyy-mm-dd') {
        const day = date.getDate() > 9 ? date.getDate() : '0' + date.getDate();
        const month = date.getMonth() > 9 ? date.getMonth() + 1 : '0' + (date.getMonth() + 1);
        const year = date.getFullYear();
        formattedDate = `${year}-${month}-${day}`;
        return formattedDate;
    }
}