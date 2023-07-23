function closeParameter() {
    var x = document.getElementById("menu-parameter");
    var y = document.getElementById("parametertools");
    if (x.style.display === "none") {
        x.style.display = "block";
        y.style.background = "#538f91";
        y.style.color = "#ffffff";
    } else {
        x.style.display = "none";
        y.style.background = "#ffffff";
        y.style.color = "#000000";
    }
}

function closeBasemap() {
    var x = document.getElementById("menu-basemap");
    var y = document.getElementById("basemaptools");
    if (x.style.display === "none") {
        x.style.display = "block";
        y.style.background = "#538f91";
        y.style.color = "#ffffff";
    } else {
        x.style.display = "none";
        y.style.background = "#ffffff";
        y.style.color = "#000000";
    }
}


function closeDataset() {
    var x = document.getElementById("menu-dataset");
    var y = document.getElementById("datasettools");
    if (x.style.display === "none") {
        x.style.display = "block";
        y.style.background = "#538f91";
        y.style.color = "#ffffff";
    } else {
        x.style.display = "none";
        y.style.background = "#ffffff";
        y.style.color = "#000000";
    }
}

function closeLegend() {
    var x = document.getElementById("menu-legend");
    var y = document.getElementById("legendtools");
    if (x.style.display === "none") {
        x.style.display = "block";
        y.style.background = "#538f91";
        y.style.color = "#ffffff";
    } else {
        x.style.display = "none";
        y.style.background = "#ffffff";
        y.style.color = "#000000";
    }
}

function SelectDistance() {
    var distance = document.getElementById("distance");
    var distance2 = document.getElementById("distance2");
    var time = document.getElementById("time");
    if (distance.style.display === "none") {
        distance.style.display = "block";
        time.style.display = "none";
        distance2.style.display = "none";
    } else if (distance2.style.display === "none") {
        distance.style.display = "none";
        time.style.display = "none";
        distance2.style.display = "block";
    } else {
        time.style.display = "none";
        distance.style.display = "none";
        distance2.style.display = "none";
    }
}

function SelectTime() {
    var distance = document.getElementById("distance");
    var distance2 = document.getElementById("distance2");
    var time = document.getElementById("time");
    if (time.style.display == "none") {
        distance.style.display = "none";
        distance2.style.display = "none";
        time.style.display = "block";
    } else {
        time.style.display = "none";
    }
}

  
