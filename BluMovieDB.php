
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta https-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>BluMovieDB</title>

<!-- Latest angular.js -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js"></script>


<!-- Some Needed angular module JS -->
<script>
var app = angular.module('app', []);
app.controller("ListCtrl", function ($scope, $http) {
     // Search submit
    $scope.submit = function () {
        $scope.loading = true;
        $scope.error = false;
        $http.get('https://www.omdbapi.com/?i=tt' + $scope.search + '&y=&plot=full&r=json')
               .success(function (data, status, headers, config) {
                   $scope.movie = data;
                   $scope.results = true;
                   $scope.error = false;
                   $scope.loading = false;

                   if ($scope.movie.Poster === "N/A") {
                       $scope.movie.Poster = "http://placehold.it/350x450/FFF/EEE";
                   }

                   if ($scope.movie.Response === "False") {
                       $scope.results = false;
                       $scope.error = true;
                   }
               })
               .error(function (data, status, headers, config) {
                   // called asynchronously if an error occurs
                   // or server returns response with an error status.
                   $scope.results = false;
                   $scope.loading = false;
                   $scope.error = true;
               });
    };

    $scope.saveMovie = function (imdbID) {
        $http.get(' https://www.omdbapi.com/?i=' + imdbID + '&plot=short&r=json')
         .success(function (data, status, headers, config) {
             $scope.savedMovies.push(data);
         });
    };

    $scope.remove = function (item) {
        var index = $scope.savedMovies.indexOf(item)
        $scope.savedMovies.splice(index, 1);
    }

    $scope.savedMovies = [];
});
</script>

<!-- jQuery Query Parser plugin -->
<script>
// Minified version here:
 (function($){var pl=/\+/g,searchStrict=/([^&=]+)=+([^&]*)/g,searchTolerant=/([^&=]+)=?([^&]*)/g,decode=function(s){return decodeURIComponent(s.replace(pl," "));};$.parseQuery=function(query,options){var match,o={},opts=options||{},search=opts.tolerant?searchTolerant:searchStrict;if('?'===query.substring(0,1)){query=query.substring(1);}while(match=search.exec(query)){o[decode(match[1])]=decode(match[2]);}return o;};$.getQuery=function(options){return $.parseQuery(window.location.search,options);};$.fn.parseQuery=function(options){return $.parseQuery($(this).serialize(),options);};}(jQuery));

// YOUTUBE VIDEO CODE
$(document).ready(function(){
	
// BOOTSTRAP 3.0 - Open YouTube Video Dynamicaly in Modal Window
// Modal Window for dynamically opening videos
$('a[href^="https://www.youtube.com"]').on('click', function(e){
  // Store the query string variables and values
	// Uses "jQuery Query Parser" plugin, to allow for various URL formats (could have extra parameters)
	var queryString = $(this).attr('href').slice( $(this).attr('href').indexOf('?') + 1);
	var queryVars = $.parseQuery( queryString );
 
	// if GET variable "v" exists. This is the Youtube Video ID
	if ( 'v' in queryVars )
	{
		// Prevent opening of external page
		e.preventDefault();
 
		// Variables for iFrame code. Width and height from data attributes, else use default.
		var vidWidth = 560; // default
		var vidHeight = 315; // default
		if ( $(this).attr('data-width') ) { vidWidth = parseInt($(this).attr('data-width')); }
		if ( $(this).attr('data-height') ) { vidHeight =  parseInt($(this).attr('data-height')); }
		var iFrameCode = '<iframe width="' + vidWidth + '" height="'+ vidHeight +'" scrolling="no" allowtransparency="true" allowfullscreen="true" src="https://www.youtube.com/embed/'+  queryVars['v'] +'?rel=0&wmode=transparent&showinfo=0" frameborder="0"></iframe>';
 
		// Replace Modal HTML with iFrame Embed
		$('#mediaModal .modal-body').html(iFrameCode);
		// Set new width of modal window, based on dynamic video content
		$('#mediaModal').on('show.bs.modal', function () {
			// Add video width to left and right padding, to get new width of modal window
			var modalBody = $(this).find('.modal-body');
			var modalDialog = $(this).find('.modal-dialog');
			var newModalWidth = vidWidth + parseInt(modalBody.css("padding-left")) + parseInt(modalBody.css("padding-right"));
			newModalWidth += parseInt(modalDialog.css("padding-left")) + parseInt(modalDialog.css("padding-right"));
			newModalWidth += 'px';
			// Set width of modal (Bootstrap 3.0)
		    $(this).find('.modal-dialog').css('width', newModalWidth);
		});
 
		// Open Modal
		$('#mediaModal').modal();
	}
});
 
// Clear modal contents on close. 
// There was mention of videos that kept playing in the background.
$('#mediaModal').on('hidden.bs.modal', function () {
	$('#mediaModal .modal-body').html('');
});
 
}); 
</script>

