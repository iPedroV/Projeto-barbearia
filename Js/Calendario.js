const AVAILABLE_WEEK_DAYS = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
const AVAILABLE_MONTH = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
const AVAILABLE_MONTH_NUMBER = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
const localStorageName = 'calendar-events';

class CALENDAR {
    constructor(options) {
        this.options = options;
        this.elements = {
            days: this.getFirstElementInsideIdByClassName('calendar-days'),
            week: this.getFirstElementInsideIdByClassName('calendar-week'),
            month: this.getFirstElementInsideIdByClassName('calendar-month'),
            year: this.getFirstElementInsideIdByClassName('calendar-current-year'),
            eventList: this.getFirstElementInsideIdByClassName('current-day-events-list'),
            eventField: this.getFirstElementInsideIdByClassName('add-event-day-field'),
            eventAddBtn: this.getFirstElementInsideIdByClassName('btn-Enviar'),
            currentDay: this.getFirstElementInsideIdByClassName('calendar-left-side-day'),
            currentWeekDay: this.getFirstElementInsideIdByClassName('calendar-left-side-day-of-week'),
            currentMonth: this.getFirstElementInsideIdByClassName('calendar-left-side-month'),
            prevYear: this.getFirstElementInsideIdByClassName('calendar-change-year-slider-prev'),
            nextYear: this.getFirstElementInsideIdByClassName('calendar-change-year-slider-next'),

            // CHAMAR O DIA NA MODAL DO CADASTRO!!
            diaEscolhido: this.getFirstElementInsideIdByClassName('calendar-event-escolido')
        };
        
        this.eventList = 'Agendamento Realizado' || {};

        this.date = +new Date();
        this.options.maxDays = 42;
        this.init();
    }

// App methods
    init() {
        if (!this.options.id) return false;
        this.eventsTrigger();
        this.drawAll();
    }

    // draw Methods
    drawAll() {
        this.drawWeekDays();
        this.drawMonths();
        this.drawDays();       
        this.drawEvents();

        /* Métodos para Chamar a Data no calendário */
        this.drawDateConfirm(); /* Primeiro ele puxa os dados para o Input */
        this.drawYearAndCurrentDay(); /* Depois ele joga na tela para a visuaçização do Usuário */
        this.drawDateFormate(); /* Chamando a data formatado do Script */
        this.drawDateFormateFinal_Semana(); /* Chamando a data final de semana */
    }

    // Evento para Comentário se há ou não agendamento
    
    drawEvents() {
        let calendar = this.getCalendar();
        let eventList = this.eventList[calendar.active.formatted] || ['Sem agendamento'];
        let eventTemplate = "";
        
        eventList.forEach(item => {
            eventTemplate += `<li>${item}</li>`; //CHAMAR O BANCO DE DADOS PARA CHAMAR AQUI!!
        });

        this.elements.eventList.innerHTML = eventTemplate;
    }
    

    drawYearAndCurrentDay() {
        // SUBClasse que chama o dia, a semana e o ano dentro do calendário.
        function adicionaZero(numero){
            if (numero <= 9) 
                return "0" + numero;
            else
                return numero; 
        }

        let calendar = this.getCalendar();
        this.elements.year.innerHTML = calendar.active.year;
        this.elements.currentDay.innerHTML = adicionaZero([calendar.active.day]);
        this.elements.currentWeekDay.innerHTML = AVAILABLE_WEEK_DAYS[calendar.active.week];
        
        // Passando para o nome por extenso dos meses para o calendário utilizando o metodo
        // o método para colocar o Objeto dentro do array.
        let monthLeft = [this.elements.currentMonth.innerHTML = AVAILABLE_MONTH[calendar.active.month]];
        document.getElementsByClassName('calendar-left-side-month').value = monthLeft;
    }

