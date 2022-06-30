<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    
    <section>
        <div class="container mt-5">
            <div class="row">
              <div class="col-md-6">
                {{--  @if ($testTrial->status == 0)
                  <div id="TESTTIME">
                    <button class="btn btn-sm btn-danger">Vote Me!</button>
                  </div>
                @else
                  <div id="">
                    <button class="btn btn-sm btn-danger" disabled>Vote Me!</button>
                  </div>
                @endif  --}}
  
                <div id="TESTTIME">
                  <button class="btn btn-sm btn-danger">Vote Me!</button>
                </div>
                <p id="text11"></p>
               
              </div>
            </div>
        </div>
      </section>

      <input type="text" value="{{ $testTrial->start_time }}" id="start_time">
      <input type="text" value="{{ $testTrial->end_time }}" id="end_time">


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        //making a voting button active for a certain period of time
    
        checkTime();
    
        function checkTime() {
            var date = new Date(); // current time
            var hours = date.getHours();
            var mins = date.getMinutes();
            var day = date.getDay();
            var totalMins = (hours * 60) + mins;
            var targetMins = 20 * 60
            var remainMins = targetMins - totalMins;
        
            var start_time = document.getElementById('start_time').value;
            var end_time = document.getElementById('end_time').value;
           
            console.log(start_time);
            console.log(end_time);
        
            
        }
    </script>


    <script>
        if(hours >= 11 && hours < 20) {
            document.getElementById("text11").innerHTML = "Yes Current time is between 11am to 8pm And " + remainMins + " mins left to be time 8pm";
            console.log(start_time);
            }
            else {
            document.getElementById("text11").innerHTML = "There is " + remainMins + " mins left to be time 8pm";
            console.log(date.getHours());
            }
    </script>
</body>
</html>