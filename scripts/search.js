window.onload = initPage;

function createRequest() {
  try {
    request = new XMLHttpRequest();
  } catch (tryMS) {
    try {
      request = new ActiveXObject("Msxml2.XMLHTTP.3.0");
    } catch (otherMS) {
      try {
        request = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (failed) {
        request = null;
      }
    }
  }
  return request;
}

function initPage() {
  search_form = document.getElementById("search_form");
  search_form.onsubmit = submitSearch;
  search_text = document.getElementById("search_query");
  search_text.onkeyup = submitSearch;
}

function displaySearchResults() {
  if (request.readyState == 4) {
    if (request.status == 200) {
      resultsDiv = document.getElementById("search_results");
      resultsDiv.innerHTML = request.responseText;
    }
  }
}

function submitSearch() {
  request = createRequest();
  if (request == null) {
    alert ("Unable to create request");
    return;
  }
  
  search_query = search_text.value;
  var url = "search.php?ajax=1&search_query=" + escape(search_query);
  
  request.open("GET", url, true);
  request.onreadystatechange = displaySearchResults;
  request.send(null);
}