    drawDateConfirm() {
        // SUBClasse que chama o dia, a semana e o ano dentro do calendário. 
        // Adicionando o Onjeto ao Input da data escolhida pelo usuário.
        function adicionaZero(numero){
            if (numero <= 9) 
                return "0" + numero;
            else
                return numero; 
        }

        let calendar = this.getCalendar();
        let eventListday = [this.elements.currentDay.innerHTML = calendar.active.day];
        let eventListYear = [this.elements.year.innerHTML = calendar.active.year];
        let eventListMonthNumber = [this.elements.currentMonth.innerHTML = AVAILABLE_MONTH_NUMBER[calendar.active.month]];

        // Data que será inserida no banco de dados do agendamento
        document.getElementById('dataAgendamento').value = eventListYear +"-"+ eventListMonthNumber +"-"+ adicionaZero(eventListday);
    }

    drawDateFormateFinal_Semana() {
        // SUBClasse que chama o dia, a semana e o ano dentro do calendário. 
        // Adicionando o Onjeto ao Input da data escolhida pelo usuário.

        let calendar = this.getCalendar();
        let eventListWeekday = [this.elements.currentWeekDay.innerHTML = AVAILABLE_WEEK_DAYS[calendar.active.week]];

        // Data para verificação do Final de Semana
        document.getElementById('final_semana').value = eventListWeekday;
    }

    drawDateFormate() {
        // SUBClasse que chama o dia, a semana e o ano dentro do calendário. 
        // Adicionando o Onjeto ao Input da data escolhida pelo usuário.
        function adicionaZero(numero){
            if (numero <= 9) 
                return "0" + numero;
            else
                return numero; 
        }

        let calendar = this.getCalendar();
        let eventListWeekday = [this.elements.currentWeekDay.innerHTML = AVAILABLE_WEEK_DAYS[calendar.active.week]];
        let eventListday = [this.elements.currentDay.innerHTML = calendar.active.day];
        let eventListYear = [this.elements.year.innerHTML = calendar.active.year];
        let eventListMonth = [this.elements.currentMonth.innerHTML = AVAILABLE_MONTH[calendar.active.month]];

        // Data formatada que será impressa para o usuário no front-end do agendamento
        document.getElementById('dataAgendamentoFormatado').value = 
            eventListWeekday+", " + adicionaZero(eventListday) +" de "+ eventListMonth + " de " + eventListYear;
    }

    drawDays() {
        let calendar = this.getCalendar();

        let latestDaysInPrevMonth = this.range(calendar.active.startWeek).map((day, idx) => {
            return {
                dayNumber: this.countOfDaysInMonth(calendar.pMonth) - idx,
                month: new Date(calendar.pMonth).getMonth(),
                year: new Date(calendar.pMonth).getFullYear(),
                currentMonth: false
            }
        }).reverse();


        let daysInActiveMonth = this.range(calendar.active.days).map((day, idx) => {
            let dayNumber = idx + 1;
            let today = new Date();
            return {
                dayNumber,
                today: today.getDate() === dayNumber && today.getFullYear() === calendar.active.year && today.getMonth() === calendar.active.month,
                month: calendar.active.month,
                year: calendar.active.year,
                selected: calendar.active.day === dayNumber,
                currentMonth: true
            }
        });


        let countOfDays = this.options.maxDays - (latestDaysInPrevMonth.length + daysInActiveMonth.length);
        let daysInNextMonth = this.range(countOfDays).map((day, idx) => {
            return {
                dayNumber: idx + 1,
                month: new Date(calendar.nMonth).getMonth(),
                year: new Date(calendar.nMonth).getFullYear(),
                currentMonth: false
            }
        });

        let days = [...latestDaysInPrevMonth, ...daysInActiveMonth, ...daysInNextMonth];

        days = days.map(day => {
            let newDayParams = day;
            let formatted = this.getFormattedDate(new Date(`${Number(day.month) + 1}/${day.dayNumber}/${day.year}`));
            newDayParams.hasEvent = this.eventList[formatted];
            return newDayParams;
        });

        let daysTemplate = "";
        days.forEach(day => {
            daysTemplate += `<li class="${day.currentMonth ? '' : 'another-month'}${day.today ? ' active-day ' : ''}${day.selected ? 'selected-day' : ''}${day.hasEvent ? ' event-day' : ''}" data-day="${day.dayNumber}" data-month="${day.month}" data-year="${day.year}"></li>`;
            document.getElementById('');
        });

        this.elements.days.innerHTML = daysTemplate;
    }