<!-- Personal CSS Styling -->
<style>

body {
  background: -webkit-linear-gradient(90deg, #1e1e1e 10%, #1e1e1e 90%); /* Chrome 10+, Saf5.1+ */
  background:    -moz-linear-gradient(90deg, #1e1e1e 10%, #1e1e1e 90%); /* FF3.6+ */
  background:     -ms-linear-gradient(90deg, #1e1e1e 10%, #1e1e1e 90%); /* IE10 */
  background:      -o-linear-gradient(90deg, #1e1e1e 10%, #1e1e1e 90%); /* Opera 11.10+ */
  background:         linear-gradient(90deg, #1e1e1e 10%, #1e1e1e 90%); /* W3C */
}

.list-img {
    max-width: 0px;
}

h1, h2, h3, h4, h5 {
    font-weight: 300;
}

.logo {
    font-weight: 400;
    color: #FFF;
}

.well {
    -webkit-box-shadow: 0 0 30px 0 rgba(00, 00, 00, 0.4);
    -moz-box-shadow: 0 0 30px 0 rgba(00, 00, 00, 0.4);
    box-shadow: 0 0 30px 0 rgba(00, 00, 00, 0.4);
    -webkit-transition:all linear 0.5s;
    transition:all linear 0.5s;
}

.btn-lg {
    line-height: 1.35;
}

a {
    color: #000;
}

ul {
    display: block;
    list-style-type: none;
    padding: 0;
}

li {
    padding: 10px;
    display: inline-block;
}

.search {
    -webkit-box-shadow: 0 0 30px 0 rgba(00, 00, 00, 0.4);
    -moz-box-shadow: 0 0 30px 0 rgba(00, 00, 00, 0.4);
    box-shadow: 0 0 30px 0 rgba(00, 00, 00, 0.4);
    margin-bottom: 20px;
}

/* Bootstrap input glow fix */
textarea:focus,
input[type="text"]:focus,
input[type="password"]:focus,
input[type="datetime"]:focus,
input[type="datetime-local"]:focus,
input[type="date"]:focus,
input[type="month"]:focus,
input[type="time"]:focus,
input[type="week"]:focus,
input[type="number"]:focus,
input[type="email"]:focus,
input[type="url"]:focus,
input[type="search"]:focus,
input[type="tel"]:focus,
input[type="color"]:focus,
.uneditable-input:focus {
    outline: 0;
    outline: thin dotted \9;
    border-color:rgba(0,0,0,.075);
    /* IE6-9 */
    -webkit-box-shadow: inset 0 0 0 rgba(0,0,0,.075), 0 0 20px rgba(0,0,0,.4);
    -moz-box-shadow: inset 0 0 0 rgba(0,0,0,.075), 0 0 20px rgba(0,0,0,.4);
    box-shadow: inset 0 0 0 rgba(0,0,0,.075), 0 0 20px rgba(0,0,0,.4);
}
footer{
color: teal;
background-color: #111111;
bottom: 0;
box-shadow: 0 -1px 2px #111111;
height: 35px;
left: 0;
position: fixed;
width: 100%;
z-index: 100000;
text-align: center;}

.btn-custom {
  background-color: hsl(0, 100%, 68%) !important;
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ff8484", endColorstr="#ff5b5b");
  background-image: -khtml-gradient(linear, left top, left bottom, from(#ff8484), to(#ff5b5b));
  background-image: -moz-linear-gradient(top, #ff8484, #ff5b5b);
  background-image: -ms-linear-gradient(top, #ff8484, #ff5b5b);
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ff8484), color-stop(100%, #ff5b5b));
  background-image: -webkit-linear-gradient(top, #ff8484, #ff5b5b);
  background-image: -o-linear-gradient(top, #ff8484, #ff5b5b);
  background-image: linear-gradient(#ff8484, #ff5b5b);
  border-color: #ff5b5b #ff5b5b hsl(0, 100%, 66%);
  color: #333 !important;
  text-shadow: 0 1px 1px rgba(255, 255, 255, 0.13);
  -webkit-font-smoothing: antialiased;
}
</style>
</head>


<body ng-app="app">
    <div ng-controller="ListCtrl">
        <div class="container">
          
                <h1 class="logo">
                    BluMovieDB <span class="glyphicon glyphicon-film"></span>
                </h1>
         
            <div class="search">
                <div class="row">
                    <div class="col-md-12">
                        <form ng-submit="submit()" class="form-horizontal">
                            <div class="input-group">
                                <input autofocus required ng-model="search" type="text" class="form-control input-lg" placeholder="Search for a movie!">

                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-lg" type="submit">Go!</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="alert alert-info" ng-show="loading">
                <div class="row">
                    <div class="col-md-12">
                        <div>Loading...</div>
                    </div>
                </div>
            </div>

            <div class="well" ng-show="results">
                <div class="row">
                    <div class="col-md-4">
                        <a ng-href="https://www.imdb.com/title/{{movie.imdbID}}/" target="_blank">
                            <img class="img-responsive" ng-src="{{movie.Poster}}" alt="{{movie.Title}}" />
                        </a>
                    </div>

                    <div class="col-md-8">
                        <button type="button" class="close" ng-click="results = !results">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                        </button>

                        <h1>
                            <a ng-href="https://www.imdb.com/title/{{movie.imdbID}}/" target="_blank">{{movie.Title}}</a> <small> {{movie.imdbRating}}</small>
                        </h1>
                        Runtime: {{movie.Runtime}}<br />
                        Genre: {{movie.Genre}}<br />
                        Released: {{movie.Released}}

                        <p class="lead">
                            <b>Director:</b> {{movie.Director}}<br />
                            <b>Actors:</b> {{movie.Actors}}<br>
                        </p>

                        <p>Plot: {{movie.Plot}}</p>
                        <p>Awards: {{movie.Awards}}</p>

                        <button class="btn btn-success"><span class="glyphicon glyphicon-film"></span>View Uploads</button>   <button class="btn btn-warning" ><span class="glyphicon glyphicon-film"></span>View Stream</button>   <a class="btn btn-danger" href="https://www.youtube.com/watch?v=uehhs1vrRXE" role="button"><span class="glyphicon glyphicon-play"></span>Watch Trailer</a>  <button class="btn btn-primary" ng-click="saveMovie(movie.imdbID)"><span class="glyphicon glyphicon-plus"></span>Add To Watchlist</button>

                </div>
                </div>
            </div>

            <div class="alert alert-danger" role="alert" ng-show="error">
                <strong>Ooops!</strong> Couldnt find a movie with that name.
            </div>

            <div class="well" ng-hide="!savedMovies.length">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Watchlist: </h3>
                        <ul>
                            <li ng-repeat="saved in savedMovies">
                                <strong>
                                    <a ng-href="https://www.imdb.com/title/{{saved.imdbID}}/" target="_blank">{{saved.Title}}</a>
                                    <a ng-click="remove(saved)" class="pull-right" style="cursor:pointer;">
                                        <span class="glyphicon glyphicon-remove" style="color: #d9534f;"></span>
                                    </a>
                                </strong>
                                <br />
                                <img class="img-responsive list-img" ng-src="{{saved.Poster}}" alt="" />
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video / Generic Modal -->
<div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-body">
      <!-- content dynamically inserted -->
    </div>
  </div>
</div>
</div>
</body>
<footer>
<h4>Ultimate Movie and TV Show Info by BluCrew</h4>
</footer>
</html>


