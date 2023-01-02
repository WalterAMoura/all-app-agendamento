(function(win,doc){
    'use strict';
    //Exibir o calendário
    function getCalendar(perfil, div)
    {
        let calendarEl=doc.querySelector(div);
        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar:{
                start: 'prev,next,today',
                center: 'title',
                end: 'dayGridMonth, timeGridWeek, timeGridDay'
            },
            buttonText:{
                today:    'hoje',
                month:    'mês',
                week:     'semana',
                day:      'dia'
            },
            locale:'pt-br',
            editable: true,
            droppable: true,
            dateClick: function(info) {
                if(perfil === 'manager'){
                    calendar.changeView('timeGrid',info.dateStr);
                }else{
                    if(info.view.type === 'dayGridMonth'){
                        calendar.changeView('timeGrid',info.dateStr);
                    }else{
                        win.location.href='add.php?date='+info.dateStr
                    }
                }
                /*alert('Clicked on: ' + info.dateStr);
                alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                alert('Current view: ' + info.view.type);*/
            },
            events: '../../controllers/ControllerEvents.php',
            eventDrop:function(info){
                resizeAndDrop(info).then(r => '');
            },
            eventResize:function(info){
                resizeAndDrop(info).then(r => '');
            },
            eventClick: function(info) {
                if(perfil === 'manager'){
                    win.location.href=`editar.php?id=${info.event.id}`;
                }
            }
        });
        calendar.render();
    }

    if(doc.querySelector('.calendarUser')){
        getCalendar('user','.calendarUser');
    }else if(doc.querySelector('.calendarManager')){
        getCalendar('manager','.calendarManager');
    }else{
        console.log("Sem calendário");
    }

    if(doc.querySelector('#delete')){
        let btn=doc.querySelector('#delete');
        btn.addEventListener('click',(event)=>{
            event.preventDefault();
            //console.log(event.target);
            if(confirm("Deseja mesmo apagar este dado?")){
                win.location.href=event.target.parentNode.href;
            }
        },false);
    }

    // função de arraste e redimensionamento
    async function resizeAndDrop(info){
        let startDate = new Date(info.event.start);
        let month = ((startDate.getMonth()+1)<9)?"0"+(startDate.getMonth()+1):(startDate.getMonth()+1);
        let day = ((startDate.getDate())<9)?"0"+startDate.getDate():startDate.getDate();
        let minutes = ((startDate.getMinutes())<9)?"0"+startDate.getMinutes():startDate.getMinutes();
        startDate = `${startDate.getFullYear()}-${month}-${day} ${startDate.getHours()}:${minutes}:00`;

        let endDate = new Date(info.event.end);
        let eMonth = ((endDate.getMonth()+1)<9)?"0"+(endDate.getMonth()+1):(endDate.getMonth()+1);
        let eDay = ((endDate.getDate())<9)?"0"+endDate.getDate():endDate.getDate();
        let eMinutes = ((endDate.getMinutes())<9)?"0"+endDate.getMinutes():endDate.getMinutes();
        endDate = `${endDate.getFullYear()}-${eMonth}-${eDay} ${endDate.getHours()}:${eMinutes}:00`;

        let reqs = await fetch('https://192.168.1.68/api/v1/app-agenda/controllers/ControllerDrop.php',{
            method: 'post',
            headers: {
                'Content-Type' : 'application/json',
                'Accept' : 'application/json'
            },
            body:JSON.stringify({
                id: info.event.id,
                start: startDate,
                end: endDate
            })
        });
        let ress = await reqs.json();
    }

})(window,document);