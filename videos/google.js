/**
 * Copyright (c) 2008 Google Inc.
 *
 * You are free to copy and use this sample.
 * License can be found here: http://code.google.com/apis/ajaxsearch/faq/#license
*/

function GSvideoBar(barRoot, opt_playerRoot, options) {

  this.processArguments(barRoot, opt_playerRoot, options);

  this.setGlobals();
  this.buildSuperStructure();
  this.buildSearchControl();

  // if we have an auto execute list, then start it up
  if (this.autoExecuteMode) {
    this.cycleTimeClosure = this.methodClosure(this, GSvideoBar.prototype.cycleTimeout, [null]);

    // if there is only a single item in the execute list, then
    // disable autoExecuteMode...
    if ( this.executeList.length == 1) {
      this.switchToListItem(0);
    } else {
      this.cycleTimeout();
    }
  }
}

// cycle time for selecting a video set
GSvideoBar.CYCLE_TIME_EXTRA_SHORT = 3000;
GSvideoBar.CYCLE_TIME_SHORT = 10000;
GSvideoBar.CYCLE_TIME_MEDIUM = 15000;
GSvideoBar.CYCLE_TIME_LONG = 30000;

// cycle mode
GSvideoBar.CYCLE_MODE_RANDOM = 1;
GSvideoBar.CYCLE_MODE_LINEAR = 2;

GSvideoBar.MAX_CACHE_LIFETIME = 50;
GSvideoBar.MIN_CACHE_LIFETIME = 2;
GSvideoBar.DEFAULT_CACHE_LIFETIME = 2;
GSvideoBar.MAX_ERROR_COUNT = 4;
GSvideoBar.DEFAULT_QUERY = "VW GTI";

GSvideoBar.THUMBNAILS_SMALL = 1;
GSvideoBar.THUMBNAILS_MEDIUM = 2;

// floating player option
GSvideoBar.PLAYER_ROOT_FLOATING = "floating";

GSvideoBar.prototype.processArguments = function(barRoot, opt_playerRoot,
                                                 opt_options) {
  this.floatingPlayerBox = null;
  this.barRoot = barRoot;
  this.playerRoot = opt_playerRoot;
  this.statusRoot = null;
  this.externalMaster = null;
  this.verticalMode = true;
  this.thumbSize = GSvideoBar.THUMBNAILS_MEDIUM;
  this.autoExecuteMode = false;
  this.executeList = new Array();
  this.cycleTime = GSvideoBar.CYCLE_TIME_MEDIUM;
  this.cycleMode = GSvideoBar.CYCLE_MODE_RANDOM;
  this.cycleNext = 0;
  this.cycleTimer = null;
  this.cacheLifetime = GSvideoBar.DEFAULT_CACHE_LIFETIME;

  // set defaults that are changable via options
  this.resultSetSize = GSearch.SMALL_RESULTSET;
  this.ST_ALL_DONE = GSearch.strings["im-done"];

  if (opt_options) {
    // option.largetResultSet
    if (opt_options.largeResultSet && opt_options.largeResultSet == true ) {
      this.resultSetSize = GSearch.LARGE_RESULTSET;
    } else {
      this.resultSetSize = GSearch.SMALL_RESULTSET;
    }

    if ( opt_options.master ) {
      this.externalMaster = opt_options.master;
    }

    if (opt_options.horizontal && opt_options.horizontal == true ) {
      this.verticalMode = false;
    } else {
      this.verticalMode = true;
    }

    if (opt_options.thumbnailSize) {
      if (opt_options.thumbnailSize == GSvideoBar.THUMBNAILS_MEDIUM ) {
        this.thumbSize = GSvideoBar.THUMBNAILS_MEDIUM;
      } else if ( opt_options.thumbnailSize == GSvideoBar.THUMBNAILS_SMALL ) {
        this.thumbSize = GSvideoBar.THUMBNAILS_SMALL;
      } else {
        this.thumbSize = GSvideoBar.THUMBNAILS_MEDIUM;
      }
    }

    if (opt_options.string_allDone) {
      this.ST_ALL_DONE = opt_options.string_allDone;
    }

    // the auto execute list contains
    // a cycleTime value, a cycleMode value, and an array
    // of searchExpressions
    if (opt_options.autoExecuteList) {

      // if specified and valid, then use it, otherwise
      // use default set above
      if (opt_options.autoExecuteList.cycleTime) {
        var cycleTime = opt_options.autoExecuteList.cycleTime;
        if (cycleTime == GSvideoBar.CYCLE_TIME_EXTRA_SHORT ||
            cycleTime == GSvideoBar.CYCLE_TIME_SHORT ||
            cycleTime == GSvideoBar.CYCLE_TIME_MEDIUM ||
            cycleTime == GSvideoBar.CYCLE_TIME_LONG ) {
          this.cycleTime = cycleTime;
        }
      }

      if (opt_options.autoExecuteList.cycleMode) {
        var cycleMode = opt_options.autoExecuteList.cycleMode;
        if (cycleMode == GSvideoBar.CYCLE_MODE_RANDOM ||
            cycleMode == GSvideoBar.CYCLE_MODE_LINEAR) {
          this.cycleMode = cycleMode;
        }
      }

      // now grab the list...
      if (opt_options.autoExecuteList.executeList &&
          opt_options.autoExecuteList.executeList.length > 0 ) {
        // grab from the list
        for (var i=0; i < opt_options.autoExecuteList.executeList.length; i++) {
          this.executeList.push(
            this.newListItem(opt_options.autoExecuteList.executeList[i]));
        }
        this.autoExecuteMode = true;
        this.currentIndex = 0;
        if (opt_options.autoExecuteList.statusRoot) {
          this.statusRoot = opt_options.autoExecuteList.statusRoot;
        }
      }
    }

  }

}

