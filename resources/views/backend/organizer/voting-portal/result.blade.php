@extends('layouts.backend.master')

@section('page_content')
    
<section>

    @if (!empty($winnerCandidate))
        <div class="celebration-section">
        <button id="startConfetti" style="display: none;">Start</button>
    </div>
    <div class="">
        <div class="row mt-3">

            <div class="col-8">
                <div class="row">
                    <div class="col">
                        <h2>Congratulations to {{ $winnerCandidate->name }}!</h2>
                    </div>
                </div>
                <div class="row">
                            <div class="col-md-4">
                                <div class="card profile-card-2">
                                    <div class="card-img-block">
                                        <img class="img-fluid" src="{{ asset('images/candidate/'.$winnerCandidate->created_at->format('Y/M/').'/'.$winnerCandidate->image) }}" alt="Candidate Image">
                                    </div>
                                    <div class="card-body pt-2">
                                        <h5 class="card-title">{{ $winnerCandidate->get_organizer($winnerCandidate->organizer_id)->name  }}</h5>
                                    </div>
                        
                                    <div class="card-body border-top border-light">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left ml-3">
                                            <p> Name: {{ $winnerCandidate->name }}     </p>               
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="media align-items-center">
                                            <div class="media-body text-left ml-3">
                                            <p> Designation: {{ $winnerCandidate->designation }}     </p>               
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="media align-items-center">
                                            <div class="media-body text-left ml-3">
                                            <p> Email: {{ $winnerCandidate->email }}     </p>               
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="media align-items-center">
                                            <div class="media-body text-left ml-3">
                                            <p> Phone: {{ $winnerCandidate->phone }}     </p>               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
            <div class="col-4">
                <h3>Candidate with vote Counts</h3>

                @if ($candidates->isNotEmpty())
                    @foreach ($candidates as $data)
                            <div class="row">
                                <div class="col d-flex">
                                   <img src="{{ asset('images/candidate/'.$data->created_at->format('Y/M/').'/'.$data->image) }}" alt="candidate img" style="border-radius: 50%; width:50px;height:50px;">
                                   &nbsp;&nbsp;&nbsp;&nbsp;<h5 class="mt-2">{{ $data->name }}</h5>
                                  
                                  
                                </div>
                                <div class="col">
                                    <p style="margin-left:30%;font-size:25px;">{{ $data->get_voteCount($data->id) }}</p>
                                </div>
                            </div>
                            <br>
                    @endforeach
                @endif

              
            </div>

           
            
       </div>

      {{-- <div class="row">
        <div class="col">
            <a href="{{ route('portallist-organizer') }}" class="btn btn-block btn-dark">Back</a>
        </div>
      </div> --}}

    </div>
    @else
        <div>
            <p>No vote was casted in this portal</p>
        </div>
    @endif
     
</section>
	
@endsection

