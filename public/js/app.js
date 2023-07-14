$(function(){

    let selectedDate = $("#select_date").val();
    $("#selected_date").text((new Date(selectedDate)).toDateString());

    $("#select_date").change(function (e) { 
        e.preventDefault();
        changedSelectedDate = e.target.value;
        // dissallow attendance register in a future date
        if ((new Date(changedSelectedDate)).getTime() > (new Date()).getTime()) {
            alert("You cannot mark attendance for the future");
            e.target.value = selectedDate;
            return;
        } 

        let formattedDate =  (new Date(changedSelectedDate)).toDateString();
        $("#selected_date").text(formattedDate);
        if ('URLSearchParams' in window) {
            var searchParams = new URLSearchParams(window.location.search)
            searchParams.set("date", changedSelectedDate);
            var newRelativePathQuery = window.location.pathname + '?' + searchParams.toString();
            history.pushState(null, '', newRelativePathQuery);
        }
        window.location.reload();
    });


})

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

(function createPseudoImage(){
    let collection = $(".pseudo_image");
    let randColors = ['bg-blue-200', 'bg-red-200', 'bg-green-200', 'bg-orange-200', 'bg-purple-200', 'bg-yellow-200'];
    let result = [];
    for(let i = 0; i < collection.length; i++){
        let name = collection[i].getAttribute("__name").split(' ');
        collection[i].textContent = `${name[0].charAt(0)}`;     
        collection[i].textContent += `${name[1].charAt(0)}`;     
        result.push(randColors[Math.floor(Math.random() * randColors.length)]);
        collection[i].classList.add(randColors[Math.floor(Math.random() * randColors.length)]);     
    }
})()