GSvideoBar.prototype.resetAutoExecuteListItems = function(newList) {
  if (this.autoExecuteMode && newList.length > 0) {

    // stop the timer...
    if (this.cycleTimer) {
      clearTimeout(this.cycleTimer);
      this.cycleTimer = null;
    }

    // clear the status area
    if (this.statusRoot) {
      this.removeChildren(this.statusRoot);
    }

    // nuke the old list
    this.executeList = new Array();

    // build the new list
    for (var i=0; i < newList.length; i++) {
      this.executeList.push(this.newListItem(newList[i]));
    }
    this.currentIndex = 0;

    if (this.statusRoot) {
      this.populateStatusRoot();
    }

    if ( this.executeList.length == 1) {
      this.switchToListItem(0);
    } else {
      this.cycleTimeout();
    }
  }
}

GSvideoBar.prototype.setGlobals = function() {
  this.br_AgentContains_cache_ = {};

  // subserstructure boxes
  this.CL_PLAYERBOX = "playerBox_gsvb";
  this.CL_PLAYING = "playerBox_gsvb playing_gsvb";
  this.CL_IDLE = "playerBox_gsvb idle_gsvb";
  this.CL_FLOATING_BOX = "floatingPlayerBox_gsvb";
  this.CL_FLOATING_BRANDING = "floatingBranding_gsvb";
  this.CL_FLOATING_BOX_PLAYING = "floatingPlayerBox_gsvb playing_gsvb";
  this.CL_FLOATING_BOX_IDLE = "floatingPlayerBox_gsvb idle_gsvb";
  this.CL_FLOATING_PLAYER = "floatingPlayer_gsvb";
  this.CL_FLOATING_PLAYER_PLAYING = "floatingPlayer_gsvb playing_gsvb";
  this.CL_FLOATING_PLAYER_IDLE = "floatingPlayer_gsvb idle_gsvb";


  this.CL_PLAYERINNERBOX = "playerInnerBox_gsvb";
  this.CL_VIDEOBARBOX = "videoBarBox_gsvb";
  this.CL_VIDEOBARBOXFULL = "videoBarBox_gsvb full_gsvb";
  this.CL_VIDEOBARBOXEMPTY = "videoBarBox_gsvb empty_gsvb";

  // major app states
  this.CL_ACTIVE = "active_gsvb";

  // player
  this.CL_PLAYER = "player_gsvb";
  this.CL_ALLDONE = "alldone_gsvb";
  this.CL_TITLE = "title_gsvb";

  // results
  this.CL_RESULTSBOX = "resultsBox_gsvb";
  this.CL_BRANDINGBOX = "brandingBox_gsvb";
  this.CL_RESULTTABLE_VERTICAL = "resultTable_gsvb vertical_gsvb";
  this.CL_RESULTTABLE_HORIZONTAL = "resultTable_gsvb horizontal_gsvb";
  this.CL_RESULTCELL = "resultCell_gsvb";
  this.CL_RESULTDIV = "resultDiv_gsvb";
  this.CL_RESULTDIV_SMALL = "resultDiv_gsvb smallResultDiv_gsvb";

  // status
  this.CL_STATUSBOX = "statusBox_gsvb";
  this.CL_STATUSITEM = "statusItem_gsvb";
  this.CL_STATUSITEM_SELECTED = "statusItem_gsvb statusItemSelected_gsvb";

  this.smallResultBoxHeight = 39;
  this.resultBoxHeight = 77;
}

