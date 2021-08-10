document.addEventListener('DOMContentLoaded', function () {
    const mesBr = ['Janeiro', 'Fervereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho',
        'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
    const tableDays = document.getElementById('dias');

    function GetDaysCalendar(mes, ano) {
        document.getElementById('mes').innerHTML = mesBr[mes];
        document.getElementById('ano').innerHTML = ano;

        let firstDayOfWeek = new Date(ano, mes, 1).getDay()-1;
        let getLastDayThisMonth = new Date(ano, mes+1, 0).getDate();

        for(var i = -firstDayOfWeek, Agendamento = 0; i < (42-firstDayOfWeek); i++, Agendamento++) {
            let dt = new Date(ano, mes , i);
            let dtNow = new Date();
            let dayTable = tableDays.getElementsByTagName('td')[Agendamento];

            dayTable.classList.remove('mes-anterior');
            dayTable.classList.remove('proximo-mes');
            dayTable.classList.remove('dia-atual');
            //dayTable.classList.remove('dia-click');
            dayTable.innerHTML = dt.getDate();

            if (dt.getFullYear() == dtNow.getFullYear() && dt.getMonth() == 
                    dtNow.getMonth() && dt.getDate() == dtNow.getDate()) {
                dayTable.classList.add('dia-atual')       
            }

            if(i < 1) {
                dayTable.classList.add('mes-anterior')
            }

            if(i > getLastDayThisMonth) {
                dayTable.classList.add('proximo-mes')
            }


        }
    }

    let now = new Date();
    let mes = now.getMonth();
    let ano = now.getFullYear()
    GetDaysCalendar(mes, ano);

    const botao_proximo = document.getElementById('btn_prev');
    const botao_anterior = document.getElementById('btn_ant');

    botao_proximo.onclick = function() {
        mes++;
        if(mes > 11) {
            mes = 0;
            ano++;
        }
        GetDaysCalendar(mes, ano);
    }

    botao_anterior.onclick = function() {
        mes--;
        if(mes < 0) {
            mes = 11;
            ano--;
        }
        GetDaysCalendar(mes, ano);
    }

})


// FUNÇÕES PARA ABRIR A MINIMODAL
function abrir() {
    let modal = document.querySelector('.Minimodal')
    modal.style.display = 'block';
}

function abrir2() {
    let modal2 = document.querySelector('.Minimodal2')
    modal2.style.display = 'block';
}


// FUNÇÕES PARA FECHAR A MINIMODAL
function fechar() {
    let modal = document.querySelector('.Minimodal')
    modal.style.display = 'none';
}

function fechar2() {
    let modal2 = document.querySelector('.Minimodal2')
    modal2.style.display = 'none';
}
