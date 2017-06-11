var API_KEY = config.API_KEY;
$("#submit").click(function(e){
    
    
    e.preventDefault();
    
    
    $.ajax({
    
        url: "http://api.openweathermap.org/data/2.5/weather?q="+encodeURIComponent($("#city").val())+"&appid="+API_KEY,
        type: "get",
        error: function(){

            var error = "couldn't find this city name, please try again";

            $('#message').html("<div class='alert alert-danger' role='alert'>"+error+"</div>");

        },
        success: function(data){

                var tempInCelcius = data['main']['temp'] - 273;

                var weather = "The Weather in "+$("#city").val()+" is '"+data['weather'][0]['description']+"'. The temperature is "+Math.round(tempInCelcius)+"&deg;C and the wind speed is "+data['wind']['speed']+"m/s .";





                $('#message').html("<div class='alert alert-success' role='alert'>"+weather+"</div>");

        }


    }); 
})