GSvideoBar.prototype.buildSuperStructure = function() {

  // build the player box if we are a master, if not
  // link up to the master's player
  if (this.externalMaster == null) {
    if ( this.playerRoot == GSvideoBar.PLAYER_ROOT_FLOATING ) {
      this.floatingPlayerBox = this.createDiv(null, this.CL_FLOATING_BOX_IDLE);
      this.playerRoot = this.createDiv(null, this.CL_FLOATING_PLAYER_IDLE);
      document.body.appendChild(this.floatingPlayerBox);
      document.body.appendChild(this.playerRoot);
      if (this.br_IsMac()) {
        // disable opacity on mac
        this.floatingPlayerBox.style.opacity = "1.00";
      }
    } else {
      this.removeChildren(this.playerRoot);
    }
    this.playerBox = this.createDiv(null, this.CL_PLAYERBOX);
    this.playerAllDone = this.createDiv(this.ST_ALL_DONE, this.CL_ALLDONE);
    this.playerAllDone.onclick = this.methodClosure(this, this.stopVideo, []);
    this.playerInnerBox = this.createDiv(null, this.CL_PLAYERINNERBOX);

    this.playerBox.appendChild(this.playerAllDone);
    this.playerBox.appendChild(this.playerInnerBox);
    this.playerRoot.appendChild(this.playerBox);
    this.cssSetClass(this.playerBox, this.CL_IDLE);
  }
  this.player = null;

  // create the videoBar box
  this.removeChildren(this.barRoot);
  this.barBox = this.createDiv(null, this.CL_VIDEOBARBOX);
  this.barRoot.appendChild(this.barBox);

  // add results box and branding box
  this.resultsBox = this.createDiv(null, this.CL_RESULTSBOX);
  this.barBox.appendChild(this.resultsBox);
  this.cssSetClass(this.barBox, this.CL_VIDEOBARBOXEMPTY);

  // clear and optionally populate the status area
  if (this.statusRoot) {
    this.populateStatusRoot();
  }

}

GSvideoBar.prototype.buildSearchControl = function() {
  this.vs = new GvideoSearch();
  this.vs.setResultSetSize(this.resultSetSize);
  this.vs.setSearchCompleteCallback(this, GSvideoBar.prototype.searchComplete, [true]);

  this.vsBypass = new GvideoSearch();
  this.vsBypass.setResultSetSize(this.resultSetSize);
  this.vsBypass.setSearchCompleteCallback(this, GSvideoBar.prototype.searchComplete, [false]);
}

GSvideoBar.prototype.execute = function(query) {
  this.vsBypass.execute(query);
}
GSvideoBar.prototype.executeInternal = function(query) {
  this.vs.execute(query);
}

GSvideoBar.prototype.clearAllResults = function() {
  this.cssSetClass(this.barBox, this.CL_VIDEOBARBOXEMPTY);
}

