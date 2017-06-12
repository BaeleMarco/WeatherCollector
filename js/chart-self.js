/*-----*/
/*CHART*/
/*-----*/
var pointRadius = 4;
var title = '';

var config = {
    type: 'line',
    data: {
        labels: [],
        datasets: []
    },
    options: {
        responsive: true,
        title:{
            display: true,
            text: title
        },
        elements: {
                    point: {
                        pointStyle: 'rectRounded'
                    }
                },
        tooltips: {
            mode: 'index',
            intersect: false
        },
        animation: {
            duration: 500
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Date'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Value'
                },
                ticks: {
                    // suggestedMin: 10,
                    // suggestedMax: 0,
                    // stepSize: 5
                }
            }]
        }
    }
};

window.onload = function(){
    ctx = document.getElementById("canvas").getContext("2d");
    window.myLine = new Chart(ctx, config);

    //Make one before changing it
    updatePage($('div.row.checkboxes')[0].innerText,'selectAll')
};

/*---------*/
/*FUNCTIONS*/
/*---------*/
function updatePage(e,query){
    var table = []
    if(typeof e == "string")
    {
        inputs = []
        e = e.replace(/Air /g,'Air-').replace(/Wind /g,'Wind-').replace(/Rain /g,'Rain-')
        inputs = e.split(' ')
    }
    if(typeof e == "object")
    {
        inputs = []
        values = e.currentTarget.innerHTML.split('id="')
        for (var i = 1; i < values.length; i++){
            inputs.push(values[i].substr(0,values[i].search('"')).replace(' ', '-'))
        }
    }
    for (var i = 0; i < inputs.length; i++){
        if($('#' + inputs[i]).is(':checked')) table.push(inputs[i])
    }
    ajaxCall(table,query)
}

function ajaxCall(table,query){
    $.ajax({
            type: "POST",
            url: "php/getFromDatabase.php",
            data: {
                'table': table,
                'query': query
            },
            dataType: "json"
        }).done(function(data){
            var returnedData = data
            if(query == 'selectAll'){
                window.myLine.destroy()
                var color = ''
                //Clear the excisting line graphs
                config.data.datasets = []

                config.options.animation.duration = 0;
                if(returnedData != {}){
                    for (var i = 0; i < table.length; i++){
                        try{
                            dataArray = []
                            config.data.labels = []
                            //Label the values
                            //Needs fine-tuning
                            for (var o = 0; o < returnedData.Dates.length; o++){
                                if(o != 0){
                                    var dateArray = returnedData.Dates[o].date.split('-')
                                    if(returnedData.Dates[o].date == returnedData.Dates[o-1].date){
                                        var timeArray = returnedData.Dates[o].time.split(':')
                                        var timeWithoutSeconds = timeArray[0] + ':' + timeArray[1]
                                        config.data.labels.push(timeWithoutSeconds)
                                    }else if(dateArray[0] == returnedData.Dates[o-1].date.slice(0,4)){
                                        config.data.labels.push(dateArray[1] + '-' + dateArray[2])
                                    }else{
                                        config.data.labels.push(returnedData.Dates[o].date)
                                    }
                                }else{
                                    config.data.labels.push(returnedData.Dates[o].date)
                                }
                            }
                            // Add the correct value's
                            for (var o = 0; o < returnedData[table[i]].length; o++){
                                dataArray.push(returnedData[table[i]][o].value)
                            }
                            //Non changing colors for each 
                            for (var o = 0; o < window.chartColors.length; o++){
                                if (window.chartColors[o][0] == table[i]){
                                    color = window.chartColors[o][1]
                                }
                            };
                            config.data.datasets.push(
                                {
                                    label: table[i].replace('-', ' '),
                                    data: dataArray,
                                    
                                    backgroundColor: color,
                                    borderColor: color,
                                    fill: false,
                                    pointRadius: pointRadius,
                                    pointHoverRadius: pointRadius + 2,
                                    lineTension: 0,
                                    showLine: true
                                }
                            )
                        }catch(error){
                            if(typeof returnedData[table[i]].error != 'undefined'){
                                console.log(returnedData[table[i]][0].error.errorInfo[2].split('\'')[1])
                            }
                        }
                    }
                }
                window.myLine = new Chart(ctx, config);
                //Upon creating the graph again scroll back to the bottom of the page
                // $("body").animate({ scrollTop: $(document).height()}, 'fast');
            }else if(query == 'selectLast'){
                units = ['&deg;C', '%', 'Hg', '%', 'm&sup2;', 'km/h'];
                inputs = []
                e = $('div.row.checkboxes')[0].innerText
                e = e.replace(/Air /g,'Air-').replace(/Wind /g,'Wind-').replace(/Rain /g,'Rain-')
                inputs = e.split(' ')

                var realtimes = $('div.col.s6.m4.l2')
                for (var i = 0; i < realtimes.length; i++) {
                    realtimes[i].lastElementChild.firstElementChild.innerHTML = returnedData[0][inputs[i]] + units[i]
                    console.log(realtimes[i].lastElementChild.firstElementChild.innerHTML)
                    var diffrence = returnedData[0][inputs[i]] - returnedData[1][inputs[i]];
                    var specialSign = '&#9679;'
                    if(diffrence > 0){
                        specialSign = '<span class="green-text">&#x25B2;</span>' //+
                    }else if(diffrence < 0){
                        specialSign = '<span class="red-text">&#x25BC;</span>' //-
                        diffrence = Number(String(diffrence).replace('-', ''))
                    }
                    realtimes[i].lastElementChild.lastElementChild.innerHTML = specialSign + ' ' + diffrence + units[i]
                }
            }else{
                window.myLine.destroy();
            }
        }).error(function(data){
            window.myLine.destroy();
    })
}