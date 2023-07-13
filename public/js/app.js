$(function(){

    let selectedDate = selectDate(new Date(), 'yyyy-mm-dd');
    selectDate(new Date(), 'date_string');
    $("#select_date").val(selectedDate);

    $("#select_date").change(function (e) { 
        e.preventDefault();
        selectedDate = e.target.value;
        selectDate(new Date(selectedDate), 'date_string');
        // also make sure that if check is a previous date hide mark all absent/preesent button
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

function selectAndDeselectAttendance(id){
    let pair = $(`#${id}`).parents('td').find('label').not(`#label_${id}`);
    if ($(`#${id}`).is(':checked') && !pair.find('input')[0].checked){
        $(`#${id}`)[0].checked = true;
    } else if (pair.find('input')[0].checked){
        pair.find('input')[0].checked = false;
    }
    else {
        $(`#${id}`)[0].checked = true;
    }
}

function markAll(mode){
    const detmnt1 = mode ? 'present' : 'absent';
    const detmnt2 = mode ? 'absent' : 'present';
    let collection1 = $('#employees_table').find(`input[id^=${detmnt1}]`);
    let collection2 = $('#employees_table').find(`input[id^=${detmnt2}]`);
    $.each(collection1, function (indx, val) { 
        val.checked = true;
    });
    $.each(collection2, function (indx, val) { 
        val.checked = false;
    });
}