GSvideoBar.prototype.searchComplete = function(fromListItem) {
  var results = null;
  if (fromListItem) {
    var currentListItem = this.executeList[this.currentIndex];
    if (this.vs.results && this.vs.results.length > 0) {
      // populate cache
      currentListItem.results = new Array();
      currentListItem.cacheCount = 1;
      currentListItem.errorCount = 0;
      for (var i = 0; i < this.vs.results.length; i++) {
        currentListItem.results.push(this.vs.results[i]);
      }
      results = currentListItem.results;
    } else {
      currentListItem.errorCount++;
      // if the error is due to a bad search term, then
      // nuke right away
      if (this.vs.completionStatus == 200) {
        currentListItem.errorCount = GSvideoBar.MAX_ERROR_COUNT + 1;
      }
    }
  } else {
    // normal .execute called, no caching...
    if (this.vsBypass.results && this.vsBypass.results.length > 0) {
      results = this.vsBypass.results;
    }
  }
  this.processResults(results);
}

GSvideoBar.prototype.processResults = function(results) {
  if ( results && results.length > 0) {
    this.cssSetClass(this.barBox, this.CL_VIDEOBARBOXFULL);
    this.removeChildren(this.resultsBox);

    var cell;
    var table;
    var row = null;
    if (this.verticalMode) {
      table = this.createTable(this.CL_RESULTTABLE_VERTICAL);
    } else {
      table = this.createTable(this.CL_RESULTTABLE_HORIZONTAL);
    }
    table.setAttribute("align", "center");

    for (var i = 0; i < results.length; i++) {

      var res = results[i];

      var imageScaler;
      var resultBoxHeight;
      var resultClass = null;
      if (this.thumbSize == GSvideoBar.THUMBNAILS_MEDIUM ) {
        // full size image
        imageScaler = {width:100,height:75};
        resultBoxHeight = this.resultBoxHeight;
        resultClass = this.CL_RESULTDIV;
      } else {
        // small size image
        imageScaler = {width:50,height:37};
        resultBoxHeight = this.smallResultBoxHeight;
        resultClass = this.CL_RESULTDIV_SMALL;
      }
      var scaled = GSearch.scaleImage(res.tbWidth, res.tbHeight, imageScaler);
      var img = this.createImage(res.tbUrl, scaled.width, scaled.height, null);

      if (this.externalMaster) {
        img.onclick = this.methodClosure(this.externalMaster, this.externalMaster.playVideo, [res]);
      } else {
        img.onclick = this.methodClosure(this, this.playVideo, [res]);
      }

      // manually set the top padding
      if ((resultBoxHeight - scaled.height) > 0) {
        var padTop = Math.round((resultBoxHeight - scaled.height)/2);
        img.setAttribute("vspace", padTop);
      }

      // compute duration
      var seconds = res.duration;
      var minutes = parseInt(seconds/60);
      var durationString;
      if (minutes > 0) {
        durationString = minutes + "m";
        var remainder = seconds%60;
        if (remainder > 20) {
          durationString += " " + remainder + "s";
        }
      } else {
        durationString = seconds + "s";
      }

      var toolTip = res.titleNoFormatting + " ( " + durationString + " )";
      var div = this.createDiv(null, resultClass);
      div.title = toolTip;
      div.appendChild(img);

      // create a new row for each result when in vertical mode
      // otherwise, jam everything into a single row.
      if (this.verticalMode) {
        row = this.createTableRow(table);
      } else {
        if (row == null) {
          row = this.createTableRow(table);
        }
      }
      cell = this.createTableCell(row, this.CL_RESULTCELL);
      cell.setAttribute("align", "center");
      cell.appendChild(div);
    }

    // now add in the branding...
    row = this.createTableRow(table);
    var brandingOrientation;
    if (this.verticalMode) {
      cell = this.createTableCell(row, this.CL_RESULTCELL);
      brandingOrientation = GSearch.VERTICAL_BRANDING;
    } else {
      cell = this.createTableCell(row, this.CL_RESULTCELL);
      if (this.br_IsIE()) {
        cell.setAttribute("colSpan", results.length);
      } else {
        cell.setAttribute("colspan", results.length);
      }
      brandingOrientation = GSearch.HORIZONTAL_BRANDING;
    }
    GSearch.getBranding(cell, brandingOrientation, "http://www.youtube.com");
    this.brandingCell = cell;

    this.resultsBox.appendChild(table);
  } else {
    this.cssSetClass(this.barBox, this.CL_VIDEOBARBOXEMPTY);
  }
}

