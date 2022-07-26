<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>408 Time Out</title>
</head>

<style>
	* {
	  -webkit-box-sizing: border-box;
	  box-sizing: border-box;
	}
	body {
	  padding: 0;
	  margin: 0;
	}
	#notfound {
	  position: relative;
	  height: 100vh;
	}
	#notfound .notfound {
	  position: absolute;
	  left: 50%;
	  top: 50%;
	  -webkit-transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  transform: translate(-50%, -50%);
	}
	.notfound {
	  max-width: 520px;
	  width: 100%;
	  text-align: center;
	  line-height: 1.4;
	}
	.notfound .notfound-404 {
	  height: 190px;
	}
	.notfound .notfound-404 h1 {
	  font-family: "Montserrat", sans-serif;
	  font-size: 146px;
	  font-weight: 700;
	  margin: 0px;
	  color: #232323;
	}
	.notfound .notfound-404 h1 > span {
	  display: inline-block;
	  width: 120px;
	  height: 120px;
	  background-image: url("https://emojipedia-us.s3.dualstack.us-west-1.amazonaws.com/thumbs/160/mozilla/36/pensive-face_1f614.png");
	  background-size: cover;
	  -webkit-transform: scale(1.4);
	  -ms-transform: scale(1.4);
	  transform: scale(1.4);
	  z-index: -1;
	  animation-name: floating;
	  animation-duration: 4s;
	  animation-iteration-count: infinite;
	  animation-timing-function: ease-in-out;
	}
	.notfound h2 {
	  font-family: "Montserrat", sans-serif;
	  font-size: 22px;
	  font-weight: 700;
	  margin: 0;
	  text-transform: uppercase;
	  color: #232323;
	}
	.notfound p {
	  font-family: "Montserrat", sans-serif;
	  color: #787878;
	  font-weight: 300;
	}
	.notfound a {
	  font-family: "Montserrat", sans-serif;
	  display: inline-block;
	  padding: 12px 30px;
	  font-weight: 700;
	  background-color: #f99827;
	  color: #fff;
	  border-radius: 40px;
	  text-decoration: none;
	  -webkit-transition: 0.2s all;
	  transition: 0.2s all;
	}
	.notfound a:hover {
	  opacity: 0.8;
	}
	@media only screen and (max-width: 767px) {
	  .notfound .notfound-404 {
	    height: 115px;
	  }
	  .notfound .notfound-404 h1 {
	    font-size: 86px;
	  }
	  .notfound .notfound-404 h1 > span {
	    width: 86px;
	    height: 86px;
	  }
	}
	@keyframes floating {
	  from {
	    transform: scale(1.4) translate(0, 0);
	  }
	  50% {
	    transform: scale(1.4) translate(0, 15px);
	  }
	  to {
	    transform: scale(1.4) translate(0, 0);
	  }
	}
</style>
<body>

	<div id="notfound">
	  <div class="notfound">
	    <div class="notfound-404">
	      <h1>4<span></span>4</h1>
	    </div>
	    <h2>Oops! Poll Not Be Found</h2>
	    <p>Sorry but the poll you are looking for has been closed or unavailable</p>
	   
	  </div>
	</div>
</body>
</html>