@section('footer_js')
    <script>
        (function($) {
            $.confetti = new function() {
                // globals
                var canvas;
                var ctx;
                var W;
                var H;
                var mp = 150; //max particles
                var particles = [];
                var angle = 0;
                var tiltAngle = 0;
                var confettiActive = true;
                var animationComplete = true;
                var deactivationTimerHandler;
                var reactivationTimerHandler;
                var animationHandler;

                // objects

                var particleColors = {
                    colorOptions: ["DodgerBlue", "OliveDrab", "Gold", "pink", "SlateBlue", "lightblue", "Violet", "PaleGreen", "SteelBlue", "SandyBrown", "Chocolate", "Crimson"],
                    colorIndex: 0,
                    colorIncrementer: 0,
                    colorThreshold: 10,
                    getColor: function () {
                        if (this.colorIncrementer >= 10) {
                            this.colorIncrementer = 0;
                            this.colorIndex++;
                            if (this.colorIndex >= this.colorOptions.length) {
                                this.colorIndex = 0;
                            }
                        }
                        this.colorIncrementer++;
                        return this.colorOptions[this.colorIndex];
                    }
                }

                function confettiParticle(color) {
                    this.x = Math.random() * W; // x-coordinate
                    this.y = (Math.random() * H) - H; //y-coordinate
                    this.r = RandomFromTo(10, 30); //radius;
                    this.d = (Math.random() * mp) + 10; //density;
                    this.color = color;
                    this.tilt = Math.floor(Math.random() * 10) - 10;
                    this.tiltAngleIncremental = (Math.random() * 0.07) + .05;
                    this.tiltAngle = 0;

                    this.draw = function () {
                        ctx.beginPath();
                        ctx.lineWidth = this.r / 2;
                        ctx.strokeStyle = this.color;
                        ctx.moveTo(this.x + this.tilt + (this.r / 4), this.y);
                        ctx.lineTo(this.x + this.tilt, this.y + this.tilt + (this.r / 4));
                        return ctx.stroke();
                    }
                }

                function init() {
                    SetGlobals();
                    InitializeButton();
                    // InitializeConfetti();

                    $(window).resize(function () {
                        W = window.innerWidth;
                        H = window.innerHeight;
                        canvas.width = W;
                        canvas.height = H;
                    });

                }

                // $(document).ready(init());

                function InitializeButton() {
                    $('#startConfetti').click(InitializeConfetti);
                    $('#stopConfetti').click(DeactivateConfetti);
                    $('#restartConfetti').click(RestartConfetti);
                }

                function SetGlobals() {
                    $('body').append('<canvas id="confettiCanvas" style="position:absolute;top:0;left:0;display:none;z-index:99;"></canvas>');
                    canvas = document.getElementById("confettiCanvas");
                    ctx = canvas.getContext("2d");
                    W = window.innerWidth;
                    H = window.innerHeight;
                    canvas.width = W;
                    canvas.height = H;
                }

                function InitializeConfetti() {
                    canvas.style.display = 'block';
                    particles = [];
                    animationComplete = false;
                    for (var i = 0; i < mp; i++) {
                        var particleColor = particleColors.getColor();
                        particles.push(new confettiParticle(particleColor));
                    }
                    StartConfetti();
                }

                function Draw() {
                    ctx.clearRect(0, 0, W, H);
                    var results = [];
                    for (var i = 0; i < mp; i++) {
                        (function (j) {
                            results.push(particles[j].draw());
                        })(i);
                    }
                    Update();

                    return results;
                }

                function RandomFromTo(from, to) {
                    return Math.floor(Math.random() * (to - from + 1) + from);
                }


                function Update() {
                    var remainingFlakes = 0;
                    var particle;
                    angle += 0.01;
                    tiltAngle += 0.1;

                    for (var i = 0; i < mp; i++) {
                        particle = particles[i];
                        if (animationComplete) return;

                        if (!confettiActive && particle.y < -15) {
                            particle.y = H + 100;
                            continue;
                        }

                        stepParticle(particle, i);

                        if (particle.y <= H) {
                            remainingFlakes++;
                        }
                        CheckForReposition(particle, i);
                    }

                    if (remainingFlakes === 0) {
                        StopConfetti();
                    }
                }

                function CheckForReposition(particle, index) {
                    if ((particle.x > W + 20 || particle.x < -20 || particle.y > H) && confettiActive) {
                        if (index % 5 > 0 || index % 2 == 0) //66.67% of the flakes
                        {
                            repositionParticle(particle, Math.random() * W, -10, Math.floor(Math.random() * 10) - 10);
                        } else {
                            if (Math.sin(angle) > 0) {
                                //Enter from the left
                                repositionParticle(particle, -5, Math.random() * H, Math.floor(Math.random() * 10) - 10);
                            } else {
                                //Enter from the right
                                repositionParticle(particle, W + 5, Math.random() * H, Math.floor(Math.random() * 10) - 10);
                            }
                        }
                    }
                }
                function stepParticle(particle, particleIndex) {
                    particle.tiltAngle += particle.tiltAngleIncremental;
                    particle.y += (Math.cos(angle + particle.d) + 3 + particle.r / 2) / 2;
                    particle.x += Math.sin(angle);
                    particle.tilt = (Math.sin(particle.tiltAngle - (particleIndex / 3))) * 15;
                }

                function repositionParticle(particle, xCoordinate, yCoordinate, tilt) {
                    particle.x = xCoordinate;
                    particle.y = yCoordinate;
                    particle.tilt = tilt;
                }

                function StartConfetti() {
                    W = window.innerWidth;
                    H = window.innerHeight;
                    canvas.width = W;
                    canvas.height = H;
                    (function animloop() {
                        if (animationComplete) return null;
                        animationHandler = requestAnimFrame(animloop);
                        return Draw();
                    })();
                }

                function ClearTimers() {
                    clearTimeout(reactivationTimerHandler);
                    clearTimeout(animationHandler);
                }

                function DeactivateConfetti() {
                    confettiActive = false;
                    ClearTimers();
                }

                function StopConfetti() {
                    animationComplete = true;
                    if (ctx == undefined) return;
                    ctx.clearRect(0, 0, W, H);
                    canvas.style.display = 'none';
                }

                function RestartConfetti() {
                    ClearTimers();
                    StopConfetti();
                    reactivationTimerHandler = setTimeout(function () {
                        confettiActive = true;
                        animationComplete = false;
                        InitializeConfetti();
                    }, 100);

                }

                window.requestAnimFrame = (function () {
                    return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function (callback) {
                        return window.setTimeout(callback, 1000 / 60);
                    };
                })();
                
                this.init = init;
                this.start = InitializeConfetti;
                this.stop = DeactivateConfetti;
                this.restart = RestartConfetti;
            }
            $.confetti.init();
            }(jQuery));
    </script>

    <script>
        document.getElementById("startConfetti").click();

        var mp = 150
        var particleColors = {
            colorOptions: ["DodgerBlue", "OliveDrab", "Gold", "pink", "SlateBlue", "lightblue", "Violet", "PaleGreen", "SteelBlue", "SandyBrown", "Chocolate", "Crimson"],
            colorIndex: 0,
            colorIncrementer: 0,
            colorThreshold: 10
        }
    </script>
@endsection