GSvideoBar.prototype.playVideo = function(result) {
  this.stopVideo();
  if (this.autoExecuteMode && this.cycleTimer) {
    clearTimeout(this.cycleTimer);
    this.cycleTimer = null;
  }
  if (result.playUrl && result.playUrl != "") {
    this.cssSetClass(this.playerBox, this.CL_PLAYING);
    if (this.floatingPlayerBox) {
      this.cssSetClass(this.floatingPlayerBox, this.CL_FLOATING_BOX_PLAYING);
      this.cssSetClass(this.playerRoot, this.CL_FLOATING_PLAYER_PLAYING);
    }
    this.player = GvideoSearch.createPlayer(result, this.CL_PLAYER);
    this.playerInnerBox.appendChild(this.player);

    // the title
    var title = this.createDivLink(result.url, result.title, null, this.CL_TITLE);
    this.playerInnerBox.appendChild(title);

    if (this.floatingPlayerBox) {
      var playerBounds = GSvideoBar.nodeBounds(this.playerRoot);
      var bounds = GSvideoBar.nodeBounds(this.barRoot);
      var x;
      var y;
      if (this.verticalMode) {
        x = bounds.x - playerBounds.width;
        y = bounds.y + bounds.height / 2 - playerBounds.height / 2;
        var brandingBounds = GSvideoBar.nodeBounds(this.brandingCell);
        y = y - brandingBounds.height / 2;
        if (x < 10) {
          x = bounds.x + bounds.width;
        }
      } else {
        x = bounds.x + bounds.width / 2 - playerBounds.width / 2;
        y = bounds.y - playerBounds.height;
        if (y < 10) {
          y = bounds.y + bounds.height;
        }
      }

      this.playerRoot.style.top = y + "px";
      this.playerRoot.style.left = x + "px";

      this.floatingPlayerBox.style.top = y - 10 + "px";
      this.floatingPlayerBox.style.left = x - 10 + "px";
      boxWidth = (playerBounds.width + 20) + "px";
      this.floatingPlayerBox.style.width = boxWidth;
      this.floatingPlayerBox.style.height = (playerBounds.height + 20) + "px";
    }
    google.loader.recordStat('vbp', '1');
  }
}

GSvideoBar.prototype.stopVideo = function() {
  this.cssSetClass(this.playerBox, this.CL_IDLE);
  if (this.floatingPlayerBox) {
    this.cssSetClass(this.floatingPlayerBox, this.CL_FLOATING_BOX_IDLE);
    this.cssSetClass(this.playerRoot, this.CL_FLOATING_PLAYER_IDLE);
  }
  this.removeChildren(this.playerInnerBox);
  if (this.player) {
    delete(this.player);
    this.player = null;
  }
  if (this.autoExecuteMode && this.executeList.length > 1) {
    this.clearTimer();
    this.cycleTimer = setTimeout(this.cycleTimeClosure, this.cycleTime);
  }
}

GSvideoBar.prototype.clearTimer = function() {
  if (this.cycleTimer) {
    clearTimeout(this.cycleTimer);
    this.cycleTimer = null;
  }
}

GSvideoBar.prototype.cycleTimeout = function() {
  // select a new video
  // execute a search
  // restart the timer
  if ( this.player == null ) {
    // if there is only a single item in the execute list,
    // run it
    if ( this.executeList.length == 1) {
      this.switchToListItem(0);
    } else {
      var index = 0;
      if (this.cycleMode == GSvideoBar.CYCLE_MODE_RANDOM) {
        var max = this.executeList.length - 1;
        index = Math.round(max * Math.random());
      } else if (this.cycleMode == GSvideoBar.CYCLE_MODE_LINEAR){
        index = this.cycleNext;
        this.cycleNext++;
        if (this.cycleNext >= this.executeList.length) {
          this.cycleNext = 0;
        }
      }

      this.switchToListItem(index);
      this.clearTimer();
      this.cycleTimer = setTimeout(this.cycleTimeClosure, this.cycleTime);
    }
  }
}

/**
 * Autoexecute List Item Support
*/
GSvideoBar.prototype.newListItem = function(q) {
  var listItem = new Object();
  listItem.node = null;
  listItem.query = q;
  listItem.results = new Array();
  listItem.errorCount = 0;
  listItem.cacheCount = 0;
  return listItem;
}


