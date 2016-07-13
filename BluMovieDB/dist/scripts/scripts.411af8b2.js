"use strict";

function $AnchorScrollProvider() {
  var a = !0;
  this.disableAutoScrolling = function() {
    a = !1
  }, this.$get = ["$window", "$location", "$rootScope", function(b, c, d) {
    function e(a) {
      var b = null;
      return forEach(a, function(a) {
        b || "a" !== nodeName_(a) || (b = a)
      }), b
    }

    function f() {
      var a, d = c.hash();
      d ? (a = g.getElementById(d)) ? a.scrollIntoView() : (a = e(g.getElementsByName(d))) ? a.scrollIntoView() : "top" === d && b.scrollTo(0, 0) : b.scrollTo(0, 0)
    }
    var g = b.document;
    return a && d.$watch(function() {
      return c.hash()
    }, function() {
      d.$evalAsync(f)
    }), f
  }]
}
angular.module("omdbApp", ["ngAnimate", "ngResource", "ngRoute"]).config(["$routeProvider", function(a) {
  a.when("/", {
    templateUrl: "views/home.html",
    controller: "HomeCtrl"
  }).when("/search/:query", {
    templateUrl: "views/search.html",
    controller: "SearchCtrl"
  }).when("/title/:id/:type?", {
    templateUrl: "views/details-title.html",
    controller: "DetailsTitleCtrl"
  }).when("/title/:id/tv/season/:seasonNumber", {
    templateUrl: "views/details-season.html",
    controller: "DetailsSeasonCtrl"
  }).when("/title/:id/tv/season/:seasonNumber/episode/:episodeNumber", {
    templateUrl: "views/details-episode.html",
    controller: "DetailsEpisodeCtrl"
  }).when("/name/:id/:type?", {
    templateUrl: "views/details-name.html",
    controller: "DetailsNameCtrl"
  }).otherwise({
    redirectTo: "/"
  })
}]).value("APIKey", "5d967417393b991110d125b2c51affe5").value("APIURL", "http://api.themoviedb.org/3/").directive("ngArrowUp", function() {
  return function(a, b, c) {
    b.bind("keydown keypress", function(b) {
      38 === b.which && (a.$apply(function() {
        a.$eval(c.ngArrowUp)
      }), b.preventDefault())
    })
  }
}).directive("ngArrowDown", function() {
  return function(a, b, c) {
    b.bind("keydown keypress", function(b) {
      40 === b.which && a.$apply(function() {
        a.$eval(c.ngArrowDown)
      })
    })
  }
}).directive("ngEnter", function() {
  return function(a, b, c) {
    b.bind("keydown keypress", function(b) {
      13 === b.which && (a.$apply(function() {
        a.$eval(c.ngEnter)
      }), b.preventDefault())
    })
  }
}).directive("ngArrowLeftRight", function() {
  return function(a, b, c) {
    b.bind("keydown keypress", function(b) {
      (37 === b.which || 39 === b.which) && a.$apply(function() {
        a.$eval(c.ngArrowLeftRight)
      })
    })
  }
}), angular.module("omdbApp").factory("config", ["$http", "APIURL", "APIKey", function(a, b, c) {
  var d = {
      images: {
        base_url: "http://image.tmdb.org/t/p/",
        secure_base_url: "https://image.tmdb.org/t/p/",
        backdrop_sizes: ["w300", "w780", "w1280", "original"],
        logo_sizes: ["w45", "w92", "w154", "w185", "w300", "w500", "original"],
        poster_sizes: ["w92", "w154", "w185", "w342", "w500", "w780", "original"],
        profile_sizes: ["w45", "w185", "h632", "original"],
        still_sizes: ["w92", "w185", "w300", "original"]
      },
      change_keys: ["adult", "also_known_as", "alternative_titles", "biography", "birthday", "budget", "cast", "character_names", "crew", "deathday", "general", "genres", "homepage", "images", "imdb_id", "name", "original_title", "overview", "plot_keywords", "production_companies", "production_countries", "releases", "revenue", "runtime", "spoken_languages", "status", "tagline", "title", "trailers", "translations"]
    },
    e = {
      loadConfig: function() {
        var e = localStorage.getItem("configuration");
        try {
          e = JSON.parse(e)
        } catch (f) {
          console.log(f), e = null, localStorage.setItem("configuration", null)
        }
        e && void 0 !== e && null !== e ? d = e : a({
          method: "GET",
          url: b + "configuration",
          params: {
            api_key: c
          }
        }).success(function(a) {
          localStorage.setItem("configuration", JSON.stringify(a)), d = a
        }).error(function(a) {
          console.log(a)
        })
      },
      getConfig: function() {
        return d
      },
      getImagePath: function(a, b) {
        var c = "";
        return c = "original" !== b ? d.images[a + "_sizes"][b] : "original", d.images.base_url + c
      }
    };
  return e.loadConfig(), e
}]), angular.module("omdbApp").factory("api", ["$http", "APIURL", "APIKey", function(a, b, c) {
  var d = {
    simpleRequest: function(e, f, g) {
      null !== g && "object" == typeof g ? g.api_key = c : g = {
        api_key: c
      }, a({
        method: "GET",
        url: b + e,
        params: g
      }).success(function(a) {
        f(a)
      }).error(function(a) {
        d.error(a)
      })
    },
    movies: {
      id: function(a, b) {
        d.simpleRequest("movie/" + a, b, {
          append_to_response: "credits,images,similar,videos"
        })
      },
      credits: function(a, b) {
        d.simpleRequest("movie/" + a, b, {
          append_to_response: "credits"
        })
      },
      playing: function(a) {
        d.simpleRequest("movie/now_playing", a)
      },
      popular: function(a) {
        d.simpleRequest("movie/popular", a)
      },
      discover: function(a) {
        d.simpleRequest("discover/movie", a)
      },
      search: function(a, b) {
        d.simpleRequest("search/movie", b, {
          query: a
        })
      },
      autocomplete: function(a, b) {
        d.simpleRequest("search/movie", b, {
          query: a,
          search_type: "ngram"
        })
      }
    },
    tv: {
      id: function(a, b) {
        d.simpleRequest("tv/" + a, b, {
          append_to_response: "credits,images,similar,videos"
        })
      },
      season: function(a, b, c) {
        d.simpleRequest("tv/" + a + "/season/" + b, c, {
          append_to_response: "images,videos"
        })
      },
      episode: function(a, b, c, e) {
        d.simpleRequest("tv/" + a + "/season/" + b + "/episode/" + c, e, {
          append_to_response: "images,credits"
        })
      },
      credits: function(a, b) {
        d.simpleRequest("tv/" + a, b, {
          append_to_response: "credits"
        })
      },
      popular: function(a) {
        d.simpleRequest("tv/popular", a)
      },
      airingToday: function(a) {
        d.simpleRequest("tv/airing_today", a)
      },
      topRated: function(a) {
        d.simpleRequest("tv/top_rated", a)
      },
      search: function(a, b) {
        d.simpleRequest("search/tv", b, {
          query: a
        })
      },
      autocomplete: function(a, b) {
        d.simpleRequest("search/tv", b, {
          query: a,
          search_type: "ngram"
        })
      }
    },
    people: {
      id: function(a, b) {
        d.simpleRequest("person/" + a, b, {
          append_to_response: "combined_credits,images,tagged_images"
        })
      },
      combined_credits: function(a, b) {
        d.simpleRequest("person/" + a, b, {
          append_to_response: "combined_credits"
        })
      },
      movie_credits: function(a, b) {
        d.simpleRequest("person/" + a, b, {
          append_to_response: "movie_credits"
        })
      },
      tv_credits: function(a, b) {
        d.simpleRequest("person/" + a, b, {
          append_to_response: "tv_credits"
        })
      },
      popular: function(a) {
        d.simpleRequest("person/popular", a)
      },
      search: function(a, b) {
        d.simpleRequest("search/person", b, {
          query: a
        })
      },
      autocomplete: function(a, b) {
        d.simpleRequest("search/person", b, {
          query: a,
          search_type: "ngram"
        })
      }
    },
    credits: {
      id: function(a, b) {
        d.simpleRequest("credit/" + a, b)
      }
    },
    multi: {
      search: function(a, b) {
        d.simpleRequest("search/multi", b, {
          query: a
        })
      },
      autocomplete: function(a, b) {
        d.simpleRequest("search/multi", b, {
          query: a,
          search_type: "ngram"
        })
      }
    },
    error: function(a) {
      console.log("error"), console.log(a)
    }
  };
  return d
}]), angular.module("omdbApp").factory("commandSearch", ["api", function(a) {
  function b(a, c) {
    a++, a < c.functionOrder.length ? (console.log(c.functionOrder[a]), d[c.functionOrder[a]](c, function(c, d) {
      console.log(c.functionOrder[a] + " executed"), b(a, c, d)
    })) : (console.log("All executed"), f.commandExecuted(c))
  }
  var c = [{
    targetSentence: "people starring in",
    itemType: "people",
    subjectType: "movies",
    subjectIdentifier: "title",
    functionOrder: ["getSubject", "getAItemCreditsCast"]
  }, {
    targetSentence: "cast of",
    itemType: "people",
    subjectType: "movies",
    subjectIdentifier: "title",
    functionOrder: ["getSubject", "getAItemCreditsCast"]
  }, {
    targetSentence: "episodes of",
    itemType: "episodes",
    subjectType: "tv",
    subjectIdentifier: "name",
    functionOrder: ["getSubjectObjectWith", "getObjectCreditsForSubject", "getCreditDetailsFromCreditID", "getEpisodesFromCreditDetails"]
  }];
  [{
    itemType: "movies",
    itemString: "movies"
  }, {
    itemType: "tv",
    itemString: "tv series"
  }, {
    itemType: "tv",
    itemString: "tv shows"
  }].forEach(function(a) {
    c.push({
      targetSentence: a.itemString + " with",
      itemType: a.itemType,
      subjectType: "people",
      subjectIdentifier: "name",
      functionOrder: ["getSubject", "get" + a.itemType[0].toUpperCase() + a.itemType.substring(1) + "Credits", "mergeCredits"]
    }, {
      targetSentence: a.itemString + " starring",
      itemType: a.itemType,
      subjectType: "people",
      subjectIdentifier: "name",
      functionOrder: ["getSubject", "get" + a.itemType[0].toUpperCase() + a.itemType.substring(1) + "CreditsCast"]
    }, {
      targetSentence: a.itemString + " directed by",
      itemType: a.itemType,
      subjectType: "people",
      subjectIdentifier: "name",
      functionOrder: ["getSubject", "get" + a.itemType[0].toUpperCase() + a.itemType.substr(1) + "CreditsCrew", "filterCreditsDirecting"]
    }, {
      targetSentence: a.itemString + " produced by",
      itemType: a.itemType,
      subjectType: "people",
      subjectIdentifier: "name",
      functionOrder: ["getSubject", "get" + a.itemType[0].toUpperCase() + a.itemType.substring(1) + "CreditsCrew", "filterCreditsProduction"]
    }, {
      targetSentence: a.itemString + " written by",
      itemType: a.itemType,
      subjectType: "people",
      subjectIdentifier: "name",
      functionOrder: ["getSubject", "get" + a.itemType[0].toUpperCase() + a.itemType.substring(1) + "CreditsCrew", "filterCreditsWriting"]
    })
  });
  var d = {
      getSubject: function(b, c) {
        a.multi.autocomplete(b.subject, function(a) {
          switch (b.subjectObject = a.results[0], b.subject = a.results[0].name || a.results[0].title, b.subjectObject.media_type) {
            case "tv":
              b.subjectType = "tv", b.subjectIdentifier = "name", b.subjectTypeDetails = "title";
              break;
            case "movie":
              b.subjectType = "movies", b.subjectIdentifier = "title", b.subjectTypeDetails = "title";
              break;
            case "person":
              b.subjectType = "people", b.subjectIdentifier = "name", b.subjectTypeDetails = "name"
          }
          c(b)
        })
      },
      getSubjectObjectWith: function(b, c) {
        var d = b.subject.split(" with ");
        b.subject = d[0], b.object = d[1], console.log("Subject:" + b.subject + ", object:" + b.object), a.multi.autocomplete(b.subject, function(d) {
          switch (b.subjectObject = d.results[0], b.subject = d.results[0].name || d.results[0].title, b.subjectObject.media_type) {
            case "tv":
              b.subjectType = "tv", b.subjectIdentifier = "name";
              break;
            case "movie":
              b.subjectType = "movies", b.subjectIdentifier = "title";
              break;
            case "person":
              b.subjectType = "people", b.subjectIdentifier = "name"
          }
          a.multi.autocomplete(b.object, function(a) {
            switch (b.objectObject = a.results[0], b.object = a.results[0].name || a.results[0].title, b.objectObject.media_type) {
              case "tv":
                b.objectType = "tv", b.objectIdentifier = "name";
                break;
              case "movie":
                b.objectType = "movies", b.objectIdentifier = "title";
                break;
              case "person":
                b.objectType = "people", b.objectIdentifier = "name"
            }
            console.log(b), c(b)
          })
        })
      },
      getCombinedCredits: function(b, c) {
        a[b.subjectType].combined_credits(b.subjectObject.id, function(a) {
          b.results = a.combined_credits, c(b)
        })
      },
      getObjectCreditsForSubject: function(b, c) {
        a[b.objectType].combined_credits(b.objectObject.id, function(a) {
          b.results = [], a.combined_credits.cast.forEach(function(a) {
            (a.title === b.subject || a.name === b.subject) && b.results.push(a)
          }), console.log(b.results), c(b)
        })
      },
      getMoviesCredits: function(b, c) {
        a[b.subjectType].movie_credits(b.subjectObject.id, function(a) {
          b.results = a.movie_credits, c(b)
        })
      },
      getMoviesCreditsCast: function(b, c) {
        a[b.subjectType].movie_credits(b.subjectObject.id, function(a) {
          b.results = a.movie_credits.cast, c(b)
        })
      },
      getMoviesCreditsCrew: function(b, c) {
        a[b.subjectType].movie_credits(b.subjectObject.id, function(a) {
          b.results = a.movie_credits.crew, c(b)
        })
      },
      getTvCredits: function(b, c) {
        a[b.subjectType].tv_credits(b.subjectObject.id, function(a) {
          b.results = a.tv_credits, c(b)
        })
      },
      getTvCreditsCast: function(b, c) {
        a[b.subjectType].tv_credits(b.subjectObject.id, function(a) {
          b.results = a.tv_credits.cast, c(b)
        })
      },
      getTvCreditsCrew: function(b, c) {
        a[b.subjectType].tv_credits(b.subjectObject.id, function(a) {
          b.results = a.tv_credits.crew, c(b)
        })
      },
      getAItemCreditsCast: function(b, c) {
        console.log(b.subjectType), a[b.subjectType].credits(b.subjectObject.id, function(a) {
          b.results = a.credits.cast, c(b)
        })
      },
      mergeCredits: function(a, b) {
        var c = a.results.cast;
        a.results.crew.forEach(function(a) {
          c.push(a)
        }), a.results = c, b(a)
      },
      filterCreditsDirecting: function(a, b) {
        d.filterCreditsCrew(a, b, "Directing")
      },
      filterCreditsProduction: function(a, b) {
        d.filterCreditsCrew(a, b, "Production")
      },
      filterCreditsWriting: function(a, b) {
        d.filterCreditsCrew(a, b, "Writing")
      },
      filterCreditsEditing: function(a, b) {
        d.filterCreditsCrew(a, b, "Editing")
      },
      filterObjectCreditsCastWithSubject: function(a, b) {
        var c = [];
        a.object.credits.cast.forEach(function(a) {
          a.department === department && c.push(movie)
        }), a.results = c, b(a)
      },
      getCreditDetailsFromCreditID: function(b, c) {
        a.credits.id(b.results[0].credit_id, function(a) {
          b.results = a, console.log(a), c(b)
        })
      },
      getEpisodesFromCreditDetails: function(a, b) {
        a.subjectType = "episodes", a.results = a.results.media.episodes, b(a)
      },
      filterCreditsCrew: function(a, b, c) {
        var d = [];
        a.results.forEach(function(a) {
          a.department === c && d.push(a)
        }), a.results = d, b(a)
      }
    },
    e = function(a) {
      for (var b = a.toLowerCase(), d = 0; d < c.length; d++)
        if (0 === b.indexOf(c[d].targetSentence)) return c[d].subject = b.replace(c[d].targetSentence + " ", ""), c[d];
      return !1
    },
    f = {
      command: null,
      callback: null,
      getAllCommands: function() {
        var a = [];
        return c.forEach(function(b) {
          a.push(b.targetSentence)
        }), a
      },
      findCommand: function(a, b) {
        console.log("Checking if " + a + " is a command.");
        var c = e(a);
        return c ? (console.log("Yes it is"), void b(c)) : void b(!1)
      },
      findAndExecuteCommand: function(a, c) {
        return f.callback = c, f.command = e(a), f.command ? void b(-1, f.command) : void f.callback(!1)
      },
      commandExecuted: function(a) {
        console.log(a), f.callback({
          type: a.itemType,
          title: a.targetSentence + " " + a.subject,
          results: a.results,
          command: a
        })
      }
    };
  return f
}]), angular.module("omdbApp").controller("AppCtrl", ["$scope", "$rootScope", "$location", "$http", "$timeout", "$window", "config", "api", "commandSearch", function(a, b, c, d, e, f, g, h, i) {
  a.posterPath = g.getImagePath("poster", 0), a.profilePath = g.getImagePath("profile", 0), a.showAutocomplete = !1, a.searchDisabled = !1, a.autocompleteMovies = [], a.autocompleteTvShows = [], a.autocompletePeople = [], a.activateAutocomplete = function() {
    a.showAutocomplete = !0, k()
  }, a.hideAutocomplete = function() {
    e(function() {
      a.showAutocomplete = !1
    }, 150)
  };
  var j = a.query,
    k = function() {
      e(function() {
        j !== a.query && (j = a.query, a.query.length > 2 ? (i.findCommand(a.query, function(b) {
          if (b) {
            a.autocompleteResults = [];
            var c = b.subjectType;
            "episodes" === b.subjectType && (c = "tv"), h[c].autocomplete(b.subject, function(c) {
              a.command = b, a.command.title = b.targetSentence[0].toUpperCase() + b.targetSentence.substr(1), a.command.results = c.results.splice(0, 6)
            })
          } else a.command = !1, h.multi.autocomplete(a.query, function(b) {
            a.autocompleteResults = b.results.splice(0, 5);
            for (var c = 0; c < a.autocompleteResults.length; c++) switch (a.autocompleteResults[c].media_type) {
              case "movie":
                a.autocompleteResults[c].typeDetails = "title", a.autocompleteResults[c].typeMedia = "movie";
                break;
              case "person":
                a.autocompleteResults[c].typeDetails = "name", a.autocompleteResults[c].typeMedia = "";
                break;
              case "tv":
                a.autocompleteResults[c].typeDetails = "title", a.autocompleteResults[c].typeMedia = "tv"
            }
          })
        }), a.selected = -1) : (a.autocompleteMovies = [], a.autocompleteTvShows = [], a.autocompletePeople = [])), a.showAutocomplete && k()
      }, 500)
    };
  a.commandClick = function(b) {
    a.query = b, a.search()
  }, a.selected = -1, a.arrowUp = function() {
    a.selected > 0 ? a.selected-- : a.selected < 0 ? a.selected = a.autocompleteMovies.length + a.autocompleteTvShows.length + a.autocompletePeople.length - 1 : 0 === a.selected && (a.selected = -1)
  }, a.arrowDown = function() {
    a.selected !== a.autocompleteMovies.length + a.autocompleteTvShows.length + a.autocompletePeople.length - 1 ? a.selected++ : a.selected = 0
  }, a.resetSelector = function() {
    a.selected = -1
  }, a.enter = function() {
    if (a.searchDisabled = !0, e(function() {
        a.searchDisabled = !1
      }, 50), -1 === a.selected) a.search();
    else {
      for (var b = 0; b < a.autocompleteMovies.length; b++) b === a.selected && c.path("title/" + a.autocompleteMovies[b].id + "/movie");
      a.selected = a.selected - a.autocompleteMovies.length;
      for (var b = 0; b < a.autocompletePeople.length; b++) b === a.selected && c.path("name/" + a.autocompletePeople[b].id);
      a.selected = a.selected - a.autocompletePeople.length;
      for (var b = 0; b < a.autocompleteTvShows.length; b++) b === a.selected && c.path("title/" + a.autocompleteTvShows[b].id + "/tv");
      a.selected = a.selected - a.autocompleteTvShows.length
    }
  }, a.search = function() {
    c.path("search/" + a.query)
  }, b.$watch("query", function() {
    a.query = b.query
  })
}]), angular.module("omdbApp").controller("HomeCtrl", ["$scope", "$rootScope", "$http", "$location", "config", "api", function(a, b, c, d, e, f) {
  a.posterPath = e.getImagePath("poster", 2), a.profilePath = e.getImagePath("profile", 2), f.movies.playing(function(b) {
    a.playing = b.results, a.playingCount = b.total_results
  }), f.movies.popular(function(b) {
    a.popularMovies = b.results, a.popularMoviesCount = b.total_results
  }), f.people.popular(function(b) {
    a.popularPeople = b.results, a.popularPeopleCount = b.total_results
  })
}]), angular.module("omdbApp").controller("SearchCtrl", ["$scope", "$rootScope", "$routeParams", "$location", "$http", "config", "api", "commandSearch", function(a, b, c, d, e, f, g, h) {
  c.query ? b.query = c.query : d.path(""), a.posterPath = f.getImagePath("poster", 1), a.profilePath = f.getImagePath("profile", 1), a.results = [], g.multi.search(c.query, function(b) {
    a.resultCount = b.total_results;
    for (var c = 0; c < b.results.length; c++) switch (b.results[c].media_type) {
      case "movie":
        b.results[c].typeDetails = "title", b.results[c].typeMedia = "movie";
        break;
      case "tv":
        b.results[c].typeDetails = "title", b.results[c].typeMedia = "tv";
        break;
      case "person":
        b.results[c].typeDetails = "name", b.results[c].typeMedia = ""
    }
    a.results = b.results
  }), h.findAndExecuteCommand(c.query, function(b) {
    if (b && b.results.length) switch (a.results = b.results, a.command = b.command, b.type) {
      case "tv":
        a.typeDetails = "title", a.typeMedia = "tv";
        break;
      case "people":
        a.typeDetails = "name", a.typeMedia = "";
        break;
      case "episodes":
        a.typeDetails = "title", a.typeMedia = "tv/season";
        for (var c = 0; c < a.results.length; c++) a.results[c].typeMedia = "tv/season/" + a.results[c].season_number + "/episode/" + a.results[c].episode_number, a.results[c].id = b.command.subjectObject.id;
        break;
      case "movies":
      default:
        a.typeDetails = "title", a.typeMedia = "movie"
    }
  })
}]), angular.module("omdbApp").controller("DetailsNameCtrl", ["$scope", "$rootScope", "$routeParams", "$location", "$http", "$timeout", "config", "api", function(a, b, c, d, e, f, g, h) {
  c.id || d.path(""), a.type = c.type ? c.type : "person", a.backdropPath = g.getImagePath("backdrop", "original"), a.posterPath = g.getImagePath("poster", 3), a.profilePath = g.getImagePath("profile", 3), h.people.id(c.id, function(c) {
    console.log(c), a.details = c, a.images = c.images, b.query = c.name, a.backdrops = [], c.tagged_images && (c.tagged_images.results.forEach(function(b) {
      "backdrop" === b.image_type && a.backdrops.push(b)
    }), 0 !== a.backdrops.length && (b.translucentMenu = !0), a.backdropIndex = 0, a.changeBackdrop()), a.profileIndex = 0, a.details.birthday && a.sidebarDetails.push({
      label: "Born",
      value: a.details.birthday
    }), a.details.deathday && a.sidebarDetails.push({
      label: "Died",
      value: a.details.deathday
    }), a.details.place_of_birth && a.sidebarDetails.push({
      label: "Place of birth",
      value: a.details.place_of_birth
    })
  }), a.showFullBio = !1, a.toggleFullBio = function() {
    a.showFullBio = !a.showFullBio
  }, a.sidebarDetails = [], a.showFullDetailsSidebar = !1, a.toggleFullDetailsSidebar = function() {
    a.showFullDetailsSidebar = !a.showFullDetailsSidebar
  }, a.changeBackdrop = function() {
    f(function() {
      a.backdropIndex < a.backdrops.length - 1 ? a.backdropIndex++ : a.backdropIndex = 0, a.changeBackdrop()
    }, 12e3)
  }, a.prevBackdrop = function() {
    a.backdropIndex > 0 ? a.backdropIndex-- : a.backdropIndex = a.backdrops.length - 1
  }, a.nextBackdrop = function() {
    a.backdropIndex < a.backdrops.length - 1 ? a.backdropIndex++ : a.backdropIndex = 0
  }, a.prevProfile = function() {
    a.profileIndex > 0 ? a.profileIndex-- : a.profileIndex = a.details.images.profiles.length - 1
  }, a.nextProfile = function() {
    a.profileIndex < a.details.images.profiles.length - 1 ? a.profileIndex++ : a.profileIndex = 0
  }, a.$on("$destroy", function() {
    b.translucentMenu = !1, f.cancel()
  })
}]), angular.module("omdbApp").controller("DetailsTitleCtrl", ["$scope", "$rootScope", "$routeParams", "$location", "$http", "$timeout", "$sce", "config", "api", function(a, b, c, d, e, f, g, h, i) {
  switch (c.id || d.path(""), a.type = c.type || "movie", a.backdropPath = h.getImagePath("backdrop", "original"), a.posterPath = h.getImagePath("poster", 2), a.profilePath = h.getImagePath("profile", 3), a.type) {
    case "tv":
      var j = "tv";
      break;
    default:
      var j = "movies"
  }
  i[j].id(c.id, function(c) {
    console.log(c), a.details = c, a.images = c.images, b.query = c.title || c.name, a.backdrops = [], a.images.backdrops.forEach(function(b) {
      b.width > 1e3 && a.backdrops.push(b)
    }), 0 !== a.backdrops.length && (b.translucentMenu = !0), a.backdropIndex = 0, a.changeBackdrop(), a.posterIndex = 0, a.stars = [0, 0, 0, 0, 0];
    for (var d = a.details.vote_average / 2, e = 0; 5 > e; e++) console.log("vote_copy is nu " + d), console.log("Math.round(vote_copy) is nu " + Math.round(d)), d >= 1 ? (console.log("Give star #" + (e + 1)), a.stars[e] = 2) : 1 === Math.round(d) && (a.stars[e] = 1, console.log("Give half star #" + (e + 1))), d--;
    a.trailerYoutube = !1, a.showTrailer = !1, a.details.videos.results.forEach(function(b) {
      "YouTube" === b.site && "Trailer" === b.type && (a.trailerYoutube = b)
    }), a.details.release_date && a.sidebarDetails.push({
      label: "Release date:",
      value: a.details.release_date
    }), a.details.runtime && a.sidebarDetails.push({
      label: "Runtime",
      value: a.details.runtime + " minutes"
    }), a.details.number_of_seasons && a.sidebarDetails.push({
      label: "Number of seasons",
      value: a.details.number_of_seasons
    }), a.details.networks && a.details.networks.length > 0 && a.sidebarDetails.push({
      label: "Networks",
      value: a.details.networks.map(function(a) {
        return a.name
      }).join("\n")
    }), a.details.genres && a.details.genres.length > 0 && a.sidebarDetails.push({
      label: "Genres",
      value: a.details.genres.map(function(a) {
        return a.name
      }).join(", ")
    }), a.details.production_companies && a.details.production_companies.length > 0 && a.sidebarDetails.push({
      label: "Production companies",
      value: a.details.production_companies.map(function(a) {
        return a.name
      }).join(", ")
    }), a.details.production_countries && a.details.production_countries.length > 0 && a.sidebarDetails.push({
      label: "Production countries",
      value: a.details.production_countries.map(function(a) {
        return a.name
      }).join(", ")
    }), a.details.spoken_languages && a.details.spoken_languages.length > 0 && a.sidebarDetails.push({
      label: "Spoken languages",
      value: a.details.spoken_languages.map(function(a) {
        return a.name
      }).join(", ")
    }), a.details.budget && a.sidebarDetails.push({
      label: "Budget",
      value: "$" + a.details.budget.toString().replace(/(\d{1,3})(?=(?:\d{3})+$)/g, "$1,")
    }), a.details.revenue && a.sidebarDetails.push({
      label: "Revenue",
      value: "$" + a.details.revenue.toString().replace(/(\d{1,3})(?=(?:\d{3})+$)/g, "$1,")
    })
  }), a.trustSrc = function(a) {
    return g.trustAsResourceUrl(a)
  }, a.showFullOverview = !1, a.toggleFullOverview = function() {
    a.showFullOverview = !a.showFullOverview
  }, a.showFullOverview = !1, a.toggleFullOverview = function() {
    a.showFullOverview = !a.showFullOverview
  }, a.sidebarDetails = [], a.showFullDetailsSidebar = !1, a.toggleFullDetailsSidebar = function() {
    a.showFullDetailsSidebar = !a.showFullDetailsSidebar
  }, a.changeBackdrop = function() {
    f(function() {
      a.backdropIndex < a.backdrops.length - 1 ? a.backdropIndex++ : a.backdropIndex = 0, a.changeBackdrop()
    }, 12e3)
  }, a.prevBackdrop = function() {
    a.backdropIndex > 0 ? a.backdropIndex-- : a.backdropIndex = a.backdrops.length - 1
  }, a.nextBackdrop = function() {
    a.backdropIndex < a.backdrops.length - 1 ? a.backdropIndex++ : a.backdropIndex = 0
  }, a.prevPoster = function() {
    a.posterIndex > 0 ? a.posterIndex-- : a.posterIndex = a.details.images.posters.length - 1
  }, a.nextPoster = function() {
    a.posterIndex < a.details.images.posters.length - 1 ? a.posterIndex++ : a.posterIndex = 0
  }, a.$on("$destroy", function() {
    b.translucentMenu = !1, f.cancel()
  })
}]), angular.module("omdbApp").controller("DetailsSeasonCtrl", ["$scope", "$rootScope", "$routeParams", "$location", "$http", "$timeout", "$sce", "config", "api", function(a, b, c, d, e, f, g, h, i) {
  c.id && c.seasonNumber || d.path(""), a.tvShowID = c.id, a.seasonNumber = c.seasonNumber, a.type = c.type || "movie", a.backdropPath = h.getImagePath("backdrop", "original"), a.posterPath = h.getImagePath("poster", 3), a.profilePath = h.getImagePath("profile", 3), i.tv.season(c.id, c.seasonNumber, function(b) {
    console.log(b), a.details = b, a.images = b.images
  })
}]), angular.module("omdbApp").controller("DetailsEpisodeCtrl", ["$scope", "$rootScope", "$routeParams", "$location", "$http", "$timeout", "$sce", "config", "api", function(a, b, c, d, e, f, g, h, i) {
  c.id && c.seasonNumber && c.episodeNumber || d.path(""), a.tvShowID = c.id, a.seasonNumber = c.seasonNumber, a.episodeNumber = c.episodeNumber, a.type = c.type || "movie", a.stillPath = h.getImagePath("profile", "original"), a.profilePath = h.getImagePath("profile", 2), i.tv.episode(c.id, c.seasonNumber, c.episodeNumber, function(c) {
    console.log(c), a.details = c, a.images = c.images, c.still_path && (b.translucentMenu = !0), a.details.air_date && a.sidebarDetails.push({
      label: "Air date",
      value: a.details.air_date
    }), a.sidebarDetails.push({
      label: "Season number",
      value: a.details.season_number
    }), a.sidebarDetails.push({
      label: "Episode number",
      value: a.details.episode_number
    })
  }), a.sidebarDetails = [], a.$on("$destroy", function() {
    b.translucentMenu = !1
  })
}]);