    drawMonths() {
        let availableMonths = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Aug", "Set", "Out", "Nov", "Dez"];
        let monthTemplate = "";
        let calendar = this.getCalendar();
        availableMonths.forEach((month, idx) => {
            monthTemplate += `<li class="${idx === calendar.active.month ? 'active' : ''}" data-month="${idx}">${month}</li>`
        });

        this.elements.month.innerHTML = monthTemplate;
    }

    drawWeekDays() {
        let weekTemplate = "";
        AVAILABLE_WEEK_DAYS.forEach(week => {
            weekTemplate += `<li>${week.slice(0, 3)}</li>`
        });

        this.elements.week.innerHTML = weekTemplate;
    }

    // Service methods
    eventsTrigger() {
        this.elements.prevYear.addEventListener('click', e => {
            let calendar = this.getCalendar();
            this.updateTime(calendar.pYear);
            this.drawAll()
        });

        this.elements.nextYear.addEventListener('click', e => {
            let calendar = this.getCalendar();
            this.updateTime(calendar.nYear);
            this.drawAll()
        });

        this.elements.month.addEventListener('click', e => {
            let calendar = this.getCalendar();
            let month = e.srcElement.getAttribute('data-month');
            if (!month || calendar.active.month == month) return false;

            let newMonth = new Date(calendar.active.tm).setMonth(month);
            this.updateTime(newMonth);
            this.drawAll()
        });

        this.elements.days.addEventListener('click', e => {
            let element = e.srcElement;
            let day = element.getAttribute('data-day');
            let month = element.getAttribute('data-month');
            let year = element.getAttribute('data-year');
            if (!day) return false;
            let strDate = `${Number(month) + 1}/${day}/${year}`;
            this.updateTime(strDate);
            this.drawAll()
        });

        //Evento do Calendáio de Comentário
        /*
        this.elements.eventAddBtn.addEventListener('click', e => {
            let fieldValue = this.elements.eventField.value;
            if (!fieldValue) return false;
            let dateFormatted = this.getFormattedDate(new Date(this.date));
            if (!this.eventList[dateFormatted]) this.eventList[dateFormatted] = [];
            this.eventList[dateFormatted].push(fieldValue );
            localStorage.setItem(localStorageName, JSON.stringify(this.eventList));
            this.elements.eventField.value = '';
            this.drawAll()
        });
        */

    }


    updateTime(time) {
        this.date = +new Date(time);
    }

    getCalendar() {
        let time = new Date(this.date);

        return {
            active: {
                days: this.countOfDaysInMonth(time),
                startWeek: this.getStartedDayOfWeekByTime(time),
                day: time.getDate(),
                week: time.getDay(),
                month: time.getMonth(),
                year: time.getFullYear(),
                formatted: this.getFormattedDate(time),
                tm: +time
            },
            pMonth: new Date(time.getFullYear(), time.getMonth() - 1, 1),
            nMonth: new Date(time.getFullYear(), time.getMonth() + 1, 1),
            pYear: new Date(new Date(time).getFullYear() - 1, 0, 1),
            nYear: new Date(new Date(time).getFullYear() + 1, 0, 1)
        }
    }

    countOfDaysInMonth(time) {
        let date = this.getMonthAndYear(time);
        return new Date(date.year, date.month + 1, 0).getDate();
    }

    getStartedDayOfWeekByTime(time) {
        let date = this.getMonthAndYear(time);
        return new Date(date.year, date.month, 1).getDay();
    }

    getMonthAndYear(time) {
        let date = new Date(time);
        return {
            year: date.getFullYear(),
            month: date.getMonth()
        }
    }

    getFormattedDate(date) {
        return `${date.getDate()}/${date.getMonth()}/${date.getFullYear()}`;
    }

    range(number) {
        return new Array(number).fill().map((e, i) => i);
    }

    getFirstElementInsideIdByClassName(className) {
        return document.getElementById(this.options.id).getElementsByClassName(className)[0];
    }
}

(function () {
    new CALENDAR({
        id: "calendar"
    })
})();