GSvideoBar.prototype.switchToListItem = function(i) {
  // reset selcted class of previous item
  // note, first time through this sets
  // node 0
  if (this.executeList[this.currentIndex].node) {
    this.cssSetClass(this.executeList[this.currentIndex].node,
                     this.CL_STATUSITEM);

  }
  this.currentIndex = i;
  if (this.executeList[this.currentIndex].node) {
    this.cssSetClass(this.executeList[this.currentIndex].node,
                     this.CL_STATUSITEM_SELECTED);

  }
  var queryTerm = this.executeList[this.currentIndex].query;
  var cacheResults = false;
  var currentListItem = null;
  currentListItem = this.executeList[this.currentIndex];

  // if the error count of an item has reached max, reset query term
  if (currentListItem.errorCount > GSvideoBar.MAX_ERROR_COUNT) {
    currentListItem.errorCount = 0;
    queryTerm = GSvideoBar.DEFAULT_QUERY;
    currentListItem.query = queryTerm;
  }

  // if the listItem has no cached results, OR if
  // we have used the cached results several times
  // already, initiate a real search
  if (currentListItem.cacheCount == 0 ||
      currentListItem.cacheCount > this.cacheLifetime ) {
    currentListItem.cacheCount = 0;
    this.executeInternal(queryTerm);
  } else {
    currentListItem.cacheCount++;
    this.processResults(currentListItem.results);
  }
}

GSvideoBar.prototype.populateStatusRoot = function() {
  this.removeChildren(this.statusRoot);
  this.statusBox = this.createDiv(null, this.CL_STATUSBOX);
  this.statusRoot.appendChild(this.statusBox);

  if ( this.executeList.length > 0) {
    for (var i=0; i < this.executeList.length; i++ ) {
      var listItem = this.executeList[i];
      var displayTerm = listItem.query;
      // if we are looking at our special feed: terms, strip
      // feed: from the display
      var m = displayTerm.match(/feed:(top100|top100new)$/);
      if (m && m.length == 2) {
        displayTerm = m[1];
      }
      var div = this.createDiv(displayTerm, this.CL_STATUSITEM);

      // add click handler...
      div.onclick = this.methodClosure(this,
                                       GSvideoBar.prototype.switchToListItem,
                                       [i] );
      listItem.node = div;
      this.statusBox.appendChild(div);
      this.statusBox.appendChild(document.createTextNode(" "));
    }
  }
}

/**
 * Static Helper Method
*/
GSvideoBar.methodCallback = function(object, method) {
  return function() {
    return method.apply(object, arguments);
  }
}

/**
 * Class methods
*/
GSvideoBar.prototype.methodClosure = function(object, method, opt_argArray) {
  return function() {
    return method.apply(object, opt_argArray);
  }
}

GSvideoBar.prototype.createDiv = function(opt_text, opt_className) {
  var el = document.createElement("div");
  if (opt_text) {
    el.innerHTML = opt_text;
  }
  if (opt_className) { el.className = opt_className; }
  return el;
}

GSvideoBar.prototype.removeChildren = function(parent) {
  while (parent.firstChild) {
    parent.removeChild(parent.firstChild);
  }
}

GSvideoBar.prototype.removeChild = function(parent, child) {
  parent.removeChild(child);
}

GSvideoBar.prototype.cssSetClass = function(el, className) {
  el.className = className;
}

GSvideoBar.prototype.createTable = function(opt_className) {
  var el = document.createElement("table");
  if (opt_className) { el.className = opt_className; }
  return el;
}

GSvideoBar.prototype.createTableRow = function(table, opt_className) {
  var tr = table.insertRow(-1);
  if (opt_className) { tr.className = opt_className; }
  return tr;
}

GSvideoBar.prototype.createTableCell = function(tr, opt_className) {
  var td = tr.insertCell(-1);
  if (opt_className) { td.className = opt_className; }
  return td;
}

GSvideoBar.prototype.createDivLink = function(href, text, opt_target, opt_className) {
  var div = this.createDiv(null, opt_className);
  var el = document.createElement("a");
  el.href = href;
  el.appendChild(document.createTextNode(text));
  if (opt_className) {
    el.className = opt_className;
  }
  if (opt_target) {
    el.target = opt_target;
  }
  div.appendChild(el);
  return div;
}

