
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta https-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>BluMovieDB</title>

<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.css">

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
});
</script>
</head>


<body ng-app="app">
    <div ng-controller="ListCtrl">
        <div class="container">         
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
                        <a ng-href="http://www.imdb.com/title/{{movie.imdbID}}/" target="_blank">
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

                        <p>Plot: {{movie.Plot}}</p><br>
                        <p>Awards: {{movie.Awards}}</p>
                </div>
                </div>
            </div>

            <div class="alert alert-danger" role="alert" ng-show="error">
                <strong>Ooops!</strong> Couldnt find a movie with that name.
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
</html>


