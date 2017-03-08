$( document ).ready(function() {

    if(window.location.pathname == '/home')
    {    
        $.ajax({
            type    : 'GET',
            dataType: 'json',
            url     : '/stock/get_stock_count',
            success : function(data) {

                $('.loading').hide();

                var ctx = $("#myChart");

                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: "# of Stocks",
                            data:  data.stock,
                            backgroundColor: data.backgroundColor,
                            borderColor: data.borderColor,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });

            },
            error   : function(jqXHR, textStatus, errorThrown) {

                $('.loading').hide();
                alert('Error on Loading chart ... ');
            }
        });

    }
});    