GSvideoBar.prototype.createImage = function(src, opt_w, opt_h, opt_className) {
  var el = document.createElement("img");
  el.src = src;
  if (opt_w) { el.width = opt_w; }
  if (opt_h) { el.height = opt_h; }
  if (opt_className) { el.className = opt_className; }
  return el;
}

GSvideoBar.prototype.getNodeWidth = function(node) {
  return node.offsetWidth;
}

GSvideoBar.prototype.br_AgentContains_ = function(str) {
  if (str in this.br_AgentContains_cache_) {
    return this.br_AgentContains_cache_[str];
  }

  return this.br_AgentContains_cache_[str] =
    (navigator.userAgent.toLowerCase().indexOf(str) != -1);
}

GSvideoBar.prototype.br_IsIE = function() {
  return this.br_AgentContains_('msie');
}

GSvideoBar.prototype.br_IsMac = function() {
  return this.br_AgentContains_('macintosh') ||
         this.br_AgentContains_('mac_powerpc');
}

GSvideoBar.prototype.br_IsKonqueror = function() {
  return this.br_AgentContains_('konqueror');
}

GSvideoBar.prototype.br_IsOpera = function() {
  return this.br_AgentContains_('opera');
}

GSvideoBar.prototype.br_IsSafari = function() {
  return this.br_AgentContains_('safari') || this.br_IsKonqueror();
}

GSvideoBar.prototype.br_IsNav = function() {
  return !this.br_IsIE() &&
         !this.br_IsSafari() &&
         this.br_AgentContains_('mozilla');
}

GSvideoBar.prototype.br_IsWin = function() {
  return this.br_AgentContains_('win');
}

GSvideoBar.nodeBounds = function(obj) {
  var result = {};

  function fixRectForScrolling(r) {
    // Need to take into account scrolling offset of ancestors (IE already does
    // this)
    for (var o = obj.offsetParent;
         o && o.offsetParent;
         o = o.offsetParent) {
      if (o.scrollLeft) {
        r.x -= o.scrollLeft;
      }
      if (o.scrollTop) {
        r.y -= o.scrollTop;
      }
    }
  }

  // Mozilla
  if (obj.ownerDocument && obj.ownerDocument.getBoxObjectFor) {
    var box = obj.ownerDocument.getBoxObjectFor(obj);
    result.x = box.x;
    result.y = box.y;
    result.width = box.width;
    result.height = box.height;
    fixRectForScrolling(result);
    return result;
  }

  // IE
  if (obj.getBoundingClientRect) {
    var refWindow;
    if (obj.ownerDocument && obj.ownerDocument.parentWindow) {
      refWindow = obj.ownerDocument.parentWindow;
    } else {
      refWindow = window;
    }

    var rect = obj.getBoundingClientRect();
    result.x = rect.left + GSvideoBar.GetIEScrollLeft(refWindow);
    result.y = rect.top + GSvideoBar.GetIEScrollTop(refWindow);
    result.width = rect.right - rect.left;
    result.height = rect.bottom - rect.top;
    return result;
  }

  // Fallback to recursively computing this
  var left = 0;
  var top = 0;
  for (var o = obj; o.offsetParent; o = o.offsetParent) {
    left += o.offsetLeft;
    top += o.offsetTop;
  }

  result.x = left;
  result.y = top;
  result.width = obj.offsetWidth;
  result.height = obj.offsetHeight;

  fixRectForScrolling(result);
  return result;
}

// Get the y position scroll offset.
GSvideoBar.GetIEScrollTop = function(win) {
  if ("compatMode" in win.document && win.document.compatMode == "CSS1Compat") {
    return win.document.documentElement.scrollTop;
  } else {
    return win.document.body.scrollTop;
  }
}

// Get the x position scroll offset.
GSvideoBar.GetIEScrollLeft = function(win) {
  if ("compatMode" in win.document && win.document.compatMode == "CSS1Compat") {
    return win.document.documentElement.scrollLeft;
  } else {
    return win.document.body.scrollLeft;
